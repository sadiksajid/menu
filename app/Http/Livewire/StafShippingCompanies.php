<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ShippingCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class StafShippingCompanies extends Component
{
    use WithFileUploads;

    public $mode_type = 'list';
    public $company_name = null;
    public $company_tag = null;
    public $company_url = null;
    public $company_logo = null;
    public $company_logo_url = null;
    public $company_contact_types = ['email','phone','whatsapp','skype','telegram',''];
    public $company_contact_type = [];
    public $company_contact_info = [];
    public $infoKey = 1;
    public $company_contact_arr = [];
    /////////////////////////////////////////////
    public $company_contact_country = 150;
    public $company_contact_cities = [];

    public $countries = [];
    public $cities = [];

    ///////////////////////////////////////////
    public $company_user_name ;
    public $company_user_password;
    public $company_token;
    public $company_status = true;

    //////////////////////////////////////////
    public $company_working_from = [];
    public $company_working_to = [];

    //////////////////////////////////////////
    public $company_id = null ;

    public function mount($type,$id = null)
    {
        $this->translations = app('translations_admin');
        $this->langs = languages()['langs'];
        ///////////////////////
        $this->mode_type = $type;

        if($this->mode_type == 'add'){
            $this->company_contact_type[0] = 'email';
            $this->company_contact_type[1] = 'phone';
        }elseif($this->mode_type == 'edit' and $id != null){
            $this->company_id = $id ;
            $this->getCompanyData() ;
        }
    

        $this->countries = Country::all();
        $this->getCities() ;
    }
    public function render()
    {
        switch ($this->mode_type) {
            case 'add':
                return view('livewire.staf.shipping_companies.shipping_companies_info');
                break;
            case 'edit':
                return view('livewire.staf.shipping_companies.shipping_companies_info');
                break;
            
            default:
                return view('livewire.staf.shipping_companies.shipping_companies_list');
                break;
        }
    }
    public function getCities()
    {
       $this->cities = City::where('country_id',$this->company_contact_country)->get();
    }
    public function addInfo()
    {
       $this->infoKey++ ;
       $this->company_contact_arr[] =  $this->infoKey ;
       $this->company_contact_type[$this->infoKey] = $this->company_contact_types[0];
    }
    public function UpdateCompany()
    {
    
        $this->validate([
            'company_status' => 'required|boolean',
            'company_name' => 'required|string|max:250',
            'company_url' => 'nullable|string|max:250',
            'company_logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif,webp|max:2048',
            'company_contact_type.*' => 'nullable|string|max:50',
            'company_contact_info.*' => 'nullable|string|max:50',
            'company_contact_country' => 'required|integer|max:99999999999',
            'company_contact_cities.*' => 'required|integer|max:99999999999',
            'company_user_name' => 'nullable|string|max:250',
            'company_user_password' => 'nullable|string|max:250',
            'company_token' => 'nullable|string|max:1500',
            'company_working_from.*' => 'nullable|date_format:H:i',
            'company_working_to.*' => 'nullable|date_format:H:i',
        ]);

        if($this->company_id == null){
            $this->validate([
                'company_tag' => 'required|unique:shipping_companies,tag|max:250',
            ]);
            $company = new ShippingCompany();
        }else{
            $company = ShippingCompany::find($this->company_id);

            if($this->company_tag != $company->tag){
                $this->validate([
                    'company_tag' => 'required|unique:shipping_companies,tag|max:250',
                ]);
            }
      
        }
        

        $company->status = $this->company_status ;
        $company->name = $this->company_name ;
        $company->tag = $this->company_tag ;
        $company->site = $this->company_url ;
        
        if (!empty($this->company_logo)) {
            $this->img_link = 'Logo.' . $this->company_logo->extension();
            $localFilee = File::get($this->company_logo->getRealPath());
            $path = '/staf_shipping_company/'.$this->company_tag;
            $save_result = save_livewire_filetocdn($localFilee, $path, $this->img_link);
            $company->logo = $path . '/' . $this->img_link;
        }

        $contact_info = [] ;
        foreach ($this->company_contact_type as $key => $type) {
            if(isset($contact_info[$type])){      
                $phone_keys = array_filter(array_keys($contact_info), function($key) use($type) {
                    return strpos($key, $type) === 0;
                });
                
                $count = count($phone_keys);
                $type = $type.$count;
            }
            $contact_info[$type] = $this->company_contact_info[$key];
        }
        if(!empty($contact_info)){
            $company->contact_info = $contact_info ;
        }

        $company->country = $this->countries->where('id',$this->company_contact_country)->first()?->name; 
        $company->cities  = $this->company_contact_cities; 

        $company->username  = $this->company_user_name; 
        $company->password  = $this->company_user_password; 
        $company->token  = $this->company_token; 

        $time = [];
        foreach ($this->company_working_from as $key => $from) {
            $time[$key] = ['from'=> $from,'to'=>$this->company_working_to[$key]??''];
        }
        $company->working_time =  $time ;

        $company->save();

        
        $this->dispatchBrowserEvent('swal:modal_back', [
            'type' => 'success',
            'title' => $this->translations['company_saved'],
            'url' => '/staf/shipping_companies',

        ]);

    }

    //////////////////////////////// edit

    public function getCompanyData()
    {
        $company = ShippingCompany::find($this->company_id);

        $this->company_status = $company->status ;
        $this->company_name = $company->name ;
        $this->company_tag = $company->tag ;
        $this->company_url = $company->site ;

        $x = 0 ;
        foreach ($company->contact_info as $key => $value) {
            $this->company_contact_arr[$x] =  $x  ;
            $this->company_contact_type[$x] = preg_replace("/[^a-zA-Z]/", "", $key);
            $this->company_contact_info[$x] = $value ;
            $x++ ;
            $this->infoKey = $x;
        }

        $this->company_contact_country = Country::where('name',$company->country)->first()?->id; 
        $this->company_contact_cities = $company->cities; 

        $this->company_user_name = $company->username; 
        $this->company_user_password = $company->password ; 
        $this->company_token = $company->token; 

        if(!empty($company->working_time)){
            foreach ($company->working_time as $key => $time) {
                $this->company_working_from[$key] = $time['from'];
                $this->company_working_to[$key] = $time['to'];
            }
        }
        $this->company_logo_url = $company->logo;


    }


}