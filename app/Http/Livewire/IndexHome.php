<?php

namespace App\Http\Livewire;

use App\Models\CompitionClient;
use App\Models\Index;
use App\Models\Offer;
use App\Models\Store;
use App\Models\StoreProduct;
use App\Rules\PhoneValidation;
use DNS2D;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Symfony\Component\Intl\Currencies;

class IndexHome extends Component
{
    public $titles = [];
    public $buttons = [];
    public $images = [];
    public $texts = [];
    public $urls = [];
    public $slides = [];

    public $store_meta;
    public $store_id;
    public $store_info;

    public $all_data;
    public $slide_data;
    public $index_data;
    public $competion_data;

    public $upload_image;
    public $products;
    public $offer;
    //////////////////////////
    public $fullname;
    public $phone;
    public $competition_img;
    public $slide = [];

    //////////////////////////
    public $translations;
    public $translations_resto;
    public $qr_code = null;
    public $user_details = null;
    public $scroll = false;

    protected $listeners = ['indexRender' => 'renderComponent'];

    public function mount($scroll = false)
    {
        $this->scroll = $scroll;

        $json = app('translations');
        $this->translations = $json['system'];
        $this->translations_resto = $json['resto'];

        $this->store_meta = env('STOR_NAME');
        $stores = Cache::get('stores');

        if (isset($stores[$this->store_meta])) {
            $this->store_info = $stores[$this->store_meta];
        } else {
            $this->store_info = Store::where('store_meta', $this->store_meta)->first();
            $stores[$this->store_meta] = $this->store_info;
            Cache::put('stores', $stores, 7200);

        }

        $this->store_id = $this->store_info->id;

        $this->all_data = Index::where('store_id', $this->store_id)->whereIn('name', ['index1','home_header1','competition_home1'])->get();
        $this->slide_data = $this->all_data->where('name', 'home_header1');
        $this->index_data = $this->all_data->where('name', 'index1')->first();
        $this->competion_data = $this->all_data->where('name', 'competition_home1')->first();

        $this->competition_img = $this->competion_data?->images;
        if ($this->competition_img) {
            $this->competition_img = json_decode($this->competition_img, true);
            $this->competition_img = $this->competition_img['img_1'];
        }

     

        ////////////////////////////////////////////////////////////////


        // if(count($this->slide_data) != 0){
      
        //     foreach ($this->slide_data as $value) {

        //         $title = $value->getTranslation('titles', 'en');
        //         $title = json_decode($title, true);
        //         $title = $title['title-1'] ?? '';

        //         $text = $value->getTranslation('texts', 'en');
        //         $text = json_decode($text, true);
        //         $text = $text['texts-1'] ?? '';

        //         $url =  $value->urls ; 

        //         $btn = $value->getTranslation('buttons', 'en');
        //         $btn = json_decode($btn, true);
        //         $btn = $btn['btn-1'] ?? '';

        //         $image = $value->images;
        //         $image = json_decode($image, true);
        //         $image = $image['img-1'] ?? '';

        //         $this->slides[$value->id] = array(
        //             'image' => $image,
        //             'title' => $title,
        //             'text'  => $text,
        //             'url'   => $url,
        //             'btn'   => $btn,
        //         );

        //     }

        // }
        ////////////////////////////////////////////////////////////////

        
        if (empty($this->index_data)) {
            $data = new Index();
            $data->name = 'index1';
            $data->store_id = $this->store_id;
            $data->language = 'EN';
            $data->save();
        } else {
            $this->titles = $this->index_data->titles;
            $this->titles = json_decode($this->titles, true);

            $this->buttons = $this->index_data->buttons;
            $this->buttons = json_decode($this->buttons, true);

            $this->images = $this->index_data->images;
            $this->images = json_decode($this->images, true);

            $this->texts = $this->index_data->texts;
            $this->texts = json_decode($this->texts, true);

            $this->urls = $this->index_data->urls;
            $this->urls = json_decode($this->urls, true);

        }

        $this->products = StoreProduct::select('store_products.*')
            ->where('store_id', $this->store_id)
            ->where('to_menu', 1)
            ->with('media')
            ->limit(16)
            ->get();

        $offers = Cache::get('offers');

        if (isset($offers[$this->store_meta])) {
            $this->offers = $offers[$this->store_meta];

        } else {

            $this->offers = Offer::where('status', 1)
                ->with(['products' => function ($q) {
                    $q->with(['product' => function ($q) {
                        $q->with('media');

                    }]);
                }])
                ->get();
            $offers[$this->store_meta] = $this->offers;
            Cache::put('offers', $offers, 7200);

        }

        if (isset($this->store_info->currency)) {
            $this->currency = Currencies::getSymbol($this->store_info->currency);
        } else {
            $this->currency = 'DH';
        }

    }

    public function render()
    {
        return view('livewire.index1.index');
    }
    public function DownloadQR()
    {
        $date = $this->user_details->created_at->format('d-m-Y H:i');

        // Ensure $date is UTF-8 encoded
        $date = utf8_encode($date);

        ///// logo
        $imagePath = public_path('assets/images/png/print_logo.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $logoBase64 = 'data:image/png;base64,' . $imageData;

        $user_data = array(
            'name' => $this->user_details->fullname,
            'phone' => $this->user_details->phone,
        );
        $data = [
            'data' => $user_data,
            'qrcode' => $this->qr_code,
            'date' => $date,
            'logoBase64' => $logoBase64,
        ];

        $pdf = new Dompdf();
        $pdf->loadHtml(View::make('livewire.index1.qr_code', $data));
        $pdf->setPaper([0, 0, 250, 500], 'portrait'); // Set the paper size to match the width of an 80mm POS printer
        $pdf->render();

        return $pdf->stream('goodforhealth_invitation.pdf');

        // $this->dispatchBrowserEvent('pdfRendered', [
        //     'pdfData' => base64_encode($pdf->output()),
        // ]);

    }

    public function CompetitionRegister()
    {
        $check = CompitionClient::where('phone', $this->phone)->whereNull('date_scan')->first();
        $this->validate([
            'fullname' => 'required|string|max:50',
            'phone' => ['required', 'digits:10', new PhoneValidation()],
        ]);

        if (!$check) {
            $client = new CompitionClient();
            $client->phone = $this->phone;
            $client->fullname = $this->fullname;
            $client->save();

            $this->user_details = $client;
            $this->qr_code = DNS2D::getBarcodeHTML(url('/competition/' . $client->phone), 'QRCODE');

            // $this->dispatchBrowserEvent('swal:modal', [
            //     'type' => 'success',
            //     'message' => $this->translations_resto['competition_thanks'],
            //     'text' => $this->translations_resto['competition_thanks_msg'],
            // ]);
        } elseif ($check->fullname == $this->fullname) {
            $this->user_details = $check;
            $this->qr_code = DNS2D::getBarcodeHTML(url('/competition/' . $check->phone), 'QRCODE');

        } else {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'warning',
                'message' => $this->translations_resto['competition_ready_in'],
                'text' => $this->translations_resto['competition_ready_in_msg'],
            ]);
        }
    }

    public function renderComponent()
    {
        $x = 1;
    }

}
