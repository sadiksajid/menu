<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingCompanyToStore;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ShippingCompaniesAPI extends Controller
{

    public function CompanyIntegrationStatus(Request $request)
    {
        dd('sdfsdf');
        $data = [
            'api_id' => $request->api_id,
            'status' => $request->status,
            'reason' => $request->reason,
     
        ];
        
        $rules = [
            'api_id' => 'required|integer|max:999999999999999',
            'status' => 'required|string|max:15',
            'reason' => 'nullable|string|max:1500',
        ];
        
        $validator = Validator::make($data, $rules);
        
        // Check if validation fails
        if ($validator->fails()) {
            // Get the validation errors
            $errors = $validator->errors();
        
            // Handle the validation errors
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $errors->all()
            ], 422);
        }
        

        $company = ShippingCompanyToStore::where('api_id',$request->api_id)->first();

        if(!empty($company)){
            $company->status = $request->status;
            $company->reason = $request->reason ;
            $company->save() ;

            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'the shop not exist!',
            ]);
        }
   
    }

   
}
