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
    public $img_image;
    public $image_to_delete = null;
    public $image_to_update = null;


    protected $listeners = ['confirmDelete','submitImage','UpdateImage'];

    public function mount()
    {
        $this->langs = languages()['langs'];
        $this->getImages();
    }
    public function render()
    {
        $all_iamges = Cache::get('all_iamges') ?? [];

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
    
            paginate($this->paginat, ['*'], 'page', $page);

            if ($page > 1) {
                $all_images = Cache::get('all_images');
                $data = $all_images->merge($data);
            }

            Cache::put('all_images', $data);
            Cache::put('page', $page);


        }
       
    }

    
    public function submitImage()
    {
       
        $validator = Validator::make(
            [
                'img_tags' => $this->img_tags,
                'img_image' => $this->img_image,

            ],
            [
            'img_tags' => 'required|integer|max:99999',
            'img_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    
        if ($validator->fails()) {
            $this->dispatchBrowserEvent('swal:error', [
                'type' => 'error',
                'title' => 'Oooops!',
                'errors' => $validator->errors()->toArray(),
            ]);
            
        }else{

            $img = new StafHeaderImage();

            foreach ($this->langs as $lang) {
                if ($lang == 'en') {
                    $img_tags = $this->img_tags;
                } else {
                    $img_tags = translate($this->img_tags, $lang);
                }

                $img->tags_.$lang = $img_tags;
    
            }
    
        
            if (!empty($this->img_image)) {
                $this->img_link = 'Image_' . str_replace(' ', '_', $this->img_title) . md5(microtime()) . '.webp';
                $image = File::get($this->img_image->getRealPath());
                $save_result = save_livewire_filetocdn($image, 'staf_header_images', $this->img_link, $this->catigory_sizes);
    
                $this->img_link = 'staf_header_images/' . $this->img_link;
    
                if ($save_result) {
                    $img->image = $this->img_link;
                }
    
            }
            $img->save();
    
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
        
        $img  =  StafHeaderImage::find($this->image_to_delete);
        deleteFile($img->image,$this->catigory_sizes);
        $img->delete();

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

    $this->img_title =  $image->title ;
    $this->img_sub_title =  $image->s_title ;
    $this->img_sort =  $image->sort ;

    $this->dispatchBrowserEvent('edit_image', [
        'img_title' => $image->title,
        'img_sub_title' => $image->s_title,
        'img_sort' => $image->sort,
        'img_image' => get_image('tmb/'.$image->image ) ,
    ]);
}


    public function UpdateImage()
    {
       
        $validator = Validator::make(
            [
                'img_title' => $this->img_title,
                'img_sub_title' => $this->img_sub_title,
                'img_sort' => $this->img_sort,
                'img_image' => $this->img_image,

            ],
            [
            'img_title' => 'required|string|max:50',
            'img_sub_title' => 'required|string|max:100',
            'img_sort' => 'required|integer|max:9999',
            'img_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    
        if ($validator->fails()) {
            $this->dispatchBrowserEvent('swal:error', [
                'type' => 'error',
                'title' => 'Oooops!',
                'errors' => $validator->errors()->toArray(),
            ]);
            
        }else{

            $img = StafHeaderImage::find($this->image_to_update);
            foreach ($this->langs as $lang) {
                if ($lang == 'en') {
                    $title = $this->img_title;
                    $img_s_title = $this->img_sub_title;
                } else {
                    $title = translate($this->img_title, $lang);
                    $img_s_title = translate($this->img_sub_title, $lang);
                }
    
                $img->setTranslation('title', $lang, $title, JSON_UNESCAPED_UNICODE);
                $img->setTranslation('s_title', $lang, $img_s_title, JSON_UNESCAPED_UNICODE);
    
            }
    
            $img->store_id = $this->store_id;
            $img->sort = $this->img_sort;
            $img->image_meta = str_replace([' ', ',', ':', '-', '?'], '_', strtolower($this->img_title));
    
            if (!empty($this->img_image)) {
                $this->img_link = 'Image_' . str_replace(' ', '_', $this->img_title) . md5(microtime()) . '.webp';
                $image = File::get($this->img_image->getRealPath());
                $save_result = save_livewire_filetocdn($image, 'Images', $this->img_link, $this->catigory_sizes);
    
                $this->img_link = 'Images/' . $this->img_link;
    
                if ($save_result) {

                    deleteFile($img->image,$this->catigory_sizes);
                    $img->image = $this->img_link;
                }
    
            }
            $img->save();
    
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
        
    $this->img_title = '';
    $this->img_sub_title = '';
    $this->img_sort = '';
    }


}
