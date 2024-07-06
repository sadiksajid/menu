<?php

namespace App\Http\Livewire;

use App\Models\Store;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Header extends Component
{

    public $store_info;
    public $store_meta;
    protected $listeners = ['renderHeader' => 'renderHere', 'checkLanguage'];
    public $languages = array('ma' => 'عربية', 'en' => 'English', 'fr' => 'Français');
    public $flag = array('ar' => 'ma', 'en' => 'en', 'fr' => 'fr');
    public $current_lang;
    public function mount()
    {

        if (Session::has('locale_user')) {
            $this->current_lang  = Session::get('locale_user', config('app.locale'));
        } else {
            $this->current_lang  = 'en';
        }


        $this->store_meta = env('STOR_NAME');
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
        Session::put('locale_user', $lang);

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
