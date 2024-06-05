<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ContactUs;
use App\Models\StoreOrder;
use App\Models\ClientStore;
use Illuminate\Support\Facades\Auth;

class ContactUsHome extends Component
{
    public $full_name;
    public $subject;
    public $email;
    public $message;


    ////////////////////////////
    public $translations;

    public function mount()
    {
        $this->translations = app('translations_admin');
    }
    public function render()
    {
        return view('livewire.contact.contact');

    }
   
    public function emptyInputs()
    {
        $this->full_name = ''; 
        $this->subject = ''; 
        $this->email = ''; 
        $this->message  = ''; 

    }
    public function Message()
    {
        $this->validate([
            'full_name' => 'required|string|max:50',
            'subject' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'message' => 'required|string|max:1500',
        ]);

        $msg = new ContactUs();
        $msg->name = $this->full_name ; 
        $msg->subject = $this->subject ; 
        $msg->email = $this->email ; 
        $msg->message = $this->message ; 
        $msg->save() ; 

        $this->emptyInputs();
    }
}
