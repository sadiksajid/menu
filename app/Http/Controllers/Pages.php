<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pages extends Controller
{
 public function terms(){
    return view('terms');
 }

 public function mushroomsTerms(){
   return view('mushroomsTerms');
}


}
