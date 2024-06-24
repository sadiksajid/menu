<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Quartier;
use App\Models\Region;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class StoreInfo extends Component
{
    use WithFileUploads;

    public $store_info;
    public $store_id;
    public $title;
    public $store_meta;

    public $s_title;
    public $description;
    public $logo = '';
    public $edit_logo;
    public $address;
    public $edit_address;
    public $cities = [];
    public $cities_list = [];

    public $city_id;
    public $quartier_id;
    public $region_id;
    public $regions = [];

    public $quartier;
    public $quartier_fix;

    public $longitude;
    public $latitude;

    public $edit_longitude;
    public $edit_latitude;

    public $status;
    public $shipping;
    public $preorder;
    public $post_code;
    public $country_code;

    public $phone;
    public $phone2;

    public $email;
    public $tiktok;
    public $facebook;
    public $instagram;

//////////////////////////////colors

    public $btn_color;
    public $text_color = 'black';
    public $background_color = 'white';

    protected $listeners = ['getlocal', 'confirmed', 'getCity'];
    ////////////////////////////////
    public $translations;
    public function getlocal($post)
    {
        $this->edit_longitude = $post['longitude'];
        $this->edit_latitude = $post['latitude'];
        $this->edit_address = $post['address']['Match_addr'];
    }

    public function saveLocation()
    {
        $this->longitude = $this->edit_longitude;
        $this->latitude = $this->edit_latitude;

        $this->dispatchBrowserEvent('StoreInfoModal', [
            'status' => 'hide',
        ]);

        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'success',
            'title' => $this->translations['store_info_msg_3'],
            'message' => $this->edit_address,
        ]);

    }
    public function confirmed()
    {
        $this->address = $this->edit_address;
    }
    public function mount()
    {

        $this->translations = app('translations_admin');
        ///////////////////////////////////
        $store = Auth::user()->store ;
        $this->store_id = $store->id;
        $this->country_code = $store->country_code ;
        if($store->country == 'Morocco'){
            $this->regions = Region::orderBy('region', 'ASC')->get();
        }
        $this->editStoreInfo();
    }
    public function render()
    {
        return view('livewire.admin.storeInfo.editStoreInfo');
    }

    public function getCity()
    {

        if ($this->region_id != null) {
            $this->cities = City::leftjoin('provinces', 'provinces.id', 'cities.province_id')
                ->where('provinces.region_id', $this->region_id)
                ->select('cities.*')
                ->orderBy('city', 'ASC')->get();

            $this->cities_list = [];
            foreach ($this->cities as $city) {
                $this->cities_list[$city->id] = $city->city;
            }

            $this->dispatchBrowserEvent('cities_options', [
                'cities' => $this->cities,
            ]);
        }

    }

    public function showMaps()
    {
        $data = [
            'change_name' => $this->title,
            'change_type' => 'Store',
            'change_lo' => $this->longitude,
            'change_la' => $this->latitude,
            'map_height' => '500px',
            'pick' => true,
        ];
        $this->dispatchBrowserEvent('StoreInfoModal', [
            'status' => 'show',
        ]);
        $this->dispatchBrowserEvent('maps:lib', $data);

    }

    public function editStoreInfo()
    {

        $this->store_info = Store::find($this->store_id);
        $this->title = $this->store_info->title;
        $this->store_meta = $this->store_info->store_meta;

        $this->s_title = $this->store_info->s_title;
        $this->description = $this->store_info->description;
        $this->logo = $this->store_info->logo;
        $this->status = $this->store_info->status;
        $this->shipping = $this->store_info->shipping;
        $this->preorder = $this->store_info->preorder;
        $this->address = $this->store_info->address;
        $this->city_id = $this->store_info->city_id;
        $this->region_id = $this->store_info->city->province->region->id ?? null;

        if(!empty($this->regions)){
            $this->getCity();
        }

        $this->quartier_id = $this->store_info->quartier_id;
        $this->quartier = $this->store_info->quartier->quartier ?? null;
        $this->post_code = $this->store_info->quartier->code_postal ?? null;
        $this->city = $this->store_info->city ?? null;

        $this->quartier_fix = $this->quartier;
        $this->longitude = $this->store_info->longitude;
        $this->latitude = $this->store_info->latitude;

        $this->btn_color = $this->store_info->btn_color;
        $this->text_color = $this->store_info->text_color;
        $this->background_color = $this->store_info->background_color;

        $this->phone = $this->store_info->phone;
        $this->phone2 = $this->store_info->phone2;
        $this->email = $this->store_info->email;
        $this->tiktok = $this->store_info->tiktok;
        $this->facebook = $this->store_info->facebook;
        $this->instagram = $this->store_info->instagram;

    }

    public function updateInfo()
    {

        if(!empty($this->regions)){
            
            $this->validate([
                'city_id' => 'required|integer|max:99999',
                'quartier_fix' => 'nullable|string|max:50',
            ]);
        }else{
            $this->validate([
                'city' => 'required|string|max:50',
            ]);
        }


        $this->validate([
            'title' => 'required|string|max:100',
            's_title' => 'nullable|string|max:200',

            'description' => 'required|string|max:15000',
            'status' => 'required|boolean',
            'shipping' => 'required|boolean',
            'preorder' => 'required|boolean',
            'post_code' => 'required|integer|max:99999',
            'quartier' => 'required|string|max:50',

            'address' => 'required|string|max:250',
            'phone' => 'required|string|max:30',
            'phone2' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:30',
            'tiktok' => 'nullable|string|max:150',
            'facebook' => 'nullable|string|max:150',
            'instagram' => 'nullable|string|max:150',


            'btn_color' => 'nullable|string|max:20',
            'text_color' => 'nullable|string|max:20',
            'background_color' => 'nullable|string|max:20',

            'longitude' => 'nullable|numeric|max:999',
            'latitude' => 'nullable|numeric|max:999',

            'edit_logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif,webp|max:2048',
        ]);

        $this->store_info = Store::find($this->store_id);

        if( $this->store_meta != $this->store_info->store_meta){
            $this->validate([
                'store_meta' => 'required|string|max:50|unique:stores,store_meta',
            ]);
            $this->store_info->store_meta = $this->store_meta;

        }


        $this->store_info->title = $this->title;

        $this->store_info->s_title = $this->s_title;
        $this->store_info->description = $this->description;
        $this->store_info->status = $this->status;
        $this->store_info->shipping = $this->shipping;
        $this->store_info->preorder = $this->preorder;
        $this->store_info->address = $this->address;
        $this->store_info->city_id = $this->city_id;
        $this->store_info->longitude = $this->longitude;
        $this->store_info->latitude = $this->latitude;
        $this->store_info->phone = $this->phone;
        $this->store_info->phone2 = $this->phone2;
        $this->store_info->email = $this->email;
        $this->store_info->tiktok = $this->tiktok;
        $this->store_info->facebook = $this->facebook;
        $this->store_info->instagram = $this->instagram;


        $this->store_info->btn_color = $this->btn_color;
        $this->store_info->text_color = $this->text_color;
        $this->store_info->background_color = $this->background_color;

        if (!empty($this->quartier) and $this->quartier != $this->quartier_fix) {
            try {
                $q_id = Quartier::where('quartier', $this->quartier)->first()->id;
            } catch (\Throwable $th) {
                $qtr = new Quartier();
                $qtr->quartier = $this->quartier;
                $qtr->city_id = $this->city_id;
                $qtr->code_postal = $this->post_code;
                $qtr->status = 0;
                $qtr->save();
                $q_id = $qtr->id;
            }
            $this->store_info->quartier_id = $q_id;
        }

        if (!empty($this->edit_logo)) {
            try {
                // File::delete(storage_path('app') . '/public/store_logo/' . $this->logo);
                delete_file($this->logo);

            } catch (\Throwable $th) {
                //throw $th;
            }

            $this->img_link = 'Logo_' . str_replace(' ', '_', $this->title) . md5(microtime()) . '.' . $this->edit_logo->extension();
            // $this->edit_logo->storeAs('Public/store_logo', $this->img_link);
            $localFilee = File::get($this->edit_logo->getRealPath());
            $path = '/store_info/store_logo';
            // Minio($localFilee, $path,$this->img_link,false);
            $save_result = save_livewire_filetocdn($localFilee, $path, $this->img_link);

            $this->store_info->logo = $path . '/' . $this->img_link;
        }
        $this->store_info->save();

        $this->dispatchBrowserEvent('swal:confirm_redirect', [
            'type' => 'success',
            'title' => $this->translations['store_info_msg_1'],
            'message' => $this->translations['store_info_msg_2'],
            'url' => '/admin/dashboard',

        ]);

    }

}
