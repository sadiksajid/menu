<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Store;
use App\Models\Country;
use App\Models\StoreAdmin;
use Illuminate\Http\Request;
use App\Rules\NotEqualToNone;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function RegisterForm()
    {
        return view('auth.register');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validation = Validator::make($data, [
            'fullname' => ['required', 'string', 'max:50'],
            'country_code' => ['required', 'string', 'max:10'],
            'store_meta' => ['required', 'string', 'max:50', 'unique:stores'],
            'telephone' => ['required', 'string', 'max:50', 'unique:store_admins', new NotEqualToNone],
            'phone_code' => ['required', 'string', 'max:5'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        return $validation ;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $country = Country::where('iso',strtoupper($data['country_code']))->first();
        $store = Store::create([
            'store_meta' => $data['store_meta'],
            'phone' => $data['telephone'],
            // 'emial' => $data['email'],
            'country' => $country->name,
            'country_id' => $country->id ,
            'currency' => $country->currency,
        ]) ; 
        $user = StoreAdmin::create([
            'name' => $data['fullname'],
            // 'email' => $data['email'],
            'telephone' => $data['telephone'],
            'country' => $country->name,
            'country_id' => $country->id ,
            'store_id' => $store->id,
            'is_admin' => 1,
            'phone_code' => $data['phone_code'],
            'password' => Hash::make($data['password']),
        ]) ; 
        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $this->create($request->all());

        // Instead of logging in the user, redirect to login page
        return back()->with('success_login', 'Your account has been created. Please log in.');
    }


}
