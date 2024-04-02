<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Cart extends Component
{
    protected $listeners = ['updateComponent' => 'renderComponent', 'updateHeader', 'ProductToCart' => 'addToCart'];

    public $total = 0;
    public $qte_cart = 0;
    public $qte;
    public $currency = 0;
    public $store_meta;
    public $order_nbr;

    public function mount()
    {
        $this->store_meta = getStoreName();
        if ($this->store_meta == null) {
            $this->store_meta = 'sadik_store';
        }
        if (Auth::guard('client')->check()) {
            $this->order_nbr = Auth::guard('client')->user()->orders->count();
        }

    }
    public function render()
    {

        $my_cart = $this->getData(0);

        return view('livewire.cart.cart', ['my_cart' => $my_cart]);

    }
    public function renderComponent()
    {
        $x = 1;
    }

    public function getData($rend = 0)
    {
        // Cache::clear();
        $my_cart = Cache::get('my_cart') ?? [];
        $this->total = 0;
        $this->qte_cart = 0;
        foreach ($my_cart as $store) {
            foreach ($store as $item) {
                $this->qte_cart = $this->qte_cart + $item['qte'];
                $this->total = $this->total + ($item['product']['price'] * $item['qte']);
            }
        }
        $stores_info = Cache::get('store_info');

        $this->currency = $stores_info[array_key_first($my_cart)]['currency'] ?? 'DH';
        // if (!Cache::has('currency')) {
        //     $this->currency = 'DH';
        // } else {
        //     $this->currency = Cache::get('currency');
        // }
        if ($rend == 1) {

            $this->updateHeader();

        } else {
            return $my_cart;
        }

    }

    public function dehydrate()
    {
        $this->getData(1);
    }

    public function updateHeader()
    {

        $this->dispatchBrowserEvent('changeCartPrice', [
            'curency' => $this->currency,
            'qte' => $this->qte_cart ?? 0,
            'total' => $this->total ?? 0,
        ]);

        $this->dispatchBrowserEvent('changeOrdersNbr', [
            'orders_nbr' => $this->order_nbr ?? 0,

        ]);
    }

    public function removeProduct($key)
    {
        $my_cart = Cache::get('my_cart');
        unset($my_cart[$this->store_meta][$key]);

        Cache::put('my_cart', $my_cart);
        // $this->emit('indexRender');
    }

    public function addToCart($id, $type = 1, $qte = 1)
    {
        if ($type == 0) {
            $this->qte = 1;
        } else {
            $this->qte = $qte;

        }
        $all_products = Cache::get('products');
        $product_info = $all_products->where('id', $id)->first();
        if (Cache::has('my_cart')) {
            $cart = Cache::get('my_cart');
        } else {
            $cart = [];
        }

        if (isset($cart[$this->store_meta][$product_info->product_meta])) {
            $cart[$this->store_meta][$product_info->product_meta]['qte'] = $cart[$this->store_meta][$product_info->product_meta]['qte'] + $this->qte;
        } else {
            $cart[$this->store_meta][$product_info->product_meta] = array(
                'qte' => $this->qte,
                'product' => $product_info,
                'image' => $product_info->media[0]->media,
                'type' => 'product',

            );
        }

        Cache::put('my_cart', $cart);
        $this->emit('updateComponent');

    }

}
