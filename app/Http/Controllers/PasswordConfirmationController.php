<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordConfirmationController extends Controller
{
    public function showConfirmForm()
    {
        return view('auth.passwords.confirm');
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);
        
        $profiles = Auth::user()->store->profiles->where('status',1)  ; 
        
        foreach ($profiles as $profile) {
            if (Hash::check($request->password, $profile->password)) {
                session(['password_confirmed_at' => now()]);
                return redirect(session('url.intended', '/admin'));
            }
        }
     
        return back()->withErrors([
            'password' => 'The provided password does not match our records.',
        ]);
    }

    public function confirmApi(Request $request)
    {
        // $request->validate([
        //     'password' => 'required|string',
        // ]);

        // dd($request->password);

        $profiles = Auth::user()->store->profiles->where('status',1) ; 
        
        foreach ($profiles as $profile) {
            if (Hash::check($request->password, $profile->password)) {

                return response()->json([
                    'success' => true,
                    'data' => $profile->id,
                    'name' => $profile->fullname,
                ]);

            }
        }
        return response()->json([
            'success' => true,
            'data' => -1,
        ]);
    }

    public function confirmApiCode(Request $request)
    {

        $profiles = Auth::user()->store->profiles->where('status',1) ; 
        foreach ($profiles as $profile) {
            if ($request->bar_code == $profile->code ) {

                return response()->json([
                    'success' => true,
                    'data' => $profile->id,
                    'name' => $profile->fullname,
                ]);

            }
        }
        return response()->json([
            'success' => true,
            'data' => -1,
            'code'=>$request->bar_code ,
        ]);
    }


}