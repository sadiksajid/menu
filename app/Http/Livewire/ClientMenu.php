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

class ClientMenu extends Component
{
    public $titles = [];
    public $images = [];

    public $menu_head;
    public $titles_menu;
    public $texts_menu;

    
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

    public function mount($store)
    {

        $json = app('translations');
        $this->translations = $json['system'];
        $this->translations_resto = $json['resto'];

        $this->store_meta = $store->store_meta;

        $this->store_info = $store;

        $this->store_id = $this->store_info->id;

        $this->categories = ProductCategory::where('store_id', $this->store_id)
            ->select('product_categories.*')
            ->orderBy('sort','asc')
            ->get();
            
        $products = StoreProduct::select('store_products.*')
            ->where('store_products.store_id', $this->store_id)
            ->where('store_products.to_menu', 1)
            ->with('media')
            ->get();
        Cache::put('products', $products);

        $this->products = $products ;

        if (isset($this->store_info->currency)) {
            $this->currency = Currencies::getSymbol($this->store_info->currency);
        } else {
            $this->currency = 'DH';
        }

        $this->menu_head = Index::where('store_id', $this->store_info->id)->where('name', 'menu1')->first();
        if (!empty($this->menu_head)) {
            $this->titles_menu = $this->menu_head->titles;

            $this->titles_menu = json_decode($this->titles_menu, true);
            $this->titles_menu = $this->titles_menu['title-1'];

            $this->images_menu = $this->menu_head->images;
            $this->images_menu = json_decode($this->images_menu, true);
            $this->images_menu = $this->images_menu['img_1'];

            $this->texts_menu = $this->menu_head->texts;
            $this->texts_menu = json_decode($this->texts_menu, true);
            $this->texts_menu = $this->texts_menu['texts-1'];

        }

    }

    public function render()
    {
        return view('livewire.menu1.menu');
    }

    public function addToCart($id, $type = 1)
    {
        $this->emit('ProductToCart', $id, $type);

    }

    public function generatePdf()
    {

        $html = view('menu-pdf.menu-1', ['products' => $this->products, 'currency' => $this->currency])->toArabicHTML();
        // dd($html);
        $pdf = Pdf::loadHTML($html)->output();

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf;
        }, 'report.pdf', [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline', // Set to 'inline' for browser view
        ]);

    }

}
