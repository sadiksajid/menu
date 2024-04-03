<?php

namespace App\Http\Livewire;

use App\Models\Index;
use App\Models\Offer;
use App\Models\Store;
use App\Models\StoreProduct;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Symfony\Component\Intl\Currencies;

class IndexHome extends Component
{
    public $titles = [];
    public $buttons = [];
    public $images = [];
    public $texts = [];
    public $urls = [];

    public $store_meta;
    public $store_id;
    public $store_info;

    public $data;
    public $upload_image;
    public $products;
    public $offer;
    protected $listeners = ['indexRender' => 'renderComponent'];

    public function mount()
    {
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

        $this->data = Index::where('store_id', $this->store_id)->where('name', 'index1')->first();
        if (empty($this->data)) {
            $data = new Index();
            $data->name = 'index1';
            $data->store_id = $this->store_id;
            $data->language = 'EN';
            $data->save();
        } else {
            $this->titles = $this->data->titles;
            $this->titles = json_decode($this->titles, true);

            $this->buttons = $this->data->buttons;
            $this->buttons = json_decode($this->buttons, true);

            $this->images = $this->data->images;
            $this->images = json_decode($this->images, true);

            $this->texts = $this->data->texts;
            $this->texts = json_decode($this->texts, true);

            $this->urls = $this->data->urls;
            $this->urls = json_decode($this->urls, true);

        }

        $this->products = StoreProduct::select('store_products.*')
            ->where('store_id', $this->store_id)
            ->where('to_menu', 1)
            ->with('media')
            ->limit(16)
            ->get();

        $offers = Cache::get('offers');

        if (isset($offers[$this->store_meta])) {
            $this->offers = $offers[$this->store_meta];

        } else {

            $this->offers = Offer::where('status', 1)
                ->with(['products' => function ($q) {
                    $q->with(['product' => function ($q) {
                        $q->with('media');

                    }]);
                }])
                ->get();
            $offers[$this->store_meta] = $this->offers;
            Cache::put('offers', $offers, 7200);

        }

        if (isset($this->store_info->currency)) {
            $this->currency = Currencies::getSymbol($this->store_info->currency);
        } else {
            $this->currency = 'DH';
        }

    }

    public function render()
    {
        return view('livewire.index1.index');
    }

    public function renderComponent()
    {
        $x = 1;
    }

}
