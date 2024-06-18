<?php

namespace App\Http\Livewire;

use App\Models\Index;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminHomeHeader extends Component
{
    use WithFileUploads;

    public $keys  = [];
    public $new_key  = 0 ;
    public $title = [];
    public $image = [];
    public $text  = [];
    public $btn_url   = [];
    public $btn_text   = [];


    public $store_id;
    public $store_info;

    public $data;
    public $all_rows = [];
    public $upload_image = [];
    public $headers = [];

    public $products;
    public $currency;
    public $to_delete_image_tm = 0;
    public $to_delete_image_edit = 0;
    public $offer_image_deleted = [];
    public $langs = [];


    protected $listeners = ['editText', 'editBtn', 'editImg','ConfirmDeleteSlide'];

    ////////////////////////////////
    public $translations;

    public function mount()
    {
        $this->langs = languages()['langs'];
        $this->translations = app('translations_admin');
        ///////////////////////////////////

        $this->store_id = Auth::user()->store_id;
        $this->store_info = Auth::user()->store;
        $this->data = Index::where('store_id', $this->store_id)
        ->where('name', 'home_header1')
        ->get();

        if(count($this->data) == 0){
            $this->keys['N1'] = 'new' ; 
            $this->new_key = 'N1' ; 

        }else{
            foreach ($this->data as $value) {

                $title = $value->getTranslation('titles', 'en');
                $title = json_decode($title, true);
                $title = $title['title-1'] ?? '';
                $this->title[$value->id] = $title ; 

                $text = $value->getTranslation('texts', 'en');
                $text = json_decode($text, true);
                $text = $text['texts-1'] ?? '';
                $this->text[$value->id] = $text ; 

                $url =  $value->urls ; 
                $this->btn_url[$value->id] =  $url ; 

                $btn = $value->getTranslation('buttons', 'en');
                $btn = json_decode($btn, true);
                $btn = $btn['btn-1'] ?? '';
                $this->btn_text[$value->id] = $btn ; 

                $image = $value->images;
                $image = json_decode($image, true);
                $image = $image['img-1'] ?? '';
                $this->image[$value->id] = $image ; 


                $this->keys[$value->id] = 'old' ;
                $this->all_rows[$value->id] = array(
                    'image' => $image,
                    'title' => $title,
                    'text'  => $text,
                    'url'   => $url,
                    'btn'   => $btn,
                );
            }
        }

        $this->headers = [];
    
    }

    public function addHeader()
    {
        $this->new_key = $output = 'N'.preg_replace('/[^0-9]/', '', $this->new_key) + 1; 
        $this->keys[$this->new_key] = 'new' ; 
    }


    public function render()
    {

        return view('livewire.admin.home_header_edit.home_header_edit');

    }

    public function to_delete_image_tm($index)
    {
        $this->to_delete_image_tm = $index;
    }

    public function no_delete_image_tm()
    {
        $this->to_delete_image_tm = -1;
    }

    public function delete_image_tm($index)
    {
        $this->upload_image[$index] = null;
        $this->to_delete_image_tm = -1;
    }

    public function to_delete_image_edit($index)
    {
        $this->to_delete_image_edit = $index;
    }

    public function no_delete_image_edit()
    {
        $this->to_delete_image_edit = -1;
    }

    public function delete_image_edit($index)
    {

        if ($this->to_delete_image_edit != -1) {
            $this->offer_image_deleted[$index] = $this->image[$index];

            // deleteFile( $this->image[$index] );
            unset($this->image[$index] );
            $this->to_delete_image_edit = -1;
        }

    }

    public function deleteSlide($index)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warninig',
            'title' => 'Delete Slide!',
            'message' => 'Are you sure you want to delete this slide ?',
            'function' => 'ConfirmDeleteSlide',
            'id' => $index
        ]);

    }

    public function ConfirmDeleteSlide($index)
    {

        if (str_contains($index,'N')) {
            $this->upload_image[$index] = null;
        }else{

            if(!empty( $this->image[$index])){
                deleteFile(  $this->image[$index]);
            }
            Index::find($index)->delete();

        }

     
        unset($this->keys[$index]) ;
        unset($this->title[$index]) ;
        unset($this->text[$index]) ;
        unset($this->btn_url[$index]) ;
        unset($this->btn_text[$index]) ;
        unset($this->image[$index]) ;
        unset($this->all_rows[$index]) ;
  


    }



    public function Update()
    {

        if(count($this->offer_image_deleted) != 0){
            foreach ($this->offer_image_deleted as $key => $value) {
                deleteFile( $value );
            }

            $keys = array_keys($this->offer_image_deleted );
            Index::whereIn('id', $keys)->update(['images'=>'']);

        }

        $img_path = 'web_headers/home_slide1/' ;
        foreach ($this->keys as $key => $value ) {

            if (!empty($this->upload_image[$key])) {
                $img_link = 'header_slid_'.$key.'_'. md5(microtime()) . '.webp';
                $image = File::get($this->upload_image[$key]->getRealPath());
                $save_result = save_livewire_filetocdn($image, $img_path, $img_link);
                $img_link = $img_path . $img_link;
    
                if ($save_result) {
                    $images['img-1'] = $img_link;
                }
            }
    
            if (str_contains($key,'N' )) {
    
                $row = new Index();
                $row->language = 'EN';
                $row->name = 'home_header1';
    
            } else{
                $row = Index::find($key);
            }
            
            if (isset($row)) {
    
                $titles   = [];
                $texts    = [];
                $btn_text = [];
    
                foreach ($this->langs as $lang) {
                    if ($lang == 'en') {
                        $titles['en']['title-1'] = $this->title[$key];
                        $texts['en']['texts-1'] = $this->text[$key];
                        $btn_text['en']['btn-1'] = $this->btn_text[$key];
                    } else {
                        $titles[$lang]['title-1'] = translate($this->title[$key], $lang);
                        $texts[$lang]['texts-1'] = translate($this->text[$key], $lang);
                        $btn_text[$lang]['btn-1'] = translate($this->btn_text[$key], $lang);
                    }
    
                    $row->setTranslation('titles', $lang, json_encode($titles[$lang], JSON_UNESCAPED_UNICODE));
                    $row->setTranslation('texts', $lang, json_encode($texts[$lang], JSON_UNESCAPED_UNICODE));
                    $row->setTranslation('buttons', $lang, json_encode($btn_text[$lang], JSON_UNESCAPED_UNICODE));
                    $row->urls = $this->btn_url[$key];
    
                }
    
                if (isset($images['img-1'])) {
                    $row->images = json_encode($images);
                }
                $row->store_id = $this->store_id;
                $row->save();
            }


        }

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => $this->translations['slide_saved'],
        ]);
        
    }

    public function editImg($id)
    {
        if (!empty($this->upload_image)) {
            $img_link = 'index1_' . md5(microtime()) . '.webp';
            $image = File::get($this->upload_image->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'web_headers/index1', $img_link);
            $img_link = 'web_headers/index1/' . $img_link;

            if ($save_result) {
                $this->images[$id] = $img_link;
                $this->data->images = json_encode($this->images);
                $this->data->save();
                $this->dispatchBrowserEvent('closeModal');
            } else {
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'warning',
                    'message' => $this->translations['image_problem'],
                ]);
            }

        }

    }

}
