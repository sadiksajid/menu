<?php

namespace App\Http\Controllers\Auth;

use GeoIP;
use App\Models\User;
use App\Models\Client;
use App\Models\Country;
use App\Models\StoreAdmin;
use Illuminate\Http\Request;
use libphonenumber\PhoneNumberUtil;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/admin';

    public function login(Request $request)
    {


        $phoneNumber = $request->input('login_email');
        $phoneUtil = PhoneNumberUtil::getInstance();

        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {   
            $ip = $_SERVER['HTTP_CLIENT_IP'];   
        }   
        //if user is from the proxy   
        elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {   
            $ip = $_SERVER['HTTP_X_REAL_IP'];   
        }  
        //if user is from the proxy   
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];   
        }   
        //if user is from the remote address   
        else{   
            $ip = $_SERVER['REMOTE_ADDR'];   
        }  
        
        $location = GeoIP::getLocation($ip);
        
        // Country code
        $countryCode = $location->getAttribute('iso_code');
        

        $defaultRegions = Country::select('iso')->get()->pluck('iso')->toArray();
        foreach ($defaultRegions as $region) {
                $numberProto = $phoneUtil->parse($phoneNumber, $region);
                $countryCode = $numberProto->getCountryCode();

                // Validate the parsed number
                if ($phoneUtil->isValidNumber($numberProto)) {
                    dd( $countryCode );
                }
           
        }



       


        
        $request->session()->invalidate();
        $request->session()->regenerateToken();


        if(!$this->validateLogin($request)        ){
            return redirect()->back()->with('error', 'Email-Address Or Password Are Wrong !');
        }




        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function __construct()
    {

        $this->middleware('web')->except('logout');
    }

    protected function credentials(Request $request)
    {

        if (is_numeric($request->input('login_phone'))) {
            return ['telephone' => $request->input('login_phone'), 'password' => $request->input('login_password')];
        } elseif (filter_var($request->input('login_phone'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->input('login_phone'), 'password' => $request->input('login_password')];
        } else {
            $this->validateLogin($request);
        }

    }
    protected function validateLogin(Request $request)
    {

        $request->validate([
            'login_phone' => 'required|string',
            'login_password' => 'required',
        ]);

        $user = null;
        if (!empty($request->input('login_phone'))) {
            $user = StoreAdmin::join('stores','stores.id','store_admins.store_id')->where('store_admins.telephone', '=', $request->input('login_phone'))->where('store_admins.status', 1)->whereNotNull('stores.id')->first();

        } elseif (filter_var($request->input('login_phone'), FILTER_VALIDATE_EMAIL)) {
            $user = StoreAdmin::join('stores','stores.id','store_admins.store_id')->where('store_admins.email', '=', $request->input('login_phone'))->where('store_admins.status', 1)->whereNotNull('stores.id')->first();
        }
        
        if (!$user) {
            // return Redirect::to('/')->with(['type' => 'error','message' => 'Email-Address Or Password Are Wrong !']);
            return false;
        } else{
            return true ;
        }
    }
    public function logout(Request $request)
    {

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return redirect('/');
    }
}
