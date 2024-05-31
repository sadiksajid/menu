<?php

namespace App\Http\Livewire;

use App\Models\CompitionClient;
use App\Models\Index;
use App\Models\Store;
use Carbon\Carbon;
use DNS2D;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Competition extends Component
{

    //////////////////////////
    public $translations;
    public $translations_resto;
    public $qr_code = null;
    public $user_details = null;
    public $store_info;
    public $client;
    public $store_meta;

    ////////////////////// admin
    public $clients;
    public $pull_up;
    public $competition_img;

    public function mount($id = null)
    {

        $json = app('translations');
        $this->translations = $json['system'];
        $this->translations_resto = $json['resto'];

        ////////////////////////////////////////
        $this->store_meta = env('STOR_NAME');
        $stores = Cache::get('stores');

        if (isset($stores[$this->store_meta])) {
            $this->store_info = $stores[$this->store_meta];
        } else {
            $this->store_info = Store::where('store_meta', $this->store_meta)->first();
            $stores[$this->store_meta] = $this->store_info;
            Cache::put('stores', $stores, 7200);

        }

        $this->store_id = $this->store_info->id;
        ////////////////////////////////////////

        $this->competition_img = Index::where('store_id', $this->store_id)->where('name', 'competition_header1')->first()?->images;
        $this->competition_img = json_decode($this->competition_img, true);
        $this->competition_img = $this->competition_img['img_1'];

        if (!Auth::check()) {
            $this->store_info = Store::where('store_meta', env('STOR_NAME'))->first();
            $this->client = CompitionClient::where('phone', $id)->first();
            $this->qr_code = DNS2D::getBarcodeHTML(url('/competition/' . $this->client->phone), 'QRCODE');
        } else {
            if ($id) {
                CompitionClient::where('phone', $id)->update(['date_scan' => Carbon::now()]);
            }

        }

    }
    public function render()
    {
        if (!Auth::check()) {
            return view('livewire.competition.competition_client');
        } else {
            $this->getData();
            return view('livewire.competition.competition_admin');
        }
    }

    public function getData()
    {
        $this->clients = CompitionClient::whereDate('date_scan', Carbon::today())->get();
        foreach ($this->clients as $client) {
            $this->pull_up[$client->id] = $client->total_pull;
        }
    }
    public function SaveWinner($id)
    {
        CompitionClient::where('id', $id)->update(['is_winner' => 1]);
        // $this->redirect_page();

    }
    public function BackWinner($id)
    {
        CompitionClient::where('id', $id)->update(['is_winner' => 0]);
        // $this->redirect_page();

    }
    public function savePull($id)
    {
        CompitionClient::where('id', $id)->update(['total_pull' => $this->pull_up[$id]]);
    }

    public function redirect_page()
    {
        return redirect('/competition');

    }
}
