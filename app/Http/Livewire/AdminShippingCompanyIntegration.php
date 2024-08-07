<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\ShippingCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\ShippingCompanyToStore;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ShippingCompaniesConfig;

class AdminShippingCompanyIntegration extends Component
{
    public $company_info  ;
    public $tag  ;
    public $inputs;
    public $admin;
    public $store;

    //////////////////////////////////////////
    public $translations = null ;
    public $langs = null ;
    public $integration_info ;
    public $input_value = [] ;

    ///////////////////////////////////////
    public $map_mode = false ;
    protected $listeners = ['getlocal'];

    public function mount($tag,$company_info)
    {
        $this->tag = $tag;
        $this->company_info = $company_info;


        $this->translations = app('translations_admin');
        $this->langs = languages()['langs'];
        ///////////////////////
        $this->admin = Auth::user();
        $this->store =  $this->admin->store;

        $source = new ShippingCompaniesConfig();
        $this->integration_info = $source->CompanyVars($tag);
        foreach($this->integration_info['info'] as $key => $value){
            $this->input_value[ $key] = $value ;
        }

   
    }
    public function render()
    {
        return view('livewire.admin.shipping_companies_integration.shipping_companies_integration');
    }
    
    public function Step1()
    {

        foreach($this->integration_info['config']['inputs'] as $key => $input){
            $this->validate([
                'input_value.'.$key => $input['validation'],
            ]);
        }

        if(isset($this->integration_info['config']['inputs_2']) and array_shift($this->integration_info['config']['inputs_2'])['type'] == 'maps' and $this->input_value['longitude'] == null  ){
            $this->showMaps();
        }else{
            $this->SendApi();
        }

    }

    public function MapStep()
    {
        foreach($this->integration_info['config']['inputs_2'] as $key => $input){
            $this->validate([
                'input_value.'.$key => $input['validation'],
            ]);
        }
        $this->store->longitude = $this->input_value["longitude"];
        $this->store->latitude = $this->input_value["latitude"];
        $this->store->save();
    
        $this->SendApi();
        

    }
     
    public function SendApi()
    {

   

        $response = Http::post('https://mgmt-dev.ks.conacom.net/api/registerShop',$this->input_value);
        
        // Get the response body
        $body = $response->body();
        // Optionally, you can also get the response as an array
        $data = $response->json();

        if($data['status'] == true ){

            if(!ShippingCompanyToStore::where('api_id',$data['id'])->exists()){
                $company = new ShippingCompanyToStore();
                $company->shipping_company_id = $this->company_info->id ;
                $company->store_id = $this->store->id ;
                $company->api_id = $data['id'] ;
                $company->save() ;
                $this->dispatchBrowserEvent('swal:confirm_redirect', [
                    'type' => 'success',
                    'title' => $this->translations['integration_success'],
                    'cancle' => false,
                    'confirmBtn' => 'Ok',
                    'url' => '/admin/shipping_companies',
                    'outClick' => false,
    
                ]);
            }else{
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'error',
                    'title' => $this->translations['integration_not_complet'],
                    'text' => $this->translations['please_contact_support'],
                ]);
            }
           
        }else{
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => $this->translations['integration_not_complet'],
                'text' => $this->translations['please_contact_support'],
            ]);
    
        }

   

    }

    public function getlocal($post)
    {
        $this->input_value['longitude'] = $post['longitude'];
        $this->input_value["latitude"] = $post['latitude'];
    }


    public function showMaps()
    {
        $this->map_mode = true ;
        $height = '450px' ;
        $data = [
            'change_name' => $this->integration_info['info']['brand'],
            'change_type' => 'Shop',
            'map_height' => $height,
            'pick' => true,
        ];
        $this->dispatchBrowserEvent('StoreInfoModal', [
            'status' => 'show',
        ]);
        $this->dispatchBrowserEvent('maps:lib', $data);

    }


}