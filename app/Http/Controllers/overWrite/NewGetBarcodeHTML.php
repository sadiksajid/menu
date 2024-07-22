<?php

namespace App\Http\Controllers\OverWrite;

use Milon\Barcode\DNS2D;

class NewGetBarcodeHTML extends DNS2D
{
    // Overwrite the getBarcodeHTML function
    public function getBarcodeHTML($code, $type, $w = 2, $h = 30,$top=0,$left=0, $color = 'black')
    {
        if (!$this->store_path) {
            $this->setStorPath(config('barcode.store_path'));
        }
        //set barcode code and type
        $this->setBarcode($code, $type);
        $html = '<div style="top:'.$top.'pt;left:'.$left.'pt;font-size:0;position:fixed;width:' . $w . 'pt;height:' . $h . 'pt;">' . "\n";
        // print barcode elements
        $y = 0;
        // for each row

        $nh = ($h/$this->barcode_array['num_rows']) ;
        $nw = ($w / $this->barcode_array['num_cols']) ;
        for ($r = 0; $r < $this->barcode_array['num_rows']; ++$r) {
            $x = 0;
            // for each column
            for ($c = 0; $c < $this->barcode_array['num_cols']; ++$c) {
                if ($this->barcode_array['bcode'][$r][$c] == 1) {
                    // draw a single barcode cell
                    $html .= '<div style="background-color:' . $color . ';width:' . $nw . 'pt;height:' . $nh . 'pt;position:absolute;left:' . $x . 'pt;top:' . $y . 'pt;">&nbsp;</div>' . "\n";
                }
                $x += $nw;
            }
            $y += $nh;
        }
        $html .= '</div>' . "\n";


        return $html;
    }
}
