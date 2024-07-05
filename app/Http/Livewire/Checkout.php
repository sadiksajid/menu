<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Index;
use App\Models\Store;
use App\Models\Client;
use Livewire\Component;
use App\Models\Quartier;
use App\Events\CaiseOrder;
use App\Models\StoreOrder;
use App\Models\ClientStore;
use Illuminate\Support\Str;
use App\Models\ClientAddress;
use App\Models\OrderProducte;
use App\Rules\EmailValidation;
use App\Rules\PhoneValidation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class Checkout extends Component
{

    public $total = 0;
    public $qte = 0;
    public $currency = 0;
    public $store_meta;

    public $client_firstname;
    public $client_lastname;
    public $client_phone;
    public $client_email;
    public $client_id;
    public $client_address;
    public $client_city;
    public $client_city_id;
    public $client_quarter;
    public $client_quarter_id;
    public $client_postal_code;
    public $shipping_type = 'shipping';
    public $cities = [];
    public $quarters = [];
    public $new_quarter_name;
    public $new_quarter = false;
    public $comment;
    public $password;
    public $password_confirmation;
    public $new_address = true;
    public $step = 1;
    public $all_address = [];
    public $address_id = null;
    public $coming_time;
    public $titles_checkout;
    public $images_checkout;

    protected $listeners = ['getCity', 'getQuarter', 'renderFunc'];

    //////////////////////////
    public $translations;
    public $translations_resto;

    public function mount()
    {
        $json = app('translations');
        $this->translations = $json['system'];
        // $this->cities = City::where('status', 1)->get();
        if (Auth::guard('client')->check()) {
            $user = Auth::guard('client')->user();
            $this->client_id = $user->id;
            $this->client_firstname = $user->firstname;
            $this->client_lastname = $user->lastname;
            $this->client_phone = $user->phone;
            $this->client_email = $user->email;
            $this->step = 2;
            $this->all_address = $user->client_address;
            $this->new_address = false;
            if (count($this->all_address) == 0) {
                $this->new_address = true;
            }
        }

        $this->store_meta = env('STOR_NAME');
        $stores = Cache::get('stores');

        if (isset($stores[$this->store_meta])) {
            $this->store_info = $stores[$this->store_meta];
        } else {
            $this->store_info = Store::where('store_meta', $this->store_meta)->first();
            $stores[$this->store_meta] = $this->store_info;
            Cache::put('stores', $stores, 7200);

        }

        $checkout_head = Index::where('store_id', $this->store_info->id)->where('name', 'checkout1')->first();
        if (!empty($checkout_head)) {
            $this->titles_checkout = $checkout_head->titles;
            $this->titles_checkout = json_decode($this->titles_checkout, true);
            $this->titles_checkout = $this->titles_checkout['title-1'];

            $this->images_checkout = $checkout_head->images;
            $this->images_checkout = json_decode($this->images_checkout, true);
            $this->images_checkout = $this->images_checkout['img_1'];

        }

        // $this->store_meta = getStoreName();
    }
    public function render()
    {

        $my_cart = $this->getData(0);

        return view('livewire.checkout.checkout', ['my_cart' => $my_cart]);

    }

    public function getData($rend = 0)
    {
        $my_cart = Cache::get('my_cart') ?? [];
        $this->total = 0;
        $this->qte = 0;
        $stores_info = Cache::get('store_info');
        if (count($my_cart) == 1) {
            $stores_info[array_key_first($my_cart)]['selected'] = true;
            Cache::put('store_info', $stores_info);

        }
        foreach ($my_cart as $store_meta => $store) {
            if ($stores_info[$store_meta]['selected'] == true) {
                foreach ($store as $item) {
                    $this->qte = $this->qte + $item['qte'];
                    $this->total = $this->total + ($item['product']['price'] * $item['qte']);
                }
            }

        }
        // if (!Cache::has('currency')) {
        //     $this->currency = 'DH';
        // } else {
        //     $this->currency = Cache::get('currency');
        // }
        $this->currency = $stores_info[array_key_first($my_cart)]['currency'] ?? 'DH';

        if ($rend == 1) {

            $this->dispatchBrowserEvent('changeCartPrice', [
                'curency' => $this->currency,
                'qte' => $this->qte,
                'total' => $this->total,
            ]);
        } else {
            return $my_cart;
        }

    }

    public function getCity()
    {
        $this->cities = City::where('verified', 1)->where('city', 'LIKE', "%{$this->client_city}%")->orderBy('city', 'ASC')->limit(4)->get();
        if (count($this->cities) >= 1) {
            $this->dispatchBrowserEvent('runDropCity');
        } else {
            $this->client_city_id = null;
        }
    }

    public function changeCity($city, $id)
    {
        $this->client_city = $city;
        $this->client_city_id = $id;
        $this->client_quarter = null;
        $this->client_quarter_id = null;

    }

    public function getQuarter()
    {
        $city_id = $this->client_city_id;
        $this->quarters = Quartier::where('verified', 1)->where('quartier', 'like', '%' . $this->client_quarter . '%')
            ->when($this->client_city_id, function ($query) use ($city_id) {
                $query->where('city_id', $city_id);
            })
            ->limit(4)->get();
        if (count($this->quarters) >= 1) {
            $this->dispatchBrowserEvent('runDropQuartier');
        } else {
            $this->client_quarter_id = null;
        }
    }

    public function changeQuarter($quarter, $id, $city_id)
    {
        $this->client_quarter = $quarter;
        $this->client_quarter_id = $id;
        if (empty($this->client_city)) {
            $city = City::find($city_id);
            $this->client_city = $city->city;
            $this->client_city_id = $city->$id;
        }

    }

    public function Step1()
    {

        $this->validate([
            'client_firstname' => 'required|string|max:50',
            'client_lastname' => 'required|string|max:50',
            'client_phone' => ['required', 'digits:10', 'unique:clients,phone', new PhoneValidation()],
            'client_email' => ['required', 'string', 'max:50', 'unique:clients,email', new EmailValidation()],
            'password' => 'required|confirmed|string|min:4',

        ]);

        $client = new Client();
        $client->firstname = $this->client_firstname;
        $client->lastname = $this->client_lastname;
        $client->phone = $this->client_phone;
        $client->email = $this->client_email;
        $client->password = Hash::make($this->password);
        $client->save();
        $this->client_id = $client->id;

        Auth::guard('client')->attempt(array('phone' => $this->client_email, 'password' => $this->password));
        $this->step = 2;

        $this->dispatchBrowserEvent('reload');
    }

    public function Order()
    {
        $my_cart = $this->getData(0);
        $stores_info = Cache::get('store_info');

        if (count($my_cart) == 0) {
            $this->dispatchBrowserEvent('swal:confirm_redirect', [
                'type' => 'warning',
                'title' => $this->translations['cart_is_empty'],
                'cancle' => false,
                'confirmBtn' => 'Ok',
                // 'url' => '/store/' . Cache::get('last_store'),
                'url' => '/shop',
                'outClick' => false,

            ]);
            return 0;
        }

        $this->validate([
            'client_id' => 'required|integer|max:99999',
            'comment' => 'nullable|string|max:500',
            'shipping_type' => 'nullable|string|max:99999',
            // 'store_meta' => 'required|string|max:50',
        ]);
        $client_id = $this->client_id;

        if ($this->shipping_type == 'shipping') {
            if ($this->address_id == null and $this->new_address == false) {
                $this->validate([
                    'address_id' => 'required|integer|max:99999',
                ]);

            } elseif ($this->address_id == null and $this->new_address == true) {

                $this->validate([
                    'client_address' => 'required|string|max:500',
                    'client_city' => 'required|string|max:50',
                    'client_quarter' => 'required|string|max:50',
                    'client_quarter_id' => 'nullable|integer|max:99999',
                    'client_city_id' => 'nullable|integer|max:99999',
                ]);

                if ($this->client_city_id == null) {

                    $city_search = City::where('verified', 1)->where('city', 'LIKE', "%{$this->client_city}%")->orderBy('city', 'ASC')->limit(2)->get();
                    if (count($city_search) == 1) {
                        $this->client_city_id = $city_search[0]->id;
                    } else {
                        $city = new City();
                        $city->city = $this->client_city;
                        $city->save();
                        $this->client_city_id = $city->id;
                    }

                }
                if ($this->client_quarter_id == null) {
                    $quarter = new Quartier();
                    $quarter->quartier = $this->client_quarter;
                    $quarter->city_id = $this->client_city_id;
                    $quarter->save();
                    $this->client_quarter_id = $quarter->id;
                }

                $address = new ClientAddress();
                $address->client_id = $client_id;
                $address->address = $this->client_address;
                $address->city_id = $this->client_city_id;
                $address->quartier_id = $this->client_quarter_id;
                $address->save();
                $address_id = $address->id;

            } else {
                $address_id = $this->address_id;
            }
        } else {

            $this->validate([
                'coming_time' => 'required|string',
            ]);
            $address_id = null;
        }
        foreach ($stores_info as $store_name => $value) {
            if ($value['selected'] == true) {
                $timestamp = now()->timestamp;
                $randomLetters = Str::random(3); // Adjust the length as needed
                $trackingCode = $timestamp . $randomLetters;

                $stor = Store::where('store_meta', $store_name)->select('id', 'currency')->first();
                $order = new StoreOrder();
                $order->client_id = $client_id;
                $order->client_address_id = $address_id;
                $order->store_id = $stor->id;
                $order->comment = $this->comment;
                $order->from_web = 1;
                $order->total = $this->total;
                $order->currency = $stor->currency;
                $order->order_type = $this->shipping_type;
                $order->payment_type = 'COD';
                $order->tracking = 'TR' . $trackingCode;
                if ($this->shipping_type == 'coming') {
                    $time = Carbon::now()->format('Y-m-d') . ' ' . $this->coming_time . ':00';
                    $order->coming_date = date($time);
                }
                $order->save();
                /////////////////////////////////////////
                if (!ClientStore::where('store_id', $stor->id)->where('client_id', $client_id)->exists()) {
                    $to_store = new ClientStore();
                    $to_store->store_id = $stor->id;
                    $to_store->client_id = $client_id;
                    $to_store->save();
                }
                /////////////////////////////////////////

                $products = [];
                $x = 0;
                $y = 0;
                $order_offers = array();
                foreach ($my_cart[$store_name] as $key => $product) {
                    if ($product['type'] == 'offer') {
                        $order_offers[$x]['id'] = $product['product']->id;
                        $order_offers[$x]['price'] = $product['product']->price * $product['qte'];
                        $order_offers[$x]['old_price'] = $product['product']->old_price * $product['qte'];
                        $order_offers[$x]['qte'] = $product['qte'];
                        $x++;

                        ////////////////////////////////////
                        foreach ($product['product']->products as $offer_prod) {
                            $products[$y] = array(
                                'store_product_id' => $offer_prod->store_product_id,
                                'store_order_id' => $order->id,
                                'qte' => $offer_prod->qty * $product['qte'],
                                'price' => $offer_prod->product->price * $product['qte'],
                                'total' => $offer_prod->product->price * $offer_prod->qty * $product['qte'],
                                'offer_id' => $product['product']->id,
                                'is_offer' => 1,
                                "created_at" => now(),
                                "updated_at" => now(),
                            );
                            $y++;
                        }
                    } else {
                        $products[$y] = array(
                            'store_product_id' => $product['product']->id,
                            'store_order_id' => $order->id,
                            'qte' => $product['qte'],
                            'price' => $product['product']->price,
                            'total' => $product['product']->price * $product['qte'],
                            'offer_id' => null,
                            'is_offer' => 0,
                            "created_at" => now(),
                            "updated_at" => now(),
                        );
                    }

                    $y++;
                };
                if (count($order_offers) > 0) {
                    $order->offers = json_encode($order_offers);
                    $order->save();
                }
                OrderProducte::insert($products);
            }

        }
        $my_cart = Cache::get('my_cart');
        $stores_info_back = $stores_info;
        foreach ($stores_info as $store_name => $value) {
            if ($value['selected'] == true) {
                unset($my_cart[$store_name]);
                unset($stores_info_back[$store_name]);
            }
        }
        Cache::put('my_cart', $my_cart);
        Cache::put('store_info', $stores_info_back);
        

        $data = array(
            "id" => $order->id ,
            "created_at" => $order->created_at ,
            "total" => $order->total ,
            "offers" =>  $order->offers  ,
            "order_type" =>  $order->order_type ,
            "coming_date" =>  $order->coming_date ,
            "status" => 'pending' ,
        );



        event(new CaiseOrder( $data));

        $this->dispatchBrowserEvent('swal:confirm_redirect', [
            'type' => 'success',
            'title' => $this->translations['order_submit_success'],
            'cancle' => false,
            'confirmBtn' => 'Ok',
            // 'url' => '/store/' . Cache::get('last_store'),
            'url' => '/shop',
            'outClick' => false,

        ]);

    }

    public function selectAddress($id)
    {
        $this->address_id = $id;

    }

    public function renderFunc()
    {

        $user = Auth::guard('client')->user();

        $this->client_id = $user->id;
        $this->client_firstname = $user->firstname;
        $this->client_lastname = $user->lastname;
        $this->client_phone = $user->phone;
        $this->client_email = $user->email;
        $this->step = 2;
        $this->all_address = $user->client_address;

        if (count($this->all_address) == 0) {
            $this->new_address = true;
        } else {
            $this->new_address = false;

        }

    }

    public function addAddress($val)
    {
        $this->new_address = $val;
    }

    public function changeDelivery($val)
    {
        $this->shipping_type = $val;
    }
}
