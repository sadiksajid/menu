<?php

namespace App\Http\Livewire;

use DNS2D;
use Dompdf\Dompdf;
use Dompdf\Options;
use Livewire\Component;
use App\Models\QrCodeTemplate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\overWrite\NewGetBarcodeHTML;

class AdminMarketing extends Component
{

    public $store_info ;
    public $store_meta ;
    public $store_url ;
    public $paginat = 20 ;

////////////////////////////////
    public $langs;
    public $translations;

    public function mount()
    {

        $this->langs = languages()['langs'];
        $this->translations = app('translations_admin');
        ///////////////////////////////////
        $this->store_info = Auth::user()->store ;
        $this->store_meta = $this->store_info->store_meta ;
        $this->store_url = Request::root().$this->store_meta.'/menu';
        $this->getQrCodes();

    }
    public function render()
    {
        $all_qr = Cache::get('staf_all_qr_'.Auth::id()) ?? [];

        return view('livewire.admin.marketing.marketing',['all_qr' => $all_qr]);

    }

    
    public function getQrCodes($page = 1)
    {
   
            $data = QrCodeTemplate::paginate($this->paginat, ['*'], 'page', $page);

            
            if ($page > 1) {
                $all_qr = Cache::get('staf_all_qr_'.Auth::id());
                $data = $all_qr->merge($data);
            }

            Cache::put('staf_all_qr_'.Auth::id(), $data);
            Cache::put('page_staf_qr_'.Auth::id(), $page);
       
    }




    public function GeneratQR($id)
    {
        $all_qr = Cache::get('staf_all_qr_'.Auth::id());
        $template = $all_qr->where('id',$id)->first();
        
        $generator = new NewGetBarcodeHTML();
        $QRcode = $generator->getBarcodeHTML($this->store_url, 'QRCODE',$template['qr_config']['height'],$template['qr_config']['width'],$template['qr_config']['top'],$template['qr_config']['left'],$template['qr_config']['color']);
        $content = Http::get(get_image($this->store_info->logo))->body();
        $logoBase64 = 'data:image/png;base64,' . base64_encode($content);


        $content = Http::get(get_image($template['image']['link']))->body();
        $bgBase64 = 'data:image/png;base64,' . base64_encode($content);

        $bgBase64 = 'data:image/png;base64,' . base64_encode($content);



        $data = [
            'QRcode' => $QRcode,
            'info' => array(
                'phone1'=>$this->store_info->phone,
                'phone2'=>$this->store_info->phone2,
                'email'=>$this->store_info->email,
                'title'=>$this->store_info->title,
            ),
            'template'=>$template->toArray(),
            'logoBase64' => $logoBase64,
            'bgBase64' => $bgBase64,

        ];

        
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf = new Dompdf($options);
        $pdf->loadHtml(View::make('livewire.admin.marketing.qr_template', $data));
        $pdf->setPaper([0, 0,$template['image']['width'],$template['image']['height']]); 
          
        $pdf->render();

        $output = $pdf->output();
        $filePath = 'security_code_card.pdf';

        Storage::put($filePath, $output);

        return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend(true);


        
     
    }






}
