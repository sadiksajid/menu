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
    public $contact_email;
    public $message;
    public $msg_sent = false;


    ////////////////////////////
    public $translations;

    public function mount()
    {
        $json = app('translations');
        $this->translations = $json['home'];
    }
    public function render()
    {
        return view('livewire.contact.contact');

    }
   
    public function emptyInputs()
    {
        $this->full_name = ''; 
        $this->subject = ''; 
        $this->contact_email = ''; 
        $this->message  = ''; 

    }
    public function Message()
    {
        $this->validate([
            'full_name' => 'required|string|max:50',
            'subject' => 'required|string|max:150',
            'contact_email' => 'required|email|max:150',
            'message' => 'required|string|max:1500',
        ]);

        $msg = new ContactUs();
        $msg->name = $this->full_name ; 
        $msg->subject = $this->subject ; 
        $msg->email = $this->contact_email ; 
        $msg->message = $this->message ; 
        $msg->save() ; 

        $this->emptyInputs();
        $this->msg_sent = true; 
        $this->dispatchBrowserEvent('swal:timer', [
            'type' => 'success',
            'message' => $this->translations['contact_us_msg_sent'],

        ]);

    }
}
