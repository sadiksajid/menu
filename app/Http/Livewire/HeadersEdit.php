<?php

namespace App\Http\Livewire;

use App\Models\Index;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class HeadersEdit extends Component
{
    use WithFileUploads;

    public $shop;
    public $titles_shop;
    public $images_shop;
    public $texts_shop;

    public $offers;
    public $titles_offers;
    public $images_offers;
    public $texts_offers;

    public $orders;
    public $titles_orders;
    public $images_orders;
    public $texts_orders;

    public $cart;
    public $titles_cart;
    public $images_cart;
    public $texts_cart;

    public $checkout;
    public $titles_checkout;
    public $images_checkout;
    public $old_data = [];

    public $competition_header;
    public $images_competition_header;

    public $competition_home;
    public $images_competition_home;

    public $store_id;
    public $store_info;

    public $data;
    public $upload_image = [];
    public $products;
    public $currency;
    public $to_delete_image_tm = 0;
    public $to_delete_image_edit = 0;
    public $offer_image_deleted = [];
    public $langs = [];

    protected $listeners = ['editText', 'editBtn', 'editImg'];

    ////////////////////////////////
    public $translations;

    public function mount()
    {
        $this->langs = languages()['langs'];
        $this->translations = app('translations_admin');
        ///////////////////////////////////

        $this->store_id = Auth::user()->store_id;
        $this->store_info = Auth::user()->store;
        $this->data = Index::where('store_id', $this->store_id)->whereIn('name', ['shop1', 'offers1', 'orders1', 'cart1', 'checkout1', 'competition_header1', 'competition_home1'])->get();

        if (!empty($this->data)) {
            $this->shop = $this->data->where('name', 'shop1')->first();
            $this->offers = $this->data->where('name', 'offers1')->first();
            $this->orders = $this->data->where('name', 'orders1')->first();
            $this->cart = $this->data->where('name', 'cart1')->first();
            $this->checkout = $this->data->where('name', 'checkout1')->first();
            $this->competition_header = $this->data->where('name', 'competition_header1')->first();
            $this->competition_home = $this->data->where('name', 'competition_home1')->first();

        }

        /////////////  shop

        if (!empty($this->shop)) {

            $titles_shop = $this->shop->getTranslation('titles', 'en');
            $this->titles_shop = json_decode($titles_shop, true);

            $this->titles_shop = $this->titles_shop['title-1'] ?? '';
            $this->old_data['titles_shop'] = $this->titles_shop ?? '';

            $texts_shop = $this->shop->getTranslation('texts', 'en');
            $this->texts_shop = json_decode($texts_shop, true);

            $this->texts_shop = $this->texts_shop['texts-1'] ?? '';
            $this->old_data['texts_shop'] = $this->texts_shop ?? '';

            $this->images_shop = $this->shop->images;
            $this->images_shop = json_decode($this->images_shop, true);
            $this->images_shop = $this->images_shop['img_1'] ?? null;

        }


        /////////////  offers
        if (!empty($this->offers)) {
            $titles_offers = $this->offers->getTranslation('titles', 'en');
            $this->titles_offers = json_decode($titles_offers, true);
            $this->titles_offers = $this->titles_offers['title-1'] ?? '';
            $this->old_data['titles_offers'] = $this->titles_offers ?? '';

            $this->images_offers = $this->offers->images;
            $this->images_offers = json_decode($this->images_offers, true);
            $this->images_offers = $this->images_offers['img_1'] ?? null;

            $texts_offers = $this->offers->getTranslation('texts', 'en');
            $this->texts_offers = json_decode($texts_offers, true);
            $this->texts_offers = $this->texts_offers['texts-1'] ?? '';
            $this->old_data['texts_offers'] = $this->texts_offers ?? '';

        }

         /////////////  orders
        if (!empty($this->orders)) {
            $titles_orders = $this->orders->getTranslation('titles', 'en');
            $this->titles_orders = json_decode($titles_orders, true);
            $this->titles_orders = $this->titles_orders['title-1'] ?? '';
            $this->old_data['titles_orders'] = $this->titles_orders ?? '';

            $this->images_orders = $this->orders->images;
            $this->images_orders = json_decode($this->images_orders, true);
            $this->images_orders = $this->images_orders['img_1'] ?? null;

        }

         /////////////  cart
        if (!empty($this->cart)) {
            $titles_cart = $this->cart->getTranslation('titles', 'en');
            $this->titles_cart = json_decode($titles_cart, true);
            $this->titles_cart = $this->titles_cart['title-1'] ?? '';
            $this->old_data['titles_cart'] = $this->titles_cart ?? '';

            $this->images_cart = $this->cart->images;
            $this->images_cart = json_decode($this->images_cart, true);
            $this->images_cart = $this->images_cart['img_1'] ?? null;

        }

         /////////////  checkout
        if (!empty($this->checkout)) {
            $titles_checkout = $this->checkout->getTranslation('titles', 'en');
            $this->titles_checkout = json_decode($titles_checkout, true);
            $this->titles_checkout = $this->titles_checkout['title-1'] ?? '';
            $this->old_data['titles_checkout'] = $this->titles_checkout ?? '';

            $this->images_checkout = $this->checkout->images;
            $this->images_checkout = json_decode($this->images_checkout, true);
            $this->images_checkout = $this->images_checkout['img_1'] ?? null;
        }

        /////////////  competition_header
        if (!empty($this->competition_header)) {

            $this->images_competition_header = $this->competition_header->images;
            $this->images_competition_header = json_decode($this->images_competition_header, true);
            $this->images_competition_header = $this->images_competition_header['img_1'] ?? null;
        }

        /////////////  competition_home
        if (!empty($this->competition_home)) {

            $this->images_competition_home = $this->competition_home->images;
            $this->images_competition_home = json_decode($this->images_competition_home, true);
            $this->images_competition_home = $this->images_competition_home['img_1'] ?? null;
        }
    }

    public function render()
    {

        return view('livewire.admin.headers_edit.headers_edit');

    }

    public function to_delete_image_tm($index)
    {
        $this->to_delete_image_tm = $index;
    }

    public function no_delete_image_tm()
    {
        $this->to_delete_image_tm = -1;
    }

    public function delete_image_tm($index)
    {
        $this->upload_image[$index] = null;
        $this->to_delete_image_tm = -1;
    }

    public function to_delete_image_edit($index)
    {
        $this->to_delete_image_edit = $index;
    }

    public function no_delete_image_edit()
    {
        $this->to_delete_image_edit = -1;
    }

    public function delete_image_edit($index)
    {

        if ($this->to_delete_image_edit != -1) {
            $this->offer_image_deleted[] = $index;
            switch ($index) {
                case 'shop':
                    deleteFile($this->images_shop);
                    $this->shop->images = '' ;
                    $this->shop->save() ;
                    $this->images_shop = '';
                    break;
                case 'checkout':
                    deleteFile($this->images_checkout);
                    $this->checkout->images = '' ;
                    $this->checkout->save() ;
                    $this->images_checkout = '';
                    break;
                case 'offers':
                    deleteFile($this->images_offers);
                    $this->offers->images = '' ;
                    $this->offers->save() ;
                    $this->images_offers = '';
                    break;
                case 'orders':
                    deleteFile($this->images_orders);
                    $this->images_orders = '';
                    break;
                case 'cart':
                    deleteFile($this->images_cart);
                    $this->orders->images = '' ;
                    $this->orders->save() ;

                    $this->images_cart = '';
                    break;
                case 'competition_header':
                    deleteFile($this->images_competition_header);
                    $this->competition_header->images = '' ;
                    $this->competition_header->save() ;
                    $this->images_competition_header = '';
                    break;
                case 'competition_home':
                    deleteFile($this->images_competition_home);
                    $this->competition_home->images = '' ;
                    $this->competition_home->save() ;
                    $this->images_competition_home = '';
                    break;

            }

            $this->to_delete_image_edit = -1;
        }

    }

    public function Update()
    {
        ////////////////////// shop
        if (!empty($this->upload_image['shop'])) {
            $img_link = 'shop1_' . md5(microtime()) . '.webp';
            $image = File::get($this->upload_image['shop']->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'web_headers/shop1', $img_link);
            $img_link = 'web_headers/shop1/' . $img_link;

            if ($save_result) {
                $images['img_1'] = $img_link;
            }

        }

        if (!isset($this->old_data['titles_shop'])) {

            $shop = new Index();
            $shop->language = 'EN';
            $shop->name = 'shop1';

        } elseif ($this->old_data['titles_shop'] != $this->titles_shop or $this->old_data['texts_shop'] != $this->texts_shop or !empty($this->upload_image['shop'])) {
            $shop = Index::where('store_id', $this->store_id)->where('name', 'shop1')->first();

        }
        if (isset($shop)) {

            $titles = [];
            $texts = [];

            foreach ($this->langs as $lang) {
                if ($lang == 'en') {
                    $titles['en']['title-1'] = $this->titles_shop;
                    $texts['en']['texts-1'] = $this->texts_shop;
                } else {
                    $titles[$lang]['title-1'] = translate($this->titles_shop, $lang);
                    $texts[$lang]['texts-1'] = translate($this->texts_shop, $lang);
                }

                $shop->setTranslation('titles', $lang, json_encode($titles[$lang], JSON_UNESCAPED_UNICODE));
                $shop->setTranslation('texts', $lang, json_encode($texts[$lang], JSON_UNESCAPED_UNICODE));

            }

            if (isset($images['img_1'])) {
                $shop->images = json_encode($images);
            }
            $shop->store_id = $this->store_id;
            $shop->save();
        }

        ////////////////////// Offer
        $images = [];
        if (!empty($this->upload_image['offers'])) {
            $img_link = 'offers1_' . md5(microtime()) . '.webp';
            $image = File::get($this->upload_image['offers']->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'web_headers/offers1', $img_link);
            $img_link = 'web_headers/offers1/' . $img_link;

            if ($save_result) {
                $images['img_1'] = $img_link;
            }

        }

        if (!isset($this->old_data['titles_offers'])) {

            $offers = new Index();
            $offers->language = 'EN';
            $offers->name = 'offers1';
        } elseif ($this->old_data['titles_offers'] != $this->titles_offers or $this->old_data['texts_offers'] != $this->texts_offers or !empty($this->upload_image['offers'])) {
            $offers = Index::where('store_id', $this->store_id)->where('name', 'offers1')->first();
        }
        if (isset($offers)) {

            $titles = [];
            $texts = [];
            foreach ($this->langs as $lang) {
                if ($lang == 'en') {
                    $titles['en']['title-1'] = $this->titles_offers;
                    $texts['en']['texts-1'] = $this->texts_offers;
                } else {
                    $titles[$lang]['title-1'] = translate($this->titles_offers, $lang);
                    $texts[$lang]['texts-1'] = translate($this->texts_offers, $lang);
                }

                $offers->setTranslation('titles', $lang, json_encode($titles[$lang], JSON_UNESCAPED_UNICODE));
                $offers->setTranslation('texts', $lang, json_encode($texts[$lang], JSON_UNESCAPED_UNICODE));

            }

            if (isset($images['img_1'])) {
                $offers->images = json_encode($images);
            }
            $offers->store_id = $this->store_id;
            $offers->save();
        }

        ////////////////////// orders
        $images = [];

        if (!empty($this->upload_image['orders'])) {
            $img_link = 'orders1_' . md5(microtime()) . '.webp';
            $image = File::get($this->upload_image['orders']->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'web_headers/orders1', $img_link);
            $img_link = 'web_headers/orders1/' . $img_link;

            if ($save_result) {
                $images['img_1'] = $img_link;
            }

        }

        if (!isset($this->old_data['titles_orders'])) {

            $orders = new Index();
            $orders->language = 'EN';
            $orders->name = 'orders1';

        } elseif ($this->old_data['titles_orders'] != $this->titles_orders or !empty($this->upload_image['orders'])) {
            $orders = Index::where('store_id', $this->store_id)->where('name', 'orders1')->first();

        }
        if (isset($orders)) {
            $titles = [];
            foreach ($this->langs as $lang) {
                if ($lang == 'en') {
                    $titles['en']['title-1'] = $this->titles_orders;
                } else {
                    $titles[$lang]['title-1'] = translate($this->titles_orders, $lang);
                }
                $orders->setTranslation('titles', $lang, json_encode($titles[$lang], JSON_UNESCAPED_UNICODE));

            }

            if (isset($images['img_1'])) {
                $orders->images = json_encode($images);
            }
            $orders->store_id = $this->store_id;
            $orders->save();
        }

        ////////////////////// Cart
        $images = [];

        if (!empty($this->upload_image['cart'])) {
            $img_link = 'cart1_' . md5(microtime()) . '.webp';
            $image = File::get($this->upload_image['cart']->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'web_headers/cart1', $img_link);
            $img_link = 'web_headers/cart1/' . $img_link;

            if ($save_result) {
                $images['img_1'] = $img_link;
            }

        }

        if (!isset($this->old_data['titles_cart'])) {

            $cart = new Index();
            $cart->language = 'EN';
            $cart->name = 'cart1';

        } elseif ($this->old_data['titles_cart'] != $this->titles_cart or !empty($this->upload_image['cart'])) {
            $cart = Index::where('store_id', $this->store_id)->where('name', 'cart1')->first();

        }
        $titles = [];
        if (isset($cart)) {
            $titles = [];
            foreach ($this->langs as $lang) {
                if ($lang == 'en') {
                    $titles['en']['title-1'] = $this->titles_cart;
                } else {
                    $titles[$lang]['title-1'] = translate($this->titles_cart, $lang);
                }
                $cart->setTranslation('titles', $lang, json_encode($titles[$lang], JSON_UNESCAPED_UNICODE));

            }

            if (isset($images['img_1'])) {
                $cart->images = json_encode($images);
            }
            $cart->store_id = $this->store_id;
            $cart->save();
        }

        ////////////////////// checkout
        $images = [];

        if (!empty($this->upload_image['checkout'])) {
            $img_link = 'checkout1_' . md5(microtime()) . '.webp';
            $image = File::get($this->upload_image['checkout']->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'web_headers/checkout1', $img_link);
            $img_link = 'web_headers/checkout1/' . $img_link;

            if ($save_result) {
                $images['img_1'] = $img_link;
            }

        }

        if (!isset($this->old_data['titles_checkout'])) {

            $checkout = new Index();
            $checkout->language = 'EN';
            $checkout->name = 'checkout1';

        } elseif ($this->old_data['titles_checkout'] != $this->titles_checkout or !empty($this->upload_image['checkout'])) {
            $checkout = Index::where('store_id', $this->store_id)->where('name', 'checkout1')->first();

        }

        if (isset($checkout)) {
            foreach ($this->langs as $lang) {
                $titles = [];

                if ($lang == 'en') {
                    $titles['en']['title-1'] = $this->titles_checkout;
                } else {
                    $titles[$lang]['title-1'] = translate($this->titles_checkout, $lang);
                }
                $checkout->setTranslation('titles', $lang, json_encode($titles[$lang], JSON_UNESCAPED_UNICODE));
            }

            if (isset($images['img_1'])) {
                $checkout->images = json_encode($images);
            }
            $checkout->store_id = $this->store_id;
            $checkout->save();
        }
        ///////////////////////////////////////// competition header
        $images = [];
        if (!empty($this->upload_image['competition_header'])) {
            $img_link = 'competition_header1_' . md5(microtime()) . '.webp';
            $image = File::get($this->upload_image['competition_header']->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'web_headers/competition_header1', $img_link);
            $img_link = 'web_headers/competition_header1/' . $img_link;

            if ($save_result) {
                $images['img_1'] = $img_link;
            }

        }

        if (!isset($this->competition_header)) {

            $competition_header = new Index();
            $competition_header->language = 'EN';
            $competition_header->name = 'competition_header1';

        } elseif (!empty($this->upload_image['competition_header'])) {
            $competition_header = Index::where('store_id', $this->store_id)->where('name', 'competition_header1')->first();

        }

        if (isset($competition_header)) {
            if (isset($images['img_1'])) {
                $competition_header->images = json_encode($images);
            }
            $competition_header->store_id = $this->store_id;
            $competition_header->save();
        }

        /////////////////////////////////////////////// competion hone

        $images = [];
        if (!empty($this->upload_image['competition_home'])) {
            $img_link = 'competition_home1_' . md5(microtime()) . '.webp';
            $image = File::get($this->upload_image['competition_home']->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'web_headers/competition_home1', $img_link);
            $img_link = 'web_headers/competition_home1/' . $img_link;
            if ($save_result) {
                $images['img_1'] = $img_link;
            }

        }

        if (!isset($this->competition_home)) {

            $competition_home = new Index();
            $competition_home->language = 'EN';
            $competition_home->name = 'competition_home1';

        } elseif (!empty($this->upload_image['competition_home'])) {
            $competition_home = Index::where('store_id', $this->store_id)->where('name', 'competition_home1')->first();

        }

        if (isset($competition_home)) {
            if (isset($images['img_1'])) {
                $competition_home->images = json_encode($images);
            }
            $competition_home->store_id = $this->store_id;
            $competition_home->save();
        }

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => $this->translations['update_save'],
        ]);

    }

    public function editImg($id)
    {
        if (!empty($this->upload_image)) {
            $img_link = 'index1_' . md5(microtime()) . '.webp';
            $image = File::get($this->upload_image->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'web_headers/index1', $img_link);
            $img_link = 'web_headers/index1/' . $img_link;

            if ($save_result) {
                $this->images[$id] = $img_link;
                $this->data->images = json_encode($this->images);
                $this->data->save();
                $this->dispatchBrowserEvent('closeModal');
            } else {
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'warning',
                    'message' => $this->translations['image_problem'],
                ]);
            }

        }

    }

}
