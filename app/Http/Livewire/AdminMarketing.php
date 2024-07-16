<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AdminMarketing extends Component
{

    public $store_meta ;
    public $store_url ;
////////////////////////////////
    public $langs;
    public $translations;

    public function mount()
    {

        $this->langs = languages()['langs'];
        $this->translations = app('translations_admin');
        ///////////////////////////////////
        $this->store_meta = Auth::user()->store->store_meta ;
        $this->store_url = Request::root().$this->store_meta.'/menu';

    }
    public function render()
    {
        return view('livewire.admin.marketing.marketing');

    }


}
