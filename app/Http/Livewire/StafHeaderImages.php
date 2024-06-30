<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\StafTag;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\StafTagToTable;
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
    public $img_tags =[];

    public $translations;
    public $store_id;
    public $langs;
    public $store_info;
    public $Images = [];
    public $search_image = false;
    public $search_tags = null;
    public $img_image;
    public $image_to_delete = null;
    public $image_to_update = null;
    public $tags_to_update = null;


    protected $listeners = ['confirmDelete','submitImage','UpdateImage','Search','clearSearch'];

    public function mount()
    {
        $this->langs = languages()['langs'];
        $this->getImages();
    }
    public function render()
    {
        $all_iamges = Cache::get('staf_all_images') ?? [];
        return view('livewire.staf.header_images.images_list',['all_iamges' => $all_iamges]);
    }

    public function clearSearch()
    {
        $this->search_image = false;
        $this->search_tags = [];

        $this->getImages();
    }

    public function Search($data)
    {
        $this->search_image = true;
        // $this->search_tags = StafTag::whereIn('en_tags',$data['tags'])->select('id')->get()->pluck('id');
        $this->search_tags =  $data['tags'];
        $this->getImages();
    }


    public function getImages($page = 1)
    {
        // $in_cache = false ; 
        // if(Cache::has('page_staf_images')){
        //     if(Cache::get('page_staf_images') >= $page and Cache::has('staf_all_images')){
        //         $in_cache = true ; 
        //     }
        // }

        // if($in_cache == false){
        // dd($this->search_tags );
            // $data = StafHeaderImage::
            // Join('staf_tag_to_tables','staf_tag_to_tables.staf_header_image_id','staf_header_images.id')
            // ->Join('staf_tags','staf_tags.id','staf_tag_to_tables.staf_tag_id')
            // ->when($this->search_tags,function($q){
            //     $q->whereIn('staf_tags.en_tags',$this->search_tags);
            // })
            // // ->with('tags')
            // ->paginate($this->paginat, ['*'], 'page', $page);

            $data = StafHeaderImage::
            when($this->search_tags,function($q){
                // $q->leftJoin('staf_tag_to_tables','staf_tag_to_tables.staf_header_image_id','staf_header_images.id');

                // $q->whereIn('staf_tag_to_tables.staf_tag_id',$this->search_tags);

                $q->whereHas('tags', function($q) {
                    $q->whereIn('en_tags', $this->search_tags);
                });

            })
            ->with('tags')
            ->paginate($this->paginat, ['*'], 'page', $page);

            
            if ($page > 1) {
                $all_images = Cache::get('staf_all_images');
                $data = $all_images->merge($data);
            }

            Cache::put('staf_all_images', $data);
            Cache::put('page_staf_images', $page);


        // }
       
    }

    
    public function submitImage($data)
    {
       
        $this->img_tags = array_map('strtolower', $data['tags']); 
        
        $validator = Validator::make(
            [
                'img_tags' => $this->img_tags,
                'img_image' => $this->img_image,

            ],
            [
            'img_tags.*' => 'required|string|max:50',
            'img_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    
        if ($validator->fails()) {
            $this->dispatchBrowserEvent('swal:error', [
                'type' => 'error',
                'title' => 'Oooops!',
                'errors' => $validator->errors()->toArray(),
            ]);
            
        }else{


            if (!empty($this->img_image)) {
                $this->img_link = 'Image_'. md5(microtime()) . '.webp';
                $image = File::get($this->img_image->getRealPath());
                $save_result = save_livewire_filetocdn($image, 'staf_header_images', $this->img_link);
    
                $this->img_link = 'staf_header_images/' . $this->img_link;
    
                if ($save_result) {

                    $image  = array(
                        'image'=>$this->img_link,
                        'created_at' =>Carbon::now(),
                    );
                    
                    $img_id = StafHeaderImage::insertGetId($image);

                }
    
            }


            if(isset($img_id)){
                
                $exist_tags = StafTag::whereIn('en_tags',$this->img_tags)->select('id','en_tags')->get();

                $imag_to_tags = [];
                foreach ($exist_tags as $tag) {

                        $imag_to_tags[]  = array(
                            'staf_tag_id'=>$tag->id,
                            'staf_header_image_id'=>$img_id,
                            'created_at' =>Carbon::now(),
                        );
                                            
                    
                }


                $new_tags_ids = [];
                foreach ($this->img_tags as $tag) {
                    if(count($exist_tags->where('en_tags',$tag)) == 0){

                        $new_tags  = array(
                            'en_tags'=>$tag,
                            'fr_tags'=>translate($tag,'fr'),
                            'ar_tags'=>translate($tag,'ar'),
                            'created_at' =>Carbon::now(),
                        );
                        
                        $id = StafTag::insertGetId($new_tags);
                        $imag_to_tags[]  = array(
                            'staf_tag_id'=>$id,
                            'staf_header_image_id'=>$img_id,
                            'created_at' =>Carbon::now(),
                        );
                    }
                }
    
                if(count($imag_to_tags) != 0){
                    StafTagToTable::insert($imag_to_tags);
                } 

                
        
                $this->getImages();
        
        
                $this->dispatchBrowserEvent('swal:finish', [
                    'type' => 'success',
                    'title' => 'Image saved Successfully!',
                ]);

            }else{
                $this->dispatchBrowserEvent('swal:finish', [
                    'type' => 'error',
                    'title' => 'Image Not saved!',
                ]);
            }
    
        }

    }
//////////////////////////////////////////////
    public function deleteImage($id)
    {
        $this->image_to_delete = $id ;
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Delete Image!',
            'message' => 'Are you sure you want to delete image ?',
            'function' => 'confirmDelete'
        ]);
    }
    public function confirmDelete()
    {
        $img  =  StafHeaderImage::find($this->image_to_delete);
        StafTagToTable::where('staf_header_image_id',$this->image_to_delete)->delete();
        deleteFile($img->image);
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
    $this->image_to_update  = $id ; 
    $this->tags_to_update = $image->tags->pluck('en_tags')->toArray() ; 
    
    $this->dispatchBrowserEvent('edit_image', [
        'tags' => $this->tags_to_update,
        'img_image' => get_image('tmb/'.$image->image ) ,
    ]);
}


    public function UpdateImage($data)
    {


        $validator = Validator::make(
            [
                'img_tags' => $this->img_tags,

            ],
            [
            'img_tags.*' => 'required|string|max:50',
        ]);


      


    
        if ($validator->fails()) {
            $this->dispatchBrowserEvent('swal:error', [
                'type' => 'error',
                'title' => 'Oooops!',
                'errors' => $validator->errors()->toArray(),
            ]);
            
        }else{

            $this->img_tags = array_map('strtolower', $data['tags']); 

            // Find deleted items (items in oldArray but not in newArray)
            $deletedItems = array_diff($this->tags_to_update, $this->img_tags);
    
            // Find new items (items in newArray but not in oldArray)
            $newItems = array_diff($this->img_tags, $this->tags_to_update);
    
            // Find unchanged items (items present in both arrays)
            $unchangedItems = array_intersect($this->tags_to_update, $this->img_tags);
    
    
            if(count($deletedItems) != 0){
                $deleted_tags = StafTag::whereIn('en_tags',$deletedItems)->select('id')->get();
                if(count($deleted_tags)!=0){
                    $ids =  $deleted_tags->pluck('id')->toArray();
                    StafTagToTable::where('staf_header_image_id',$this->image_to_update)->whereIn('staf_tag_id',$ids)->delete();
    
                }
            }
    
            if (count($newItems)!=0) {
                $exist_tags = StafTag::whereIn('en_tags',$newItems)->select('id','en_tags')->get();
    
                $imag_to_tags = [];
                foreach ($exist_tags as $tag) {
    
                        $imag_to_tags[]  = array(
                            'staf_tag_id'=>$tag->id,
                            'staf_header_image_id'=>$this->image_to_update,
                            'created_at' =>Carbon::now(),
                        );
                                            
                    
                }
    
    
                $new_tags_ids = [];
                foreach ($newItems as $tag) {
                    if(count($exist_tags->where('en_tags',$tag)) == 0){
    
                        $new_tags  = array(
                            'en_tags'=>$tag,
                            'fr_tags'=>translate($tag,'fr'),
                            'ar_tags'=>translate($tag,'ar'),
                            'created_at' =>Carbon::now(),
                        );
                        
                        $id = StafTag::insertGetId($new_tags);
                        $imag_to_tags[]  = array(
                            'staf_tag_id'=>$id,
                            'staf_header_image_id'=>$this->image_to_update,
                            'created_at' =>Carbon::now(),
                        );
                    }
                }
    
                if(count($imag_to_tags) != 0){
                    StafTagToTable::insert($imag_to_tags);
                }     
    
            }
    
            $this->getImages();
            $this->image_to_update = null ; 
            $this->tags_to_update = [];
            $this->dispatchBrowserEvent('swal:finish', [
                'type' => 'success',
                'title' => 'Image Updated Successfully!',
            ]);
    
        }

    }




}