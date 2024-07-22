<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\QrCodeTemplate;
use App\Models\StafTagToTable;
use App\Models\StafHeaderImage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\OverWrite\NewGetBarcodeHTML;

class StafQrCode extends Component
{
    use WithFileUploads;


    //////////////////////////
    public $paginat = 20;
    public $translations;
/////////////////////////
    public $logo_check = false ;
    public $title_check = false ;
    public $phone1_check = false ;
    public $phone2_check = false ;
    public $email_check = false ;

    public $image_width;
    public $image_height;

    public $qr_left;
    public $qr_top;
    public $qr_width;
    public $qr_height;
    public $qr_color;

    public $logo_left;
    public $logo_top;
    public $logo_width;
    public $logo_height;


    public $title_left;
    public $title_top;
    public $title_font_size;
    public $title_color;
    public $title_center;
    public $title_font_file;
    public $title_font_name;



    public $phone1_left;
    public $phone1_top;
    public $phone1_font_size;
    public $phone1_color;
    public $phone1_center;
    public $phone1_font_file;
    public $phone1_font_name;

    public $phone2_left;
    public $phone2_top;
    public $phone2_font_size;
    public $phone2_color;
    public $phone2_center;
    public $phone2_font_file;
    public $phone2_font_name;

    public $email_left;
    public $email_top;
    public $email_font_size;
    public $email_color;
    public $email_center;
    public $email_font_file;
    public $email_font_name;

//////////////////////////////////////////
public $inputs_array = ['title','phone1','phone2','email'];
//////////////////////////////////////////

    public $store_id;
    public $langs;
    public $store_info;
    public $qr_image;
    public $image_to_delete = null;
    public $image_to_update = null;


    protected $listeners = ['confirmDelete','submitImage','UpdateImage','cancelUpdate'];

    public function mount()
    {
        $this->translations = app('translations_admin');

        $this->langs = languages()['langs'];
        $this->getImages();
    }
    public function render()
    {
        $all_qr = Cache::get('staf_all_qr') ?? [];
        return view('livewire.staf.qr_code.qr_code_list',['all_qr' => $all_qr]);
    }



    public function getImages($page = 1)
    {
   

            $data = QrCodeTemplate::paginate($this->paginat, ['*'], 'page', $page);

            
            if ($page > 1) {
                $all_qr = Cache::get('staf_all_qr');
                $data = $all_qr->merge($data);
            }

            Cache::put('staf_all_qr', $data);
            Cache::put('page_staf_qr', $page);

       
    }

    
    public function submitImage()
    {
        dd($this->title_font_file);
        $this->title_font_file->store('all_fonts', 'public');
        // dd($fileName);
        $result = Process::run('php load_font.php Branda3 .\storage\Branda-yolq.ttf');




  
        $pass = true ;

        $validator = Validator::make(
            [
                'qr_image' => $this->qr_image,
                'qr_left' => $this->qr_left,
                'qr_top' => $this->qr_top,
                'qr_width' => $this->qr_width,
                'qr_height' => $this->qr_height,
                'qr_color' => $this->qr_color,
                'image_width' => $this->image_width,
                'image_height' => $this->image_height,


            ],
            [
            'qr_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'qr_left' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
            'qr_top' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
            'qr_width' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
            'qr_height' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
            'qr_color' => ['required', 'string','max:10'],
            'image_width' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
            'image_height' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],

            ]
        );
    
        if ($validator->fails()) {
            $pass = false ;

            $this->dispatchBrowserEvent('swal:error', [
                'type' => 'error',
                'title' => 'Oooops!',
                'errors' => $validator->errors()->toArray(),
            ]);
            
        }


        if($this->logo_check){

            $valid1 =    [
                'logo_left' => $this->logo_left,
                'logo_top' => $this->logo_top,
                'logo_width' => $this->logo_width,
                'logo_height' => $this->logo_height,

            ];
            $valid2 =   [
                'logo_left' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
                'logo_top' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
                'logo_width' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
                'logo_height' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
            ] ;
          
            $validator = Validator::make($valid1,$valid2);

            if ($validator->fails()) {
                $pass = false ;
                $this->dispatchBrowserEvent('swal:error', [
                    'type' => 'error',
                    'title' => 'Oooops!',
                    'errors' => $validator->errors()->toArray(),
                ]);
            }    
            
        }


