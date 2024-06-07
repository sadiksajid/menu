<?php

namespace App\Http\Livewire;

use App\Models\Index;
use App\Models\Store;
use App\Models\StoreOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\Intl\Currencies;

class MyOrders extends Component
{
    use WithPagination;
    public $total = 0;
    public $qte = 0;
    public $currency;
    public $orders;
    public $store_meta;
    public $store_info;
    public $titles_orders;
    public $images_orders;
    //////////////////////////
    public $translations;

    public function mount()
    {
        $json = app('translations');
        $this->translations = $json['system'];

        $this->store_meta = env('STOR_NAME');
        $stores = Cache::get('stores');

        if (isset($stores[$this->store_meta])) {
            $this->store_info = $stores[$this->store_meta];
        } else {
            $this->store_info = Store::where('store_meta', $this->store_meta)->first();
            $stores[$this->store_meta] = $this->store_info;
            Cache::put('stores', $stores, 7200);

        }

        if (isset($this->store_info->currency)) {
            $this->currency = Currencies::getSymbol($this->store_info->currency);
        } else {
            $this->currency = 'DH';
        }

        $this->client = Auth::guard()->user();
        $orders = StoreOrder::where('client_id', $this->client->id)
            ->with(['products' => function ($q) {
                $q->with(['product' => function ($q) {
                    $q->select('id', 'title', 'price');
                    $q->with('media');
                }]);
            }])
            ->orderBy('id', 'DESC')->paginate(15);
        Cache::put('orders-' . $this->client->id, $orders);

        $orders_head = Index::where('store_id', $this->store_info->id)->where('name', 'orders1')->first();
        if (!empty($orders_head)) {
            $this->titles_orders = $orders_head->titles;
            $this->titles_orders = json_decode($this->titles_orders, true);
            $this->titles_orders = $this->titles_orders['title-1'];

            $this->images_orders = $orders_head->images;
            $this->images_orders = json_decode($this->images_orders, true);
            $this->images_orders = $this->images_orders['img_1'];

        }

    }

    public function render()
    {
        return view('livewire.Client.my_orders.my_orders_view');

    }

}
