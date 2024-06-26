<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Footer extends Component
{

    public $store_info;
    public $store_meta;

    public function mount($store)
    {
        $this->store_meta = $store->store_meta;

        $this->store_info = $store;


        
    }
    public function render()
    {

        return view('layouts-index1.footer');

    }

}
