<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminCategories extends Component
{
    use WithFileUploads;

    
    public $cat_title;
    public $cat_s_title;
    public $cat_sort;
    public $cat_sub_title ;
    //////////////////////////

    public $translations;
    public $store_id;
    public $langs;
    public $store_info;
    public $categories = [];
    public $search_category = null;
    public $cat_image;
    public $category_to_delete = null;
    public $category_to_update = null;

    public $catigory_sizes = ['tmb' => ['w' => 150, 'h' => 150], 'origin' => ['w' => 300, 'h' => 300]];

    protected $listeners = ['confirmDelete','submitCategory','UpdateCategory'];

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
        ->withCount('products')
        ->get();
        $this->cat_sort = $this->categories->max('sort') + 1;
    }

    
    public function submitCategory()
    {
       
        $validator = Validator::make(
            [
                'cat_title' => $this->cat_title,
                'cat_sub_title' => $this->cat_sub_title,
                'cat_sort' => $this->cat_sort,
                'cat_image' => $this->cat_image,

            ],
            [
            'cat_title' => 'required|string|max:50',
            'cat_sub_title' => 'required|string|max:100',
            'cat_sort' => 'required|integer|max:99999',
            'cat_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    
        if ($validator->fails()) {
            $this->dispatchBrowserEvent('swal:error', [
                'type' => 'error',
                'title' => 'Oooops!',
                'errors' => $validator->errors()->toArray(),
            ]);
            
        }else{

            $cat = new ProductCategory();

            foreach ($this->langs as $lang) {
                if ($lang == 'en') {
                    $title = $this->cat_title;
                    $cat_s_title = $this->cat_sub_title;
                } else {
                    $title = translate($this->cat_title, $lang);
                    $cat_s_title = translate($this->cat_sub_title, $lang);
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
//////////////////////////////////////////////
    public function deleteCategory($id,$title)
    {
        $this->category_to_delete = $id ;
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Delete Category!',
            'message' => 'Are you sure you want to delete '.$title.' category ?',
            'function' => 'confirmDelete'
        ]);
    }
    public function confirmDelete()
    {
        
        $cat  =  ProductCategory::find($this->category_to_delete);
        deleteFile($cat->image,$this->catigory_sizes);
        $cat->delete();

        $this->getCategories();

        $this->dispatchBrowserEvent('swal:finish', [
            'type' => 'success',
            'title' => 'Category deleted Successfully!',
        ]);
    }
//////////////////////////////////////////////

public function editCategory($id)
{
    $category = ProductCategory::find($id);
    $this->category_to_update = $id ; 

    $this->cat_title =  $category->title ;
    $this->cat_sub_title =  $category->s_title ;
    $this->cat_sort =  $category->sort ;

    $this->dispatchBrowserEvent('edit_category', [
        'cat_title' => $category->title,
        'cat_sub_title' => $category->s_title,
        'cat_sort' => $category->sort,
        'cat_image' => get_image('tmb/'.$category->image ) ,
    ]);
}


    public function UpdateCategory()
    {
       
        $validator = Validator::make(
            [
                'cat_title' => $this->cat_title,
                'cat_sub_title' => $this->cat_sub_title,
                'cat_sort' => $this->cat_sort,
                'cat_image' => $this->cat_image,

            ],
            [
            'cat_title' => 'required|string|max:50',
            'cat_sub_title' => 'required|string|max:100',
            'cat_sort' => 'required|integer|max:9999',
            'cat_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    
        if ($validator->fails()) {
            $this->dispatchBrowserEvent('swal:error', [
                'type' => 'error',
                'title' => 'Oooops!',
                'errors' => $validator->errors()->toArray(),
            ]);
            
        }else{

            $cat = ProductCategory::find($this->category_to_update);
            foreach ($this->langs as $lang) {
                if ($lang == 'en') {
                    $title = $this->cat_title;
                    $cat_s_title = $this->cat_sub_title;
                } else {
                    $title = translate($this->cat_title, $lang);
                    $cat_s_title = translate($this->cat_sub_title, $lang);
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

                    deleteFile($cat->image,$this->catigory_sizes);
                    $cat->image = $this->img_link;
                }
    
            }
            $cat->save();
    
            $this->getCategories();
            $this->category_to_update = null ; 
    
            $this->dispatchBrowserEvent('swal:finish', [
                'type' => 'success',
                'title' => 'Category Updated Successfully!',
            ]);
    
        }

    }

    public function clearinputs()
    {
        
    $this->cat_title = '';
    $this->cat_sub_title = '';
    $this->cat_sort = '';
    }


}
