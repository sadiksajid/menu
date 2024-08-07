<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ShippingCompaniesConfig extends Controller
{

    public function CompanyVars($key)
    {

        $data = array(
            'exxpress'=>array(
                'inputs'=>array(
                    "firstname"=>   array("api_key"=>"firstname","col"=>"col-md-6 col-12","label"=>"first_name","type"=>"text","validation"=>"required|string|max:50"),
                    "lastname"=>    array("api_key"=>"lastname","col"=>"col-md-6 col-12","label"=>"last_name","type"=>"text","validation"=>"required|string|max:50"),
                    "ville_id"=>    array("api_key"=>"ville_id","col"=>"col-md-6 col-12","label"=>"city","type"=>"text","validation"=>"required|string|max:50"),
                    "phone"=>       array("api_key"=>"phone","col"=>"col-md-6 col-12","label"=>"phone","type"=>"text","validation"=>"required|string|max:50"),
                    "brand"=>       array("api_key"=>"brand","col"=>"col-md-6 col-12","label"=>"store_name","type"=>"text","validation"=>"required|string|max:150"),
                    "address"=>     array("api_key"=>"address","col"=>"col-12","label"=>"address","type"=>"text","validation"=>"required|string|max:250"),
                    "password"=>    array("api_key"=>"password","col"=>"col-md-6 col-12","label"=>"password","type"=>"password","validation"=>"required|string|min:8|max:150"),
                    "passwordC"=>   array("api_key"=>"passwordC","col"=>"col-md-6 col-12","label"=>"confirm_password","type"=>"password","validation"=>"required|string|min:8|max:150|same:input_value.password"),
                ),
                'inputs_2'=>array(
                    "longitude"=>   array("api_key"=>"longitude","col"=>"col-md-6 col-12","label"=>"hidden","type"=>"maps","validation"=>"required|max:150"),
                    "latitude"=>    array("api_key"=>"latitude","col"=>"col-md-6 col-12","label"=>"hidden","type"=>"maps","validation"=>"required|max:150"),
                ),
                'api'=>'https://mgmt-dev.ks.conacom.net/api/registerShop',
            ),
        );

        return array('config'=> $data[$key],'info'=> $this->CompanyVarsData($key) );
    }

    function splitFullName($fullName) {
        // Trim any extra whitespace
        $fullName = trim($fullName);
    
        // Split the name by space
        $parts = explode(' ', $fullName);
    
        // Check if there are more than one part
        if (count($parts) > 1) {
            // First name is the first part
            $firstName = array_shift($parts);
    
            // Last name is the rest of the parts joined back together
            $lastName = implode(' ', $parts);
        } else {
            // If there's only one part, consider it as the first name and leave the last name empty
            $firstName = $fullName;
            $lastName = '';
        }
    
        return ['first_name' => $firstName, 'last_name' => $lastName];
    }
    public function CompanyVarsData($key)
    {
        switch ($key) {
            case 'exxpress':
                $admin = Auth::user();
                $store =  $admin->store;
                $city = $store->city_db?->city;
                $name = $this->splitFullName($admin->name);
                $data = array(
                    "ville_id"=>    $city ?? null,
                    "firstname"=>   $name['first_name'] ?? null ,
                    "lastname"=>    $name['last_name'] ?? null,
                    "phone"=>       str_replace('+212','0',$store->phone),
                    "address"=>     $store->address,
                    "brand"=>       $store->title,
                    "password"=>    null,
                    "passwordC"=>   null,
                    "longitude"=>   $store->longitude,
                    "latitude"=>    $store->latitude,
                );

                return $data ;
                break;
            
            default:
                # code...
                break;
        }

        
       
    }
}
