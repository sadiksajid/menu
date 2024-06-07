<?php

namespace App\Http\Livewire;

use App\Models\Index;
use App\Models\Store;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CartView extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $store_info;
    public $product_info;
    public $currency;
    public $total = 0;
    public $qte = 0;
    public $quantity = [];
    public $store_meta;
    public $titles_cart;
    public $images_cart;
    //////////////////////////
    public $translations;
    public $translations_resto;
    public function mount()
    {
        $json = app('translations');
        $this->translations = $json['system'];
        $this->translations_resto = $json['resto'];
        // $this->store_info = $store_info;
        // $this->store_meta = $store_info->store_meta;

        // $info = Cache::get('store_info') ?? [];
        // if (!isset($info[$this->store_meta])) {
        //     if (isset($store_info->currency)) {
        //         $this->currency = Currencies::getSymbol($this->store_info->currency);
        //     } else {
        //         $this->currency = 'DH';
        //     }
        //     $info[$this->store_meta]['currency'] = $this->currency;
        //     $info[$this->store_meta]['title'] = $this->store_info->title;

        //     Cache::put('store_info', $info);

        // } else {
        //     $this->currency = $info[$this->store_meta]['currency'];
        // }

        $this->store_meta = env('STOR_NAME');
        $stores = Cache::get('stores');
        if (isset($stores[$this->store_meta])) {
            $this->store_info = $stores[$this->store_meta];
        } else {
            $this->store_info = Store::where('store_meta', $this->store_meta)->first();
            $stores[$this->store_meta] = $this->store_info;
            Cache::put('stores', $stores, 7200);

        }
        $cart_head = Index::where('store_id', $this->store_info->id)->where('name', 'cart1')->first();
        if (!empty($cart_head)) {
            $this->titles_cart = $cart_head->titles;
            $this->titles_cart = json_decode($this->titles_cart, true);
            $this->titles_cart = $this->titles_cart['title-1'];

            $this->images_cart = $cart_head->images;
            $this->images_cart = json_decode($this->images_cart, true);
            $this->images_cart = $this->images_cart['img_1'];

        }

    }
    public function render()
    {
        $my_cart = $this->getData(0);
        return view('livewire.cart.cart_view', ['my_cart' => $my_cart]);
    }

    public function getData($rend = 0)
    {
        $my_cart = Cache::get('my_cart') ?? [];
        $this->total = 0;
        $this->qte = 0;
        foreach ($my_cart as $store) {
            foreach ($store as $key => $item) {
                $this->quantity[$key] = $item['qte'];
                $this->qte = $this->qte + $item['qte'];
                $this->total = $this->total + ($item['product']['price'] * $item['qte']);
            }
        }

        if ($rend == 1) {
            $this->dispatchBrowserEvent('changeCartPrice', [
                'curency' => $this->currency,
                'qte' => $this->qte,
                'total' => $this->total,
            ]);
        } else {
            return $my_cart;
        }

    }

    public function changeQte($key, $store_meta)
    {
        $my_cart = Cache::get('my_cart');
        $my_cart[$store_meta][$key]['qte'] = $this->quantity[$key];
        Cache::put('my_cart', $my_cart);
        $this->emit('updateComponent');
    }

    public function removeProduct($key, $store_meta)
    {
        $my_cart = Cache::get('my_cart');
        unset($my_cart[$store_meta][$key]);
        Cache::put('my_cart', $my_cart);
        $this->emit('updateComponent');
    }

}
