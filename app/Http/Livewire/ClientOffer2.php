<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Symfony\Component\Intl\Currencies;

class ClientOffer2 extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $store_info;
    public $offer;
    public $currency;
    public $qte = 1;
    public $store_meta;

    protected $listeners = ['changeQte'];
////////////////////////////
    public $translations;
    public function mount($store_info, $offer)
    {
        $json = app('translations');
        $this->translations = $json['system'];

        $this->store_meta = $store_info->store_meta;
        $this->store_info = $store_info;
        $this->offer = $offer;
        Cache::put('last_store', $this->store_meta);

        setView('offer', $this->store_info->id, $offer->id);

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
            $this->currency = $info[$this->store_meta]['currency'];
        }

    }
    public function render()
    {
        return view('livewire.offer.offer', ['offer' => $this->offer]);
    }
    public function addToCart()
    {
        // Cache::clear();
        if (Cache::has('my_cart')) {
            $cart = Cache::get('my_cart');
        } else {
            $cart = [];
        }

        if (isset($cart[$this->store_meta][$this->offer->id])) {
            $cart[$this->store_meta][$this->offer->id]['qte'] = $cart[$this->store_meta][$this->offer->id]['qte'] + $this->qte;
        } else {
            $cart[$this->store_meta][$this->offer->id] = array(
                'qte' => $this->qte,
                'product' => $this->offer,
                'image' => $this->offer->image_squad,
                'type' => 'offer',
            );
        }

        Cache::put('my_cart', $cart);
        $this->emit('updateComponent');

    }
    public function changeQte($qte)
    {
        $this->qte = $qte[0];
    }

}
