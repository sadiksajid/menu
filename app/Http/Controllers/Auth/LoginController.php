<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Client;
use App\Models\StoreAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/admin';

    public function login(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $this->validateLogin($request);

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

        if (is_numeric($request->input('email'))) {
            return ['telephone' => $request->input('email'), 'password' => $request->input('password')];
        } elseif (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->input('email'), 'password' => $request->input('password')];
        } else {
            $this->validateLogin($request);
        }

    }
    protected function validateLogin(Request $request)
    {

        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required',
        ]);

        $user = null;
        if (is_numeric($request->input('email'))) {
            $user = StoreAdmin::where('telephone', '=', $request->input('email'))->where('status', 1)->first();

        } elseif (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
            $user = StoreAdmin::where('email', '=', $request->input('email'))->where('status', 1)->first();
        }
        if (!$user) {
            return redirect()->back()->with('error', 'Email-Address Or Password Are Wrong !');
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
