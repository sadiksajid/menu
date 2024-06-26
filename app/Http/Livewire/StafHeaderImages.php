<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\StafHeaderImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StafHeaderImages extends Component
{
    use WithFileUploads;


    //////////////////////////
    public $paginat = 50;
    public $all_images = [];

    public $translations;
    public $store_id;
    public $langs;
    public $store_info;
    public $Images = [];
    public $search_image = null;
    public $cat_image;
    public $image_to_delete = null;
    public $image_to_update = null;


    protected $listeners = ['confirmDelete','submitImage','UpdateImage'];

    public function mount()
    {
        $this->getImages();
    }
    public function render()
    {
        $all_iamges = Cache::get('all_iamges');

        return view('livewire.staf.header_images.images_list',['all_iamges' => $all_iamges]);
    }

    public function clearSearch()
    {
        $this->search_image = null;
        $this->getImages();
    }

    
    public function getImages($page = 1, $tags = null)
    {
        $in_cache = false ; 
        if(Cache::has('page')){
            if(Cache::get('page') >= $page){
                $in_cache = true ; 
            }
        }

        if($in_cache == false){
            $data = StafHeaderImage::
            // when($category, function ($query) use ($category) {
            //     $query->where('store_products.product_category_id', $category);
            // })
            paginate($this->paginat, ['*'], 'page', $page);

            if ($page > 1) {
                $all_images = Cache::get('all_images');
                $data = $all_images->merge($data);
            }

            Cache::put('all_images', $data);
            Cache::put('page', $page);

            // $cat_name = $this->categories->where('id', $category)->first()->title ?? null;
            // $this->dispatchBrowserEvent('putProducts', [
            //     'products' => $data->toArray(),
            //     'images' => $data->pluck('media.0.media'),
            //     // 'category' => $cat_name,
            // ]);
            // return $data;
        }
       
    }

    
    public function submitImage()
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

            $cat = new StafHeaderImage();

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
            $cat->image_meta = str_replace([' ', ',', ':', '-', '?'], '_', strtolower($this->cat_title));
    
            if (!empty($this->cat_image)) {
                $this->img_link = 'Image_' . str_replace(' ', '_', $this->cat_title) . md5(microtime()) . '.webp';
                $image = File::get($this->cat_image->getRealPath());
                $save_result = save_livewire_filetocdn($image, 'Images', $this->img_link, $this->catigory_sizes);
    
                $this->img_link = 'Images/' . $this->img_link;
    
                if ($save_result) {
                    $cat->image = $this->img_link;
                }
    
            }
            $cat->save();
    
            $this->getImages();
    
    
            $this->dispatchBrowserEvent('swal:finish', [
                'type' => 'success',
                'title' => 'Image saved Successfully!',
            ]);
    
        }

    }
//////////////////////////////////////////////
    public function deleteImage($id,$title)
    {
        $this->image_to_delete = $id ;
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warninig',
            'title' => 'Delete Image!',
            'message' => 'Are you sure you want to delete '.$title.' image ?',
            'function' => 'confirmDelete'
        ]);
    }
    public function confirmDelete()
    {
        
        $cat  =  StafHeaderImage::find($this->image_to_delete);
        deleteFile($cat->image,$this->catigory_sizes);
        $cat->delete();

        $this->getImages();

        $this->dispatchBrowserEvent('swal:finish', [
            'type' => 'success',
            'title' => 'Image deleted Successfully!',
        ]);
    }
//////////////////////////////////////////////

public function editImage($id)
{
    $image = StafHeaderImage::find($id);
    $this->image_to_update = $id ; 

    $this->cat_title =  $image->title ;
    $this->cat_sub_title =  $image->s_title ;
    $this->cat_sort =  $image->sort ;

    $this->dispatchBrowserEvent('edit_image', [
        'cat_title' => $image->title,
        'cat_sub_title' => $image->s_title,
        'cat_sort' => $image->sort,
        'cat_image' => get_image('tmb/'.$image->image ) ,
    ]);
}


    public function UpdateImage()
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

            $cat = StafHeaderImage::find($this->image_to_update);
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
            $cat->image_meta = str_replace([' ', ',', ':', '-', '?'], '_', strtolower($this->cat_title));
    
            if (!empty($this->cat_image)) {
                $this->img_link = 'Image_' . str_replace(' ', '_', $this->cat_title) . md5(microtime()) . '.webp';
                $image = File::get($this->cat_image->getRealPath());
                $save_result = save_livewire_filetocdn($image, 'Images', $this->img_link, $this->catigory_sizes);
    
                $this->img_link = 'Images/' . $this->img_link;
    
                if ($save_result) {

                    deleteFile($cat->image,$this->catigory_sizes);
                    $cat->image = $this->img_link;
                }
    
            }
            $cat->save();
    
            $this->getImages();
            $this->image_to_update = null ; 
    
            $this->dispatchBrowserEvent('swal:finish', [
                'type' => 'success',
                'title' => 'Image Updated Successfully!',
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
