<?php

namespace App\Http\Livewire;

use App\Models\Offer;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\Intl\Currencies;

class StoreOffers extends Component
{
    use WithPagination;

    protected $all_offers;
    public $currency;
    public $categories = [];
    public $quick_key = 0;
    public $paginat = 8;
    public $category_id = null;
    public $store_info = null;
    public $category_url = null;
    public $qte = 1;
    public $store_meta;

    // public $catigory_sizes = ['tmb' => ['w' => 150, 'h' => 150], 'origin' => ['w' => 300, 'h' => 300]];

    public function mount($store_info)
    {
        $this->store_meta = $store_info->store_meta;
        $this->store_info = $store_info;
        $this->categories = ProductCategory::where('store_id', $store_info->id)
            ->select('product_categories.*')
            ->get();

        Cache::put('last_store', $this->store_meta);

        $all_offers = $this->getData(1);

        $info = Cache::get('store_info') ?? [];
        if (!isset($info[$this->store_meta])) {
            if (isset($store_info->currency)) {
                $this->currency = Currencies::getSymbol($this->store_info->currency);
            } else {
                $this->currency = 'DH';
            }
            $info[$this->store_meta]['currency'] = $this->currency;
            $info[$this->store_meta]['title'] = $this->store_info->title;
            $info[$this->store_meta]['selected'] = false;
            Cache::put('store_info', $info);

        } else {
            $this->currency = $info[$this->store_meta]['currency'];
        }

    }
    public function render()
    {
        $all_offers = Cache::get('offers');
        return view('livewire.offers.offers_list', ['offers' => $all_offers]);

    }

    public function setViewStore()
    {
        setView('store', $this->store_info->id);
    }

    public function nextPage()
    {
        $page = Cache::get('offer_page');
        $page++;

        $next_prod = $this->getData($page, $this->category_id);

    }

    public function getData($page = 1)
    {

        $data = Offer::where('store_id', $this->store_info->id)
            ->where('status', 1)
            ->with(['products' => function ($q) {
                $q->with(['product' => function ($q) {
                    $q->with('media');

                }]);
            }])
            ->paginate($this->paginat, ['*'], 'page', $page);

        if ($page > 1) {
            $all_offers = Cache::get('offers');
            $data = $all_offers->merge($data);
        }

        Cache::put('offers', $data);
        Cache::put('offer_page', $page);

        // $this->dispatchBrowserEvent('putProducts', [
        //     'products' => $data->toArray(),
        //     'images' => $data->pluck('media.0.media'),
        // ]);
        return $data;
    }

}
