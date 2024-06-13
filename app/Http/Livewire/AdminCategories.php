<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AdminCategories extends Component
{
    use WithFileUploads;

    
    //////////////////////////
    public $translations;
    public $store_id;
    public $langs;
    public $store_info;
    public $categories = [];
    public $search_category = null;
    public $cat_image = null;

    protected $listeners = ['confirmed','checkUniqueTitle','render'];

    public function mount()
    {
        $this->langs = languages()['langs'];
        $this->translations = app('translations_admin');
        ///////////////////////////////////
        $this->store_info = Auth::user()->store;
        $this->store_id = $this->store_info->id;

        $this->getCategories();
    }
    public function render()
    {
        return view('livewire.admin.categories.table');
    }
    public function getCategories()
    {
        app()->setLocale('en');

        $this->categories = ProductCategory::where('store_id', $this->store_id)->get();
        dd($this->categories[0]);
    }
}
