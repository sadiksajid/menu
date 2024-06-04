<?php

namespace App\Http\Livewire;
use App\Models\Country;
use Livewire\Component;


class Home extends Component
{


    // protected $listeners = ['indexRender' => 'renderComponent'];

    public $translations;
    public $countries;


    public function mount()
    {
        $json = app('translations');
        $this->translations = $json['home'];
        $this->countries = Country::select('id','name','currency')->orderBy('name','asc')->get();

    }

    public function render()
    {
        return view('livewire.home.home');
    }

  

}
