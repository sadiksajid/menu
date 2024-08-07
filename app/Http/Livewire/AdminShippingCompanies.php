<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminShippingCompanies extends Component
{
    //////////////////////////////////////////
    public $translations = null ;
    public $langs = null ;

    public function mount()
    {
        $this->translations = app('translations_admin');
        $this->langs = languages()['langs'];
        ///////////////////////

    }
    public function render()
    {
        return view('livewire.admin.shipping_companies.shipping_companies_list');
    }
    


}