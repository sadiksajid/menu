<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Header extends Component
{

    public $store_info;
    public $store_meta;
    protected $listeners = ['renderHeader' => 'renderHere', 'checkLanguage'];
    public $languages = array('ma' => 'عربية', 'en' => 'English', 'fr' => 'Français');
    public $flag = array('ar' => 'ma', 'en' => 'en', 'fr' => 'fr');
    public $current_lang;

    
    public function mount($store)
    {
        $this->current_lang = Cache::get('locale_user') ?? 'en';
        $this->store_info = $store ;
     

    }
    public function render()
    {
        return view('layouts-index1.header');
    }

    public function renderHere()
    {
        $x = 1;
    }

    public function changeLang($lang, $redirect = false)
    {
        if ($lang == 'ma') {
            $lang = 'ar';
        }
        Cache::put('locale_user', $lang, 86400);
        if ($redirect != false) {
            return redirect($redirect);

        }
    }

    public function checkLanguage()
    {
        if (!Cache::has('locale_user')) {
            $this->dispatchBrowserEvent('swal:chamgeLanguage');
        }
    }

}
