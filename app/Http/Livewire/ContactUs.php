<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Models\Index;
use App\Models\Store;
use Livewire\Component;
use App\Models\StoreProduct;
use App\Models\ProductCategory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Intl\Currencies;

class ContactUs extends Component
{
    public $titles = [];
    public $images = [];

    public $contact_us_head;
    public $titles_contact_us;
    public $texts_contact_us;

    
    public $store_meta;
    public $store_id;
    public $store_info;
    public $categories;

    public $data;
    public $upload_image;
    public $products = [];
    public $currency;
    //////////////////////////
    public $translations;
    public $translations_resto;

    public function mount($store_info)
    {
        $json = app('translations');
        $this->translations = $json['system'];
        $this->translations_resto = $json['resto'];

        $this->store_meta = env('STOR_NAME');
        $stores = Cache::get('stores');

        if (isset($stores[$this->store_meta])) {
            $this->store_info = $stores[$this->store_meta];
        } else {
            $this->store_info = $store_info;
            $stores[$this->store_meta] = $this->store_info;
            Cache::put('stores', $stores, 7200);

        }

        $this->store_id = $this->store_info->id;



        if (isset($this->store_info->currency)) {
            $this->currency = Currencies::getSymbol($this->store_info->currency);
        } else {
            $this->currency = 'DH';
        }

        $this->contact_us_head = Index::where('store_id', $this->store_info->id)->where('name', 'menu1')->first();
        if (!empty($this->contact_us_head)) {
            $this->titles_contact_us = $this->contact_us_head->titles;

            $this->titles_contact_us = json_decode($this->titles_contact_us, true);
            $this->titles_contact_us = $this->titles_contact_us['title-1'];

            $this->images_contact_us = $this->contact_us_head->images;
            $this->images_contact_us = json_decode($this->images_contact_us, true);
            $this->images_contact_us = $this->images_contact_us['img_1'];

            $this->texts_contact_us = $this->contact_us_head->texts;
            $this->texts_contact_us = json_decode($this->texts_contact_us, true);
            $this->texts_contact_us = $this->texts_contact_us['texts-1'];

        }

    }

    public function render()
    {
        return view('livewire.contact_us.contact_us');
    }

   


}
