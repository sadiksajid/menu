<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Models\Store;
use App\Models\StoreProduct;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Symfony\Component\Intl\Currencies;

class MenuHome extends Component
{
    public $titles = [];
    public $images = [];

    public $store_meta;
    public $store_id;
    public $store_info;

    public $data;
    public $upload_image;
    public $products;
    public $currency;
    //////////////////////////
    public $translations;
    public $translations_resto;

    public function mount()
    {
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

        $products = StoreProduct::select('store_products.*')
            ->where('store_id', $this->store_id)
            ->where('to_menu', 1)
            ->with('media')
            ->with('category')
            ->get();

        Cache::put('products', $products);

        $this->products = $products->groupBy('product_category_id')->toArray();
        // dd($this->products);
        if (isset($this->store_info->currency)) {
            $this->currency = Currencies::getSymbol($this->store_info->currency);
        } else {
            $this->currency = 'DH';
        }

        $data = Menu::where('store_id', $this->store_id)->where('name', 'menu1')->first();
        $this->titles = $data->titles;
        $this->titles = json_decode($this->titles, true);

        $this->images = $data->images;
        $this->images = json_decode($this->images, true);

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
