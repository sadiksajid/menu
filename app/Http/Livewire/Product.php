<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Intl\Currencies;
use Illuminate\Support\Facades\Session;

class Product extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $store_info;
    public $product_info;
    public $currency;
    public $qte = 1;
    public $store_meta;

    protected $listeners = ['changeQte'];
////////////////////////////
    public $translations;

    public function mount($store_info, $product_info)
    {
        $json = app('translations');
        $this->translations = $json['system'];

        $this->store_meta = $store_info->store_meta;
        $this->store_info = $store_info;
        $this->product_info = $product_info;
        Cache::put('last_store', $this->store_meta);

        setView('product', $this->store_info->id, $product_info->id);

        $info = Cache::get('store_info') ?? [];
        if (!isset($info[$this->store_meta])) {
            if (isset($store_info->currency)) {
                $this->currency = Currencies::getSymbol($this->store_info->currency);
            } else {
                $this->currency = 'DH';
            }
            $info[$this->store_meta]['currency'] = $this->currency;
            $info[$this->store_meta]['title'] = $this->store_info->title;
            $info[$this->store_meta]['selected'] = false;
            Cache::put('store_info', $info);

        } else {
            $this->currency = $info[$this->store_meta]['currency'] ?? 'MAD';
        }

    }
    public function render()
    {
        return view('livewire.product.product', ['product' => $this->product_info]);
    }
    public function addToCart($is_buy_now = 0)
    {
        // Cache::clear();
        if (Session::has('my_cart')) {
            $cart = Session::get('my_cart');
        } else {
            $cart = [];
        }

        if (isset($cart[$this->store_meta][$this->product_info->product_meta])) {
            $cart[$this->store_meta][$this->product_info->product_meta]['qte'] = $cart[$this->store_meta][$this->product_info->product_meta]['qte'] + $this->qte;
        } else {
            $cart[$this->store_meta][$this->product_info->product_meta] = array(
                'qte' => $this->qte,
                'product' => $this->product_info,
                'image' => $this->product_info->media[0]->media,
                'type' => 'product',

            );
        }

        Session::put('my_cart', $cart);

        if($is_buy_now == 0){
            $this->emit('updateComponent');
        }else{
            return redirect()->to('/client/checkout');

        }

    }
    public function changeQte($qte)
    {
        $this->qte = $qte[0];
    }

}