        foreach ($this->inputs_array as $key) {
            $key_check = $key."_check";
            if($this->$key_check){
                $key_font_size = $key."_font_size";
                $key_color = $key."_color";
                $key_top = $key."_top";
                $key_center = $key."_center";
                $key_left = $key."_left";
                $key_font_name = $key."_font_name";
                $key_font_file = $key."_font_file";


                $valid1 = [
                    $key_font_size => $this->$key_font_size,
                    $key_color => $this->$key_color,
                    $key_top => $this->$key_top,
                ];
                $valid2 = [
                    $key_font_size => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
                    $key_color => ['required', 'string','max:10'],
                    $key_top => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
                ] ;
              
                if(!$this->$key_center){
                    $valid1 = array_merge($valid1, [
                        $key_left => $this->$key_left,
                    ]);
                    $valid2 = array_merge($valid2,  [
                        $key_left => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
                    ]);
                }
    
                if(!$this->$key_font_name != null or $this->$key_font_file != null){
                    $valid1 = array_merge($valid1, [
                        $key_font_file => $this->$key_font_file,
                        $key_font_name => $this->$key_font_name,
                    ]);
                    $valid2 = array_merge($valid2,  [
                        $key_font_file => ['required', 'string','max:250'],
                        $key_font_name => ['required', 'string','max:250'],
                    ]);
                }
    
    
                $validator = Validator::make($valid1,$valid2);
    
                if ($validator->fails()) {
                    $pass = false ;
                    $this->dispatchBrowserEvent('swal:error', [
                        'type' => 'error',
                        'title' => 'Oooops!',
                        'errors' => $validator->errors()->toArray(),
                    ]);
                    return ;
                }    
                
            }
        }


       
        if ($pass) {
        
            if (!empty($this->qr_image)) {
                $img_link = 'QR_'. md5(microtime()) .'.'. $this->qr_image->getClientOriginalExtension();
                $image = File::get($this->qr_image->getRealPath());
                $save_result = save_livewire_filetocdn($image, 'staf_qr_templates', $img_link);
    
                $img_link = 'staf_qr_templates/' . $img_link;
    
                if ($save_result) {


                    $image = new QrCodeTemplate();
                    $image->image = [
                        'link' => $img_link,
                        'width' => $this->image_width,
                        'height' => $this->image_height,
                    ];
                    
                    $image->qr_config = [
                        'left' => $this->qr_left,
                        'top' => $this->qr_top,
                        'width' => $this->qr_width,
                        'height' => $this->qr_height,
                        'color' => $this->qr_color,
                    ];
                    
                    if ($this->logo_check) {
                        $image->logo_config = [
                            'left' => $this->logo_left,
                            'top' => $this->logo_top,
                            'width' => $this->logo_width,
                            'height' => $this->logo_height,
                        ];
                    }
                    

                    foreach ($this->inputs_array as $key) {
                        $key_check = $key."_check";
                        if($this->$key_check){
                            $key_font_size = $key."_font_size";
                            $key_color = $key."_color";
                            $key_top = $key."_top";
                            $key_center = $key."_center";
                            $key_left = $key."_left";
                            $key_font_name = $key."_font_name";
                            $key_font_file = $key."_font_file";
                            $key_config = $key."_config";
            
            
                            $conf  =  [
                                'font-size' => $this->$key_font_size * 1.333,
                                'color' => $this->$key_color,
                                'top' => $this->$key_top,
                                'font_url' => $this->$key_font_file,
                                'font_name' => $this->$key_font_name,
    
    
                            ];
    
                            if(!$this->$key_center){
                                $conf = array_merge($conf, [
                                    'left' => $this->$key_left,
                                ]);
                            }else{
                                $conf = array_merge($conf, [
                                    'position' => 'center',
                                ]);
                            }
    
                            $image->$key_config = $conf ;
                            
                        }
                    }              
                                        
                    $img_id = $image->save();
                }
    
            }
                
            if(!$img_id){

                $this->dispatchBrowserEvent('swal:finish', [
                    'type' => 'error',
                    'title' => $this->translations['template_not_saved'] ,
                ]);
            }else{
                $this->getImages();
                $this->clearData();
                $this->GeneratQR($img_id);

                $this->dispatchBrowserEvent('swal:finish', [
                    'type' => 'success',
                    'title' => $this->translations['template_saved'] ,
                ]);
            }
    
        }

    }
