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

    
    public $cat_title;
    public $cat_s_title;
    public $cat_sort;
    //////////////////////////

    public $translations;
    public $store_id;
    public $langs;
    public $store_info;
    public $categories = [];
    public $search_category = null;
    public $cat_image = null;

    protected $listeners = ['confirmed','checkUniqueTitle','submitCategory'];

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

    public function clearSearch()
    {
        $this->search_category = null;
        $this->getCategories();
    }

    
    public function getCategories()
    {
        $this->categories = ProductCategory::where('store_id', $this->store_id)
        ->when($this->search_category,function($q){
            $q->where('title','LIKE','%'.$this->search_category.'%');
        })
        ->get();
    }

    
    public function submitCategory()
    {

        $this->validate([
            'cat_title' => 'required|string|max:50',
            'cat_s_title' => 'required|string|max:100',
            'cat_sort' => 'required|string|max:100',
            'cat_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $cat = new ProductCategory();

        foreach ($this->langs as $lang) {
            if ($lang == 'en') {
                $title = $this->cat_title;
                $cat_s_title = $this->cat_s_title;
            } else {
                $title = translate($this->cat_title, $lang);
                $cat_s_title = translate($this->cat_s_title, $lang);
            }

            $cat->setTranslation('title', $lang, $title, JSON_UNESCAPED_UNICODE);
            $cat->setTranslation('s_title', $lang, $cat_s_title, JSON_UNESCAPED_UNICODE);

        }

        $cat->store_id = $this->store_id;
        $cat->sort = $this->cat_sort;
        $cat->category_meta = str_replace([' ', ',', ':', '-', '?'], '_', strtolower($this->cat_title));

        if (!empty($this->cat_image)) {
            $this->img_link = 'Category_' . str_replace(' ', '_', $this->cat_title) . md5(microtime()) . '.webp';
            $image = File::get($this->cat_image->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'categories', $this->img_link, $this->catigory_sizes);

            $this->img_link = 'categories/' . $this->img_link;

            if ($save_result) {
                $cat->image = $this->img_link;
            }

        }
        $cat->save();

        $this->getCategories();


        $this->dispatchBrowserEvent('swal:finish', [
            'type' => 'success',
            'title' => 'Category saved Successfully!',
        ]);


    }

    
}
