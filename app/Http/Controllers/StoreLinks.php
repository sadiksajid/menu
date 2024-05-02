<?php

namespace App\Http\Controllers;

use Location;

use App\Models\StoreLink;
Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StoreLinks extends Controller
{
    public function RedirectToLink($id,$token,$apk_user=null){
        // $request = Request(); 
        $hash = new \App\Lib\PseudoCrypt();
        $d_id = $hash->unhash($id);
        $ip    = \Request::ip() ;
        $data  = \Location::get($ip);
        $link  = Store::find($d_id);

        $click = new StoreLink();
        $click->apk_user_id = $apk_user ;
        $click->store_id  = $d_id ;
        $click->apk_id  = $link->apk_id ;
        $click->ip        = $ip ;
        $click->country   = $data->countryName ;


         $token_id = ApkUserToken::where('token',$token)->where('apk_id',$link->apk_id)->first();
          if(!empty($token_id)){
            $click->apk_user_token_id = $token_id->id ;
          
          }
          
        $click->save();
        if(substr($link->link,0,4) != 'http'){
            $link->link = 'https://'.$link->link;
        }
        return Redirect::to($link->link);

    }
}
