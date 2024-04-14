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

    public $store_id;
    public $store_info;

    public $data;
    public $upload_image = [];
    public $products;
    public $currency;
    public $to_delete_image_tm = 0;
    public $to_delete_image_edit = 0;
    public $offer_image_deleted = [];

    protected $listeners = ['editText', 'editBtn', 'editImg'];

    public function mount()
    {
        $this->store_id = Auth::user()->store_id;
        $this->store_info = Auth::user()->store;
        $this->data = Index::where('store_id', $this->store_id)->whereIn('name', ['shop1', 'offers1', 'orders1', 'cart1', 'checkout1'])->get();

        if (!empty($this->data)) {
            $this->shop = $this->data->where('name', 'shop1')->first();
            $this->offers = $this->data->where('name', 'offers1')->first();
            $this->orders = $this->data->where('name', 'orders1')->first();
            $this->cart = $this->data->where('name', 'cart1')->first();
            $this->checkout = $this->data->where('name', 'checkout1')->first();
        }

        if (!empty($this->shop)) {
            $this->titles_shop = $this->shop->titles;
            $this->titles_shop = json_decode($this->titles_shop, true);
            $this->titles_shop = $this->titles_shop['title-1'];
            $this->old_data['titles_shop'] = $this->titles_shop ?? '';

            $this->images_shop = $this->shop->images;
            $this->images_shop = json_decode($this->images_shop, true);
            $this->images_shop = $this->images_shop['img_1'];

            $this->texts_shop = $this->shop->texts;
            $this->texts_shop = json_decode($this->texts_shop, true);
            $this->texts_shop = $this->texts_shop['texts-1'];
            $this->old_data['texts_shop'] = $this->texts_shop ?? '';

        }

        // dd($this->offers);
        if (!empty($this->offers)) {
            $this->titles_offers = $this->offers->titles;
            $this->titles_offers = json_decode($this->titles_offers, true);
            $this->titles_offers = $this->titles_offers['title-1'];
            $this->old_data['titles_offers'] = $this->titles_offers ?? '';

            $this->images_offers = $this->offers->images;
            $this->images_offers = json_decode($this->images_offers, true);
            $this->images_offers = $this->images_offers['img_1'] ?? null;

            $this->texts_offers = $this->offers->texts;
            $this->texts_offers = json_decode($this->texts_offers, true);
            $this->texts_offers = $this->texts_offers['texts-1'];
            $this->old_data['texts_offers'] = $this->texts_offers ?? '';

        }
        if (!empty($this->orders)) {
            $this->titles_orders = $this->orders->titles;
            $this->titles_orders = json_decode($this->titles_orders, true);
            $this->titles_orders = $this->titles_orders['title-1'];
            $this->old_data['titles_orders'] = $this->titles_orders ?? '';

            $this->images_orders = $this->orders->images;
            $this->images_orders = json_decode($this->images_orders, true);
            $this->images_orders = $this->images_orders['img_1'] ?? null;

        }
        if (!empty($this->cart)) {
            $this->titles_cart = $this->cart->titles;
            $this->titles_cart = json_decode($this->titles_cart, true);
            $this->titles_cart = $this->titles_cart['title-1'];
            $this->old_data['titles_cart'] = $this->titles_cart ?? '';

            $this->images_cart = $this->cart->images;
            $this->images_cart = json_decode($this->images_cart, true);
            $this->images_cart = $this->images_cart['img_1'] ?? null;

        }
        if (!empty($this->checkout)) {
            $this->titles_checkout = $this->checkout->titles;
            $this->titles_checkout = json_decode($this->titles_checkout, true);
            $this->titles_checkout = $this->titles_checkout['title-1'];
            $this->old_data['titles_checkout'] = $this->titles_checkout ?? '';

            $this->images_checkout = $this->checkout->images;
            $this->images_checkout = json_decode($this->images_checkout, true);
            $this->images_checkout = $this->images_checkout['img_1'] ?? null;
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
        $this->upload_image[$index] = '';
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
                    $this->images_shop = '';
                    break;
                case 'checkout':
                    $this->images_checkout = '';
                    break;
                case 'offers':
                    $this->images_offers = '';
                    break;
                case 'orders':
                    $this->images_orders = '';
                    break;
                case 'cart':
                    $this->images_cart = '';
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
            $save_result = save_livewire_filetocdn($image, 'shop1', $img_link);
            $img_link = 'shop1/'.$img_link ;

            if ($save_result) {
                $images['img_1'] = $img_link;
            }

        }
        $titles['title-1'] = $this->titles_shop;
        $texts['texts-1'] = $this->texts_shop;

        if (!isset($this->old_data['titles_shop'])) {

            $shop = new Index();
            $shop->language = 'EN';
            $shop->name = 'shop1';

        } elseif ($this->old_data['titles_shop'] != $this->titles_shop or $this->old_data['texts_shop'] != $this->texts_shop or !empty($this->upload_image['shop'])) {
            $shop = Index::where('store_id', $this->store_id)->where('name', 'shop1')->first();

        }
        if (isset($shop)) {
            $shop->titles = json_encode($titles);
            $shop->texts = json_encode($texts);
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
            $save_result = save_livewire_filetocdn($image, 'offers1', $img_link);
            $img_link = 'offers1/'.$img_link ;

            if ($save_result) {
                $images['img_1'] = $img_link;
            }

        }
        $titles['title-1'] = $this->titles_offers;
        $texts['texts-1'] = $this->texts_offers;

        if (!isset($this->old_data['titles_offers'])) {

            $offers = new Index();
            $offers->language = 'EN';
            $offers->name = 'offers1';
        } elseif ($this->old_data['titles_offers'] != $this->titles_offers or $this->old_data['texts_offers'] != $this->texts_offers or !empty($this->upload_image['offers'])) {
            $offers = Index::where('store_id', $this->store_id)->where('name', 'offers1')->first();
        }
        if (isset($offers)) {
            $offers->titles = json_encode($titles);
            $offers->texts = json_encode($texts);
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
            $save_result = save_livewire_filetocdn($image, 'orders1', $img_link);
            $img_link = 'orders1/'.$img_link ;


            if ($save_result) {
                $images['img_1'] = $img_link;
            }

        }
        $titles['title-1'] = $this->titles_orders;

        if (!isset($this->old_data['titles_orders'])) {

            $orders = new Index();
            $orders->language = 'EN';
            $orders->name = 'orders1';

        } elseif ($this->old_data['titles_orders'] != $this->titles_orders or !empty($this->upload_image['orders'])) {
            $orders = Index::where('store_id', $this->store_id)->where('name', 'orders1')->first();

        }
        if (isset($orders)) {
            $orders->titles = json_encode($titles);
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
            $save_result = save_livewire_filetocdn($image, 'cart1', $img_link);
            $img_link = 'cart1/'.$img_link ;


            if ($save_result) {
                $images['img_1'] = $img_link;
            }

        }
        $titles['title-1'] = $this->titles_cart;

        if (!isset($this->old_data['titles_cart'])) {

            $cart = new Index();
            $cart->language = 'EN';
            $cart->name = 'cart1';

        } elseif ($this->old_data['titles_cart'] != $this->titles_cart or !empty($this->upload_image['cart'])) {
            $cart = Index::where('store_id', $this->store_id)->where('name', 'cart1')->first();

        }

        if (isset($cart)) {
            $cart->titles = json_encode($titles);
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
            $save_result = save_livewire_filetocdn($image, 'checkout1', $img_link);
            $img_link = 'checkout1/'.$img_link ;


            if ($save_result) {
                $images['img_1'] = $img_link;
            }

        }
        $titles['title-1'] = $this->titles_checkout;

        if (!isset($this->old_data['titles_checkout'])) {

            $checkout = new Index();
            $checkout->language = 'EN';
            $checkout->name = 'checkout1';

        } elseif ($this->old_data['titles_checkout'] != $this->titles_checkout or !empty($this->upload_image['checkout'])) {
            $checkout = Index::where('store_id', $this->store_id)->where('name', 'checkout1')->first();

        }

        if (isset($checkout)) {
            $checkout->titles = json_encode($titles);
            if (isset($images['img_1'])) {
                $checkout->images = json_encode($images);
            }
            $checkout->store_id = $this->store_id;
            $checkout->save();
        }

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Update Saved!',
        ]);

    }

    public function editBtn($id, $data)
    {
        $this->buttons[$id] = array(
            'title' => $data[0],
            'url' => $data[1],
        );

        $this->data->buttons = json_encode($this->buttons);
        $this->data->save();
    }

    public function editImg($id)
    {
        if (!empty($this->upload_image)) {
            $img_link = 'index1_' . md5(microtime()) . '.webp';
            $image = File::get($this->upload_image->getRealPath());
            $save_result = save_livewire_filetocdn($image, 'index1', $img_link);
            $img_link = 'index1/'.$img_link ;


            if ($save_result) {
                $this->images[$id] = $img_link;
                $this->data->images = json_encode($this->images);
                $this->data->save();
                $this->dispatchBrowserEvent('closeModal');
            } else {
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'warning',
                    'message' => 'Problem in Image',
                ]);
            }

        }

    }

}