//////////////////////////////////////////////
    public function deleteQR($id)
    {
        $this->image_to_delete = $id ;
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => $this->translations['delete_template'],
            'message' => $this->translations['delete_template_question'],
            'function' => 'confirmDelete'
        ]);
    }
    public function confirmDelete()
    {
        $image  =  QrCodeTemplate::find($this->image_to_delete);

        deleteFile($image->image['link']);

        $image->delete();

        $this->getImages();
        $this->image_to_delete = null ;
        $this->dispatchBrowserEvent('swal:finish', [
            'type' => 'success',
            'title' => $this->translations['delete_template_success'],
        ]);
    }
//////////////////////////////////////////////

public function cancelUpdate()
{
    $this->image_to_update = null ;
}


public function editQR($id)
{
    $this->image_to_update = $id ;
    $image  =  QrCodeTemplate::find($id);
        

    $edit_img_link = get_image('tmb/'.$image->image['link']);
    $this->image_width  = $image->image['width'];
    $this->image_height = $image->image['height'];
    $this->qr_left      = $image->qr_config['left'];
    $this->qr_top       = $image->qr_config['top'];
    $this->qr_width     = $image->qr_config['width'];
    $this->qr_height    = $image->qr_config['height'];
    $this->qr_color     = $image->qr_config['color'];

   
    foreach ($this->inputs_array as $key) {
        $key_config = $key."_config";
        $key_check = $key."_check";

        if( $image->$key_config != null ){
            $key_font_size = $key."_font_size";
            $key_color = $key."_color";
            $key_top = $key."_top";
            $key_center = $key."_center";
            $key_left = $key."_left";
            $key_font_name = $key."_font_name";
            $key_font_file = $key."_font_file";

            $this->$key_check       = true ;
            $this->$key_font_size   =  number_format(($image->$key_config['font-size'] / 1.333 ), 2, '.', '');
            $this->$key_color       = $image->$key_config['color'] ;
            $this->$key_top         = $image->$key_config['top'] ;
            $this->$key_font_file    = $image->$key_config['font_url'] ?? null ;
            $this->$key_font_name   = $image->$key_config['font_name']  ?? null;

            if(isset($image->$key_config['position'] )){
                $this->$key_center  = true ;
            }else{
                $this->$key_center  = false ;
                $this->$key_left    = $image->$key_config['left'] ;

            }
            
        }else{
            $this->$key_check = false ;
        }
    }              
                                
            
    $this->dispatchBrowserEvent('edit_image', [
        'qr_image' => $edit_img_link ,
    ]);
}


    public function UpdateImage()
    {
       

        $pass = true ;

        $validator = Validator::make(
            [
                'qr_image' => $this->qr_image,
                'qr_left' => $this->qr_left,
                'qr_top' => $this->qr_top,
                'qr_width' => $this->qr_width,
                'qr_height' => $this->qr_height,
                'qr_color' => $this->qr_color,
                'image_width' => $this->image_width,
                'image_height' => $this->image_height,


            ],
            [
            'qr_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'qr_left' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
            'qr_top' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
            'qr_width' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
            'qr_height' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
            'qr_color' => ['required', 'string','max:10'],
            'image_width' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
            'image_height' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],

            ]
        );
    
        if ($validator->fails()) {
            $pass = false ;

            $this->dispatchBrowserEvent('swal:error', [
                'type' => 'error',
                'title' => 'Oooops!',
                'errors' => $validator->errors()->toArray(),
            ]);
            
        }


        if($this->logo_check){

            $valid1 =    [
                'logo_left' => $this->logo_left,
                'logo_top' => $this->logo_top,
                'logo_width' => $this->logo_width,
                'logo_height' => $this->logo_height,

            ];
            $valid2 =   [
                'logo_left' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
                'logo_top' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
                'logo_width' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
                'logo_height' => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
            ] ;
          
            $validator = Validator::make($valid1,$valid2);

            if ($validator->fails()) {
                $pass = false ;
                $this->dispatchBrowserEvent('swal:error', [
                    'type' => 'error',
                    'title' => 'Oooops!',
                    'errors' => $validator->errors()->toArray(),
                ]);
            }    
            
        }


        foreach ($this->inputs_array as $key) {
            $key_check = $key."_check";
            if($this->$key_check){
                $key_font_size = $key."_font_size";
                $key_color = $key."_color";
                $key_top = $key."_top";
                $key_center = $key."_center";
                $key_left = $key."_left";
                $key_font_name = $key."_font_name";
                $key_font_file = $key."_font_file";


                $valid1 = [
                    $key_font_size => $this->$key_font_size,
                    $key_color => $this->$key_color,
                    $key_top => $this->$key_top,
                ];
                $valid2 = [
                    $key_font_size => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
                    $key_color => ['required', 'string','max:10'],
                    $key_top => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
                ] ;
              
                if(!$this->$key_center){
                    $valid1 = array_merge($valid1, [
                        $key_left => $this->$key_left,
                    ]);
                    $valid2 = array_merge($valid2,  [
                        $key_left => ['required', 'regex:/^[0-9]*[.,]?[0-9]+$/'],
                    ]);
                }
    
                if(!$this->$key_font_name != null or $this->$key_font_file != null){
                    $valid1 = array_merge($valid1, [
                        $key_font_file => $this->$key_font_file,
                        $key_font_name => $this->$key_font_name,
                    ]);
                    $valid2 = array_merge($valid2,  [
                        $key_font_file => ['required', 'string','max:250'],
                        $key_font_name => ['required', 'string','max:250'],
                    ]);
                }
    
    
                $validator = Validator::make($valid1,$valid2);
    
                if ($validator->fails()) {
                    $pass = false ;
                    $this->dispatchBrowserEvent('swal:error', [
                        'type' => 'error',
                        'title' => 'Oooops!',
                        'errors' => $validator->errors()->toArray(),
                    ]);
                    return ;
                }    
                
            }
        }


       
        if ($pass) {
            $image = QrCodeTemplate::find($this->image_to_update);

            if (!empty($this->qr_image)) {
                $img_link = 'QR_'. md5(microtime()) .'.'. $this->qr_image->getClientOriginalExtension();
                $image = File::get($this->qr_image->getRealPath());
                $save_result = save_livewire_filetocdn($image, 'staf_qr_templates', $img_link);
                $img_link = 'staf_qr_templates/' . $img_link;
                if ($save_result) {
                    deleteFile($image->image['link']);
                }

            }else{
                $save_result = true ;
                $img_link = $image->image['link'];
            }
    
            if ($save_result) {
                

                
                $image->image = [
                    'link' => $img_link,
                    'width' => $this->image_width,
                    'height' => $this->image_height,
                ];
                
                $image->qr_config = [
                    'left' => $this->qr_left,
                    'top' => $this->qr_top,
                    'width' => $this->qr_width,
                    'height' => $this->qr_height,
                    'color' => $this->qr_color,
                ];
                
                if ($this->logo_check) {
                    $image->logo_config = [
                        'left' => $this->logo_left,
                        'top' => $this->logo_top,
                        'width' => $this->logo_width,
                        'height' => $this->logo_height,
                    ];
                }
                

                foreach ($this->inputs_array as $key) {
                    $key_check = $key."_check";
                    if($this->$key_check){
                        $key_font_size = $key."_font_size";
                        $key_color = $key."_color";
                        $key_top = $key."_top";
                        $key_center = $key."_center";
                        $key_left = $key."_left";
                        $key_font_name = $key."_font_name";
                        $key_font_file = $key."_font_file";
                        $key_config = $key."_config";

                        $file =  $this->$key_font_file;
                        $fileName = $file->getClientOriginalName();
                        $file->storeAs('all_fonts', $fileName, 'public');
                        dd($fileName);
                        $result = Process::run('php load_font.php Branda3 .\storage\Branda-yolq.ttf');

        
                        $conf  =  [
                            'font-size' => $this->$key_font_size * 1.333,
                            'color' => $this->$key_color,
                            'top' => $this->$key_top,
                            'font_url' => $this->$key_font_file,
                            'font_name' => $this->$key_font_name,


                        ];

                        if(!$this->$key_center){
                            $conf = array_merge($conf, [
                                'left' => $this->$key_left,
                            ]);
                        }else{
                            $conf = array_merge($conf, [
                                'position' => 'center',
                            ]);
                        }

                        $image->$key_config = $conf ;
                        
                    }
                }              
                                    
                $img_id = $image->save();
            }
    
                
            if(!$img_id){

                $this->dispatchBrowserEvent('swal:finish', [
                    'type' => 'error',
                    'title' => $this->translations['template_not_saved'] ,
                ]);
            }else{
                $this->image_to_update = null ;
                $this->getImages();
                $this->clearData();
                $this->GeneratQR($img_id);
                $this->dispatchBrowserEvent('swal:finish', [
                    'type' => 'success',
                    'title' => $this->translations['template_updated'] ,
                ]);
            }
    
        }


    }


     

    public function clearData(){
        $logo_check = false ;
        $title_check = false ;
        $phone1_check = false ;
        $phone2_check = false ;
        $email_check = false ;

        $image_width = null ;
        $image_height = null  ;

        $qr_left = null  ;
        $qr_top = null  ;
        $qr_width = null  ;
        $qr_height = null  ;
        $qr_color = null  ;

        $logo_left = null  ;
        $logo_top = null  ;
        $logo_width = null  ;
        $logo_height = null  ;


        $title_left = null  ;
        $title_top = null  ;
        $title_font_size = null  ;
        $title_color = null  ;
        $title_center = false  ;
        $title_font_file = null  ;
        $title_font_name = null  ;



        $phone1_left = null  ;
        $phone1_top = null  ;
        $phone1_font_size = null  ;
        $phone1_color = null  ;
        $phone1_center = false  ;
        $phone1_font_file = null  ;
        $phone1_font_name = null  ;

        $phone2_left = null  ;
        $phone2_top = null  ;
        $phone2_font_size = null  ;
        $phone2_color = null  ;
        $phone2_center = false  ;
        $phone2_font_file = null  ;
        $phone2_font_name = null  ;

        $email_left = null  ;
        $email_top = null  ;
        $email_font_size = null  ;
        $email_color = null  ;
        $email_center = false  ;
        $email_font_file = null  ;
        $email_font_name = null  ;

    }

    public function GeneratQR($id)
    {
        $all_qr = Cache::get('staf_all_qr');
        $template = $all_qr->where('id',$id)->first();
        
        $generator = new NewGetBarcodeHTML();
        $QRcode = $generator->getBarcodeHTML('https://menu.sys.coolrasto.com/', 'QRCODE',$template['qr_config']['height'],$template['qr_config']['width'],$template['qr_config']['top'],$template['qr_config']['left'],$template['qr_config']['color']);
        // $content = Http::get(get_image($this->store_info->logo))->body();
        // $logoBase64 = 'data:image/png;base64,' . base64_encode($content);


        $content = Http::get(get_image($template['image']['link']))->body();
        $bgBase64 = 'data:image/png;base64,' . base64_encode($content);



        
        $data = [
            'QRcode' => $QRcode,
            'info' => array(
                'phone1'=>'0623783001',
                'phone2'=>'0708084136',
                'email'=>'sadikagadir@gmail.com',
                'title'=>'Cool Resto',
            ),
            'template'=>$template->toArray(),
        // 'logoBase64' => $logoBase64,
            'bgBase64' => $bgBase64,

        ];

        
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->setFontDir(storage_path('fonts')); // not working for me
        $pdf = new Dompdf($options);
        $pdf->loadHtml(View::make('livewire.admin.marketing.qr_template', $data));
        $pdf->setPaper([0, 0,$template['image']['width'],$template['image']['height']]); 
          
        $pdf->render();


        $this->dispatchBrowserEvent('pdfRendered', [
            'pdfData' => base64_encode($pdf->output()),
        ]);

        // $output = $pdf->output();

        // $filePath = 'security_code_card.pdf';

        // Storage::put($filePath, $output);

        // return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend(true);


        
     
    }

}