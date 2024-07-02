<?php

namespace App\Http\Livewire;

use App\Models\Index;
use App\Models\ProductCategory;
use App\Models\StoreProduct;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\Intl\Currencies;

class StoreClient extends Component
{
    use WithPagination;

    protected $all_products;
    public $currency;
    public $categories = [];
    public $quick_key = 0;
    public $paginat = 8;
    public $category_id = null;
    public $store_info = null;
    public $category_url = null;
    public $qte = 1;
    public $store_meta;
    public $shop_head;
    public $titles_shop;
    public $images_shop;
    public $texts_shop;

    // public $catigory_sizes = ['tmb' => ['w' => 150, 'h' => 150], 'origin' => ['w' => 300, 'h' => 300]];
    protected $listeners = ['addToCart', 'changeQte', 'storeComponent' => 'renderComponent', 'setViewStore', 'setViewProduct'];
    //////////////////////////
    public $translations;
    public $translations_resto;
////////////////////////////////

    public function mount($store_info, $category = null)
    {
        ///////////////////////////////
        $json = app('translations');
        $this->translations = $json['system'];
        $this->translations_resto = $json['resto'];
        ////////////////////////////////////////////
        $this->store_meta = $store_info->store_meta;
        $this->store_info = $store_info;
        $this->categories = ProductCategory::where('store_id', $store_info->id)
            ->select('product_categories.*')
            ->get();
        Cache::put('last_store', $this->store_meta);

        if ($category != null) {

            $this->category_url = $this->categories->where('category_meta', $category)->first()->id ?? null;
        }

        // foreach ($this->categories as $value) {
        //     add_to_tmb_if_not_category($value, 'categories', $this->catigory_sizes);
        // }

        $all_products = $this->getData(1);

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

        $this->shop_head = Index::where('store_id', $store_info->id)->where('name', 'shop1')->first();
        if (!empty($this->shop_head)) {
            $this->titles_shop = $this->shop_head->titles;

            $this->titles_shop = json_decode($this->titles_shop, true);
            $this->titles_shop = $this->titles_shop['title-1'];

            $this->images_shop = $this->shop_head->images;
            $this->images_shop = json_decode($this->images_shop, true);
            $this->images_shop = $this->images_shop['img_1'] ?? '';

            $this->texts_shop = $this->shop_head->texts;
            $this->texts_shop = json_decode($this->texts_shop, true);
            $this->texts_shop = $this->texts_shop['texts-1'];

        }

    }
    public function render()
    {
        $all_products = Cache::get('products');
        return view('livewire.store.front', ['products' => $all_products]);

    }

    public function setViewStore()
    {
        setView('store', $this->store_info->id);
    }
    public function setViewProduct($id)
    {
        setView('product', $this->store_info->id, $id);
    }
    public function nextPage()
    {
        $page = Cache::get('page');
        $page++;

        $next_prod = $this->getData($page, $this->category_id);

    }

    public function getData($page = 1, $category = null)
    {
        if ($this->category_url != null and $category == null) {
            $category = $this->category_url;
        }

        $data = StoreProduct::leftJoin('product_categories','store_products.product_category_id','product_categories.id')
        
            ->select('store_products.*')
            ->where('store_products.store_id', $this->store_info->id)
            ->with('media')
            ->when($category, function ($query) use ($category) {
                $query->where('store_products.product_category_id', $category);
            })
            ->orderBy('product_categories.sort','asc')
            ->paginate($this->paginat, ['*'], 'page', $page);

        if ($page > 1) {
            $all_products = Cache::get('products');
            $data = $all_products->merge($data);
        }

        Cache::put('products', $data);
        Cache::put('page', $page);

        $cat_name = $this->categories->where('id', $category)->first()->title ?? null;
        $this->dispatchBrowserEvent('putProducts', [
            'products' => $data->toArray(),
            'images' => $data->pluck('media.0.media'),
            // 'category' => $cat_name,
        ]);
        return $data;
    }

    public function SelectCategory($id)
    {
        $this->category_id = $id;
        $name = $this->categories->where('id', $id)->first()->title;
        $products = $this->getData(1, $id);

        $this->dispatchBrowserEvent('changeURL', [
            'title' => '/' . $this->store_info->title . ' - ' . $name,
            'url' => $name,
            'limit' => 3,
        ]);

    }

    public function addToCart($id, $type = 1)
    {
        $this->emit('ProductToCart', $id, $type, $this->qte ?? 1);

    }

    public function changeQte($qte)
    {
        $this->qte = $qte[0];

    }

    public function renderComponent()
    {
        $x = 1;
    }

}
