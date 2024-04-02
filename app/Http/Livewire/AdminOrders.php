<?php

namespace App\Http\Livewire;

use App\Models\StoreOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrders extends Component
{
    use WithPagination;
    public $total = 0;
    public $qte = 0;
    public $currency = 0;
    public $orders;

    public function mount()
    {
        $this->client = Auth::user();
        $orders = StoreOrder::where('client_id', $this->client->id)
            ->with(['products' => function ($q) {
                $q->with(['product' => function ($q) {
                    $q->select('title', 'id');
                }]);
            }])
            ->orderBy('id', 'DESC')->paginate(2);
        Cache::put('orders-' . $this->client->id, $orders);
    }
    public function render()
    {
        return view('livewire.admin.orders.orders_list');

    }

}
