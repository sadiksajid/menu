<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CategoryToStore;
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
        $currentLocale = app()->getLocale();

        $this->categories = CategoryToStore::Join('product_categories as cat', 'category_to_stores.product_category_id', 'cat.id')
            ->where('category_to_stores.store_id', $this->store_id)
            ->select('cat.id', 'cat.title->' . $currentLocale . ' as title', 'cat.s_title->' . $currentLocale . ' as s_title','cat.image as image_origin','category_to_stores.image','category_to_stores.sort','category_to_stores.created_at','category_to_stores.updated_at')
            ->get()->toArray();
    }
}
