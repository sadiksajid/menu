<?php

namespace App\Http\Livewire;

use App\Rules\PhoneValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ClientLogin extends Component
{
    // protected $listeners = ['updateComponent' => 'renderComponent'];

    // public $total = 0;
    // public $qte = 0;
    // public $currency = 0;
    public $login_phone;
    public $login_password;

    public function mount()
    {
    }
    public function render()
    {

        return view('livewire.Client.Login.login_view');

    }
    public function Login()
    {
        // dd('sdfds');

        $validator = Validator::make(
            [
                'Phone' => $this->login_phone,
                'Password' => $this->login_password,
            ],
            [
                'Phone' => ['required', 'digits:10', new PhoneValidation()],
                'Password' => 'required|string|min:4',
            ]
        );
        if ($validator->fails()) {

            $message = implode("</br>", $validator->messages()->all());
            $this->dispatchBrowserEvent('login_faild', ['message' => $message]);
        } else {

            Auth::guard('client')->attempt(array('phone' => $this->login_phone, 'password' => $this->login_password));
            if (Auth::guard('client')->check()) {
                $this->dispatchBrowserEvent('login_success');
                $this->emit('renderHeader');
            } else {
                $this->dispatchBrowserEvent('login_faild');
            }
        }
        // dd($this->login_phone);

    }

}
