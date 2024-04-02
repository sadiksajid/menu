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
//////////////////////////////colors

    public $btn_color;
    public $text_color = 'black';
    public $background_color = 'white';

    protected $listeners = ['getlocal', 'confirmed', 'getCity'];

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
            'title' => 'Do you want to change the address to ',
            'message' => $this->edit_address,
        ]);

    }
    public function confirmed()
    {
        $this->address = $this->edit_address;
    }
    public function mount()
    {
        $this->store_id = Auth::user()->store_id;
        $this->regions = Region::orderBy('region', 'ASC')->get();
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
            'map_height' => 500,
            'pick' => true,
        ];

        $this->dispatchBrowserEvent('maps:lib', $data);

    }

    public function editStoreInfo()
    {

        $this->store_info = Store::find($this->store_id);
        $this->title = $this->store_info->title;
        $this->s_title = $this->store_info->s_title;
        $this->description = $this->store_info->description;
        $this->logo = $this->store_info->logo;
        $this->status = $this->store_info->status;
        $this->shipping = $this->store_info->shipping;
        $this->preorder = $this->store_info->preorder;
        $this->address = $this->store_info->address;
        $this->city_id = $this->store_info->city_id;
        $this->region_id = $this->store_info->city->province->region->id ?? null;
        $this->getCity();
        $this->quartier_id = $this->store_info->quartier_id;
        $this->quartier = $this->store_info->quartier->quartier ?? null;
        $this->post_code = $this->store_info->quartier->code_postal ?? null;

        $this->quartier_fix = $this->quartier;
        $this->longitude = $this->store_info->longitude;
        $this->latitude = $this->store_info->latitude;

        $this->btn_color = $this->store_info->btn_color;
        $this->text_color = $this->store_info->text_color;
        $this->background_color = $this->store_info->background_color;

    }

    public function updateInfo()
    {

        $this->validate([
            'title' => 'required|string|max:100',
            's_title' => 'nullable|string|max:200',
            'description' => 'required|string|max:15000',
            'status' => 'required|boolean',
            'shipping' => 'required|boolean',
            'preorder' => 'required|boolean',

            'city_id' => 'required|integer|max:99999',
            'quartier' => 'nullable|string|max:50',
            'post_code' => 'nullable|integer|max:99999',
            'quartier_fix' => 'nullable|string|max:50',
            'address' => 'required|string|max:250',

            'btn_color' => 'required|string|max:20',
            'text_color' => 'required|string|max:20',
            'background_color' => 'required|string|max:20',

            'longitude' => 'required|numeric|max:999',
            'latitude' => 'required|numeric|max:999',

            'edit_logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif,webp|max:2048',
        ]);

        $this->store_info = Store::find($this->store_id);

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
                File::delete(storage_path('app') . '/public/store_logo/' . $this->logo);
            } catch (\Throwable $th) {
                //throw $th;
            }

            $this->img_link = 'Logo_' . str_replace(' ', '_', $this->title) . md5(microtime()) . '.' . $this->edit_logo->extension();
            $this->edit_logo->storeAs('Public/store_logo', $this->img_link);

            $this->store_info->logo = $this->img_link;
        }
        $this->store_info->save();

        $this->dispatchBrowserEvent('swal:confirm_redirect', [
            'type' => 'success',
            'title' => 'Store Info Updated Successfully!',
            'message' => 'Do you want to back to Dashboard page ?',
            'url' => '/admin/dashboard',

        ]);

    }

}
