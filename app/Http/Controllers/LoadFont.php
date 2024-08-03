<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\CanvasFactory;
use Dompdf\Exception;
use Dompdf\FontMetrics;
use Dompdf\Options;

use FontLib\Font;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LoadFont extends Controller
{
    public function __construct()
    {
        $this->fontDir = storage_path("fonts");
    }


    public function install_font_family($dompdf, $fontname, $normal, $bold = null, $italic = null, $bold_italic = null) {
        $fontMetrics = $dompdf->getFontMetrics();
        
        // Check if the base filename is readable
        if ( !is_readable($normal) )
          throw new Exception("Unable to read '$normal'.");
      
        $dir = dirname($normal);
        $basename = basename($normal);
        $last_dot = strrpos($basename, '.');
        if ($last_dot !== false) {
          $file = substr($basename, 0, $last_dot);
          $ext = strtolower(substr($basename, $last_dot));
        } else {
          $file = $basename;
          $ext = '';
        }
      
        if ( !in_array($ext, array(".ttf", ".otf")) ) {
          throw new Exception("Unable to process fonts of type '$ext'.");
        }
      
        // Try $file_Bold.$ext etc.
        $path = "$dir/$file";
        
        $patterns = array(
          "bold"        => array("_Bold", "b", "B", "bd", "BD"),
          "italic"      => array("_Italic", "i", "I"),
          "bold_italic" => array("_Bold_Italic", "bi", "BI", "ib", "IB"),
        );
        
        foreach ($patterns as $type => $_patterns) {
          if ( !isset($$type) || !is_readable($$type) ) {
            foreach($_patterns as $_pattern) {
              if ( is_readable("$path$_pattern$ext") ) {
                $$type = "$path$_pattern$ext";
                break;
              }
            }
            
            // if ( is_null($$type) )
            //   return ("Unable to find $type face file.\n");
          }
        }
      
        $fonts = compact("normal", "bold", "italic", "bold_italic");
        $entry = array();
      
        // Copy the files to the font directory.
        foreach ($fonts as $var => $src) {
          if ( is_null($src) ) {
            $entry[$var] = $dompdf->getOptions()->get('fontDir') . '/' . mb_substr(basename($normal), 0, -4);
            continue;
          }
      
          // Verify that the fonts exist and are readable
          if ( !is_readable($src) )
            throw new Exception("Requested font '$src' is not readable");
      
          $dest = $dompdf->getOptions()->get('fontDir') . '/' . basename($src);
      
          if ( !is_writeable(dirname($dest)) )
            throw new Exception("Unable to write to destination '$dest'.");
      
          // echo "Copying $src to $dest...\n";
      
          if ( !copy($src, $dest) )
            throw new Exception("Unable to copy '$src' to '$dest'");
          
          $entry_name = mb_substr($dest, 0, -4);
          
          // echo "Generating Adobe Font Metrics for $entry_name...\n";
          
          $font_obj = Font::load($dest);
          $font_obj->saveAdobeFontMetrics("$entry_name.ufm");
          $font_obj->close();
      
          $entry[$var] = $entry_name;
        }
      
        // Store the fonts in the lookup table
        $fontMetrics->setFontFamily($fontname, $entry);
      
        // Save the changes
        $fontMetrics->saveFontFamilies();
      }


      public function import($font,$path){

        $dompdf = new Dompdf();
        
        if (isset($this->fontDir) && realpath($this->fontDir) !== false) {
             $dompdf->getOptions()->set('fontDir', $this->fontDir);
        }

                
        // If installing system fonts (may take a long time)
        if ( $font === "system_fonts" ) {
            $fontMetrics = $dompdf->getFontMetrics();
            $files = glob("/usr/share/fonts/truetype/*.ttf") +
            glob("/usr/share/fonts/truetype/*/*.ttf") +
            glob("/usr/share/fonts/truetype/*/*/*.ttf") +
            glob("C:\\Windows\\fonts\\*.ttf") +
            glob("C:\\WinNT\\fonts\\*.ttf") +
            glob("/mnt/c_drive/WINDOWS/Fonts/");
            $fonts = array();
            foreach ($files as $file) {
                $font = Font::load($file);
                $records = $font->getData("name", "records");
                $type = $fontMetrics->getType($records[2]);
                $fonts[mb_strtolower($records[1])][$type] = $file;
                $font->close();
            }
            
            foreach ( $fonts as $family => $files ) {
            // echo " >> Installing '$family'... \n";
            
            if ( !isset($files["normal"]) ) {
                // echo "No 'normal' style font file\n";
            }
            else {
                $this->install_font_family($dompdf, $family, @$files["normal"], @$files["bold"], @$files["italic"], @$files["bold_italic"]);
                // echo "Done !\n";
            }
            
            // echo "\n";
            }
        }
        else {
            call_user_func_array([$this,"install_font_family"], array_merge( array($dompdf), [$font,$path] ));
        }

  
      }
}