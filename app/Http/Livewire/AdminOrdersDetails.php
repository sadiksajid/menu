<?php

namespace App\Http\Livewire;

use App\Models\ClientAddress;
use App\Models\Quartier;
use App\Models\QuartierLocation;
use App\Models\StoreOrder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrdersDetails extends Component
{
    use WithPagination;
    public $total = 0;
    public $qte = 0;
    public $currency = 0;
    public $order;
    public $comment = '', $adminComment = '', $comments = [];
    public $receiver_calls = 0;
    public $checklocal = false;
    public $edit_quartier_name = false;
    public $correct_quartier;
    public $longitude;
    public $latitude;
    public $fix_longitude;
    public $fix_latitude;
    public $time_left;

    protected $listeners = ['getRoutInfo', 'getlocal', 'changeCity', 'getQuarter', 'changeQuartier', 'Save', 'Next', 'showMap'];
    ////////////////////////////
    public $translations;
    public $currentLocale;

    public function mount($id)
    {
        $this->translations = app('translations_admin');

        $this->order = StoreOrder::where('id', $id)
            ->with(['products' => function ($q) {
                $q->with(['product' => function ($q) {
                    $q->select('id', 'title', 'price');
                    $q->with(['media' => function ($q) {
                        $q->first();
                    }]);
                }]);
            }])
            ->with(['client' => function ($q) {
                $q->select('id', 'firstname', 'lastname', 'email', 'phone');
            }])
            ->with(['client_address' => function ($q) {
                $q->select('*');
                $q->with('city');
                $q->with('quartier');

            }])
            ->first();
        $this->receiver_calls = $this->order->receiver_calls;
        $this->adminComment = $this->order->admin_comment;
        $this->fix_latitude = $this->order->client_address->latitude ?? null;
        $this->fix_longitude = $this->order->client_address->longitude ?? null;
        if ($this->order->order_type == 'coming') {
            $lastTime = strtotime($this->order->coming_date);
            $firstTime = Carbon::now()->timestamp;

            $difference = $diff = $lastTime - $firstTime;
            $difference = abs($difference);
            $hours = intval($difference / 3600);
            $minuts = intval(($difference - ($hours * 3600)) / 60);
            $seconds = $difference - ($hours * 3600) - ($minuts * 60);
            $this->time_left = array(
                'h' => $hours,
                'm' => $minuts,
                's' => $seconds,
                'rotar' => $diff < 0,
            );
        }
        // dd($this->order);
    }
    public function render()
    {
        return view('livewire.admin.orders.order_confirm');

    }

    public function showMap()
    {
        if (isset($this->fix_latitude)) {
            $data = [

                'change_la' => $this->fix_latitude,
                'change_lo' => $this->fix_longitude,
                'change_name' => $this->order->client->firstname . ' ' . $this->order->client->lastname,
                'change_type' => 'Receiver',
                'is_express' => true,
                'click_to_drag' => false,
            ];
        } else {
            $data = [
                'change_name' => $this->order->client->firstname . ' ' . $this->order->client->lastname,
                'change_type' => 'Address',
            ];
        }

        $this->dispatchBrowserEvent('maps:maps_change_loacal_calcul_price', $data);
    }

    public function getlocal($post)
    {
        $this->latitude = $post['latitude'];
        $this->longitude = $post['longitude'];
        $this->checklocal = false;
        $this->edit_quartier_name = false;
        // $this->SaveChangeLocation();

    }
    public function checkLoactionInfo()
    {
        if ($this->latitude != null) {
            $this->checklocal = true;
            $this->edit_quartier_name = false;
        } else {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'warning',
                'message' => $this->translations['order_detail_message_1'],

            ]);
        }
    }
    public function ChangeQuartierName()
    {
        if ($this->latitude != null) {
            $this->checklocal = false;
            $this->edit_quartier_name = true;
        }
    }
    public function saveRecieverLocation()
    {
        $address = ClientAddress::find($this->order->client_address->id);
        $address->latitude = $this->latitude;
        $address->longitude = $this->longitude;
        $address->save();

        $quartier = new QuartierLocation();
        $quartier->latitude = $this->latitude;
        $quartier->longitude = $this->longitude;
        $quartier->quartier_id = $this->order->client_address->quartier->id;
        $quartier->client_id = Auth::id();
        $quartier->save();
        $this->fix_longitude = $this->longitude;
        $this->fix_latitude = $this->latitude;
        $this->checklocal = false;
        $this->edit_quartier_name = false;

    }

    public function saveChangeRecieverLocation()
    {

        $this->validate([
            'correct_quartier' => 'required|string|max:30',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $n_quartier = new Quartier();
        $n_quartier->city_id = $this->order->client_address->quartier->city_id;
        $n_quartier->code_postal = $this->order->client_address->quartier->code_postal;
        $n_quartier->quartier = $this->correct_quartier;
        $n_quartier->status = 0;
        $n_quartier->verified = 0;
        $n_quartier->source_id = $this->order->client_address->quartier->id;
        $n_quartier->save();

        $address = ClientAddress::find($this->order->client_address->id);
        $address->latitude = $this->latitude;
        $address->longitude = $this->longitude;
        $address->quartier_id = $n_quartier->id;
        $address->save();

        $quartier = new QuartierLocation();
        $quartier->latitude = $this->latitude;
        $quartier->longitude = $this->longitude;
        $quartier->quartier_id = $n_quartier->id;
        $quartier->client_id = Auth::id();
        $quartier->save();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => $this->translations['order_detail_message_2'],
        ]);

        $this->fix_longitude = $this->longitude;
        $this->fix_latitude = $this->latitude;
        $this->checklocal = false;
        $this->edit_quartier_name = false;
        $this->showMap();
    }

    public function receiver_calls($nbr)
    {

        $this->receiver_calls = $nbr;
        if (!empty($this->adminComment)) {
            $this->adminComment .= " \n  ";
        }
        $this->adminComment .= "- ( " . now()->format("H:i") . " ) Receiver TRY " . $this->receiver_calls . " : ";
    }
    public function saveComment()
    {

        if (empty($this->adminComment)) {
            $this->adminComment .= 'No answer ( ' . now()->format('H:i') . ' )... ';
        }
        // $order = StoreOrder::find($this->order->id);
        $this->validate(
            [
                'adminComment' => 'nullable|string|max:1500',
                'receiver_calls' => 'nullable|integer|max:4',
            ]
        );
        $this->order->admin_comment = $this->adminComment;
        $this->order->receiver_calls = $this->receiver_calls;
        $this->order->save();

        if (isset($this->latitude)) {
            $address = ClientAddress::find($this->order->client_address->id);
            $address->latitude = $this->latitude;
            $address->longitude = $this->longitude;
            $address->save();

        }

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => $this->translations['changes_saved'],
        ]);
    }

    public function orderstatus($status)
    {

        $this->validate(
            [
                'adminComment' => 'nullable|string|max:1500',
                'receiver_calls' => 'nullable|integer|max:4',

            ]
        );
        $this->order->admin_comment = $this->adminComment;
        $this->order->receiver_calls = $this->receiver_calls;
        $this->order->status = $status;
        $this->order->save();

        if ($status == 'confirmed') {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'message' => $this->translations['order_detail_message_3'],
            ]);
        } else {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'warning',
                'message' => $this->translations['order_detail_message_4'],
            ]);
        }
    }

}
