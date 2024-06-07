<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class ClientAuthController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/dashboard';

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

        $this->middleware('client')->except('logout');
        //Session::put('backUrl', URL::previous());
    }

    // public function agencyLoginForm()
    // {

    //     return view('auth.agency.login');
    // }

    protected function credentials(Request $request)
    {

        if (is_numeric($request->input('email'))) {
            return ['phone' => $request->input('email'), 'password' => $request->input('password')];
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
            $user = Client::where('phone', '=', $request->input('email'))->where('status', 1)->first();

        } elseif (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
            $user = Client::where('email', '=', $request->input('email'))->where('status', 1)->first();
        }
        if (!$user) {
            return redirect()->back()->with('error', 'Email-Address Or Password Are Wrong !');
        } else {
            if ($user->depot->partner->status == 0) {
                return redirect()->back()->with('error', 'This user is Desabled !');

            }
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
