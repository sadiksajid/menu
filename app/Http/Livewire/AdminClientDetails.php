<?php

namespace App\Http\Livewire;

use App\Models\ClientStore;
use App\Models\StoreOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminClientDetails extends Component
{
    public $client;
    public $all_orders;
    public function mount($client)
    {
        $this->client = $client;
        $this->orders = $client->orders_count;
        $this->all_orders = StoreOrder::where('client_id', $client->id)->orderBy('id', 'DESC')
            ->with(['products' => function ($q) {
                $q->with(['product' => function ($q) {
                    $q->select('id', 'title', 'price');
                    $q->with(['media' => function ($q) {
                        $q->first();
                    }]);
                }]);
            }])
            ->with(['client_address' => function ($q) {
                $q->select('*');
                $q->with('city');
                $q->with('quartier');

            }])
            ->limit('10')->get();

    }
    public function render()
    {
        return view('livewire.admin.clients.client_details');

    }
    public function changeStatus($status)
    {
        $client = ClientStore::where('store_id', Auth::id())->where('client_id', $this->client->id)->first();
        $client->trusted = $status;
        $client->save();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Status Changed',
        ]);
    }
    public function BlockClient($status)
    {

        $client = ClientStore::where('store_id', Auth::id())->where('client_id', $this->client->id)->first();
        if ($status == 1) {
            $client->status = 'active';
        } else {
            $client->status = 'block';
        }
        $client->save();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Status Changed',
        ]);
    }
}
