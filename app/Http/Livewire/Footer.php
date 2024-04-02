<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Footer extends Component
{

    public $store_info;
    public $store_meta;

    public function mount()
    {
        $this->store_meta = 'sadik_store';
        $stores = Cache::get('stores');

        if (isset($stores[$this->store_meta])) {
            $this->store_info = $stores[$this->store_meta];
        } else {
            $this->store_info = Store::where('store_meta', $this->store_meta)->first();
            $stores[$this->store_meta] = $this->store_info;
            Cache::put('stores', $stores, 7200);

        }
    }
    public function render()
    {

        return view('layouts-index1.footer');

    }

}
