<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\OrderProducte;
use App\Models\ProductView;
use App\Models\StoreOrder;
use App\Models\StoreView;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Symfony\Component\Intl\Currencies;

class AdminDashboard extends Component
{

    public $statusCounts;
    public $orders = [];
    public $res_orders = [];

    public $today;
    public $yasterday;
    public $todayOrders = 0;
    public $orders_list = 0;
    public $all_clients = 0;
    public $this_month_clients = 0;
    public $last_month_clients = 0;
    public $total_incum = 0;
    public $today_incum = 0;
    public $yesterday_incum = 0;
    public $currency;
    public $store_info;
    public $top_products = [];
    public $top_offers = [];

    public $view_week = [];

    public function mount()
    {
        $this->today = Carbon::today()->format('Y-m-d');
        $this->yasterday = Carbon::today()->subDays(1)->format('Y-m-d');
        $this->store_info = Auth::user()->store;

        if (isset($this->store_info->currency)) {
            $this->currency = Currencies::getSymbol($this->store_info->currency);
        } else {
            $this->currency = 'DH';
        }
        $this->getOrdersCounts();
        $this->getViews();
        $this->getClientsCounts();
        $this->getOrders();
        $this->getTopProducts();
        $this->getTopOffers();

    }
    public function render()
    {
        return view('livewire.admin.dashboard.dashboard');

    }
    public function getOrders()
    {
        $this->orders_list = StoreOrder::where('store_id', $this->store_info->id)
        // ->leftJoin('clients', 'clients.id', 'store_orders.client_id')
            ->with(['client' => function ($q) {
                $q->select('id', 'firstname', 'lastname');
            }])
            ->with(['products' => function ($q) {
                $q->with(['product' => function ($q) {
                    $q->select('id');
                    $q->with('media');
                }]);
            }])
            ->whereIn('status', ['pending'])
            ->select('store_orders.id', 'store_orders.store_id', 'store_orders.client_id', 'store_orders.currency', 'store_orders.total', 'store_orders.status', 'store_orders.order_type', 'store_orders.created_at')
            ->orderBy('store_orders.created_at', 'DESC')
            ->limit(10)->get();
        // dd($this->orders_list);
    }
    public function getClientsCounts()
    {
        $all_clients = Client::leftjoin('client_stores', 'client_stores.client_id', 'clients.id')
            ->select('clients.id', 'client_stores.created_at as date')
            ->where('client_stores.store_id', $this->store_info->id)
        // ->whereDate('created_at', Carbon::today())
            ->get();
        $this->all_clients = count($all_clients);
        $res = $all_clients->filter(function ($post) {
            return Carbon::parse($post->date)->format('m') == Carbon::now()->month;
        });
        $this->this_month_clients = count($res);
        $res = $all_clients->filter(function ($post) {
            return Carbon::parse($post->date)->format('m') == Carbon::now()->subMonth()->format('m');
        });
        $this->last_month_clients = count($res);

        // dd($this->orders_list);
    }
    public function getOrdersCounts()
    {
        $this->statusCounts = StoreOrder::select('status', \DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date"), \DB::raw('COUNT(id) as status_count'))
            ->selectRaw('sum(total) as total')
            ->where('store_id', $this->store_info->id)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
        // ->whereIn('status', ['pending', 'declined', 'confirmed'])
        // \DB::raw("SUM(total) as total"),

            ->groupBy('status', 'date')
            ->orderBy('created_at', 'DESC') // Optionally order by status
            ->get();

        $this->total_incum = $this->statusCounts->sum('total');
        $this->today_incum = $this->statusCounts->where('status', 'confirmed')->where('date', $this->today)->sum('total');
        $this->yesterday_incum = $this->statusCounts->where('status', 'confirmed')->where('date', $this->yasterday)->sum('total');

        $previous_week = strtotime("-1 week +1 day");

        $start_week = strtotime("last sunday midnight", $previous_week);
        $end_week = strtotime("next saturday", $start_week);

        $start_week = date("Y-m-d", $start_week);
        $end_week = date("Y-m-d", $end_week);
        $start_week = Carbon::createFromFormat('Y-m-d', $start_week);
        $end_week = Carbon::createFromFormat('Y-m-d', $end_week);

        $d = strtotime("today");
        $start_this_week = strtotime("last sunday midnight", $d);
        $end_this_week = strtotime("next saturday", $d);
        $start = date("Y-m-d", $start_this_week);
        $end = date("Y-m-d", $end_this_week);

        $this_week_orders['all'] = 0;
        $this_week_orders['pending'] = 0;
        $this_week_orders['declined'] = 0;
        $this_week_orders['confirmed'] = 0;

        $last_week_orders['all'] = 0;
        $last_week_orders['pending'] = 0;
        $last_week_orders['declined'] = 0;
        $last_week_orders['confirmed'] = 0;

        $this->res_orders['all'] = 0;
        $this->res_orders['pending'] = 0;
        $this->res_orders['declined'] = 0;
        $this->res_orders['confirmed'] = 0;

        for ($i = 29; $i >= 0; $i--) {
            $day = Carbon::today()->subDays($i)->format('Y-m-d');
            $this->orders['all'][$day] = 0;
            $this->orders['pending'][$day] = 0;
            $this->orders['declined'][$day] = 0;
            $this->orders['confirmed'][$day] = 0;
        }

        foreach ($this->statusCounts as $key => $value) {
            $this->orders[$value->status][$value->date] = $value->status_count;

            // dd($this->orders['all'], $this->orders['all'][$value->date]);
            try {
                $this->orders['all'][$value->date] = $this->orders['all'][$value->date] + $value->status_count;
                $date = Carbon::createFromFormat('Y-m-d', $value->date);

                if ($date->gte($start_week) and $date->lte($end_week)) {
                    $last_week_orders[$value->status] = $value->status_count;
                    $last_week_orders['all'] = $last_week_orders['all'] + $value->status_count;
                } elseif ($date->gte($start) and $date->lte($end)) {
                    $this_week_orders[$value->status] = $value->status_count;
                    $this_week_orders['all'] = $this_week_orders['all'] + $value->status_count;
                }
            } catch (\Throwable $th) {
            }

        }

        foreach ($this_week_orders as $key => $value) {
            if ($last_week_orders[$key] == 0) {
                $this->res_orders[$key] = $this_week_orders[$key] * 100;
            } else {
                $this->res_orders[$key] = ((($this_week_orders[$key] - $last_week_orders[$key])) / $last_week_orders[$key]) * 100;
            }

        }

    }

    public function getTopProducts()
    {
        $this->top_products = OrderProducte::leftJoin('store_orders', 'store_orders.id', 'order_productes.store_order_id')
            ->where('store_orders.store_id', $this->store_info->id)
            ->where('is_offer', 0)
            ->whereIn('store_orders.status', ['confirmed'])

            ->select('order_productes.store_product_id', \DB::raw('COUNT(order_productes.id) as orders'), \DB::raw('SUM(order_productes.qte) as qte'), \DB::raw('SUM(order_productes.total) as total'))
            ->with(['product' => function ($q) {
                $q->with('media');

            }])
            ->groupBy('order_productes.store_product_id')
            ->orderBy('orders', 'DESC')
            ->limit(10)->get();
    }

    public function getTopOffers()
    {
        $this->top_offers = StoreOrder::where('store_orders.store_id', $this->store_info->id)
            ->whereNotNull('offers')
            ->get();

        // $this->top_offers = OrderProducte::leftJoin('store_orders', 'store_orders.id', 'order_productes.store_order_id')
        //     ->where('store_orders.store_id', $this->store_info->id)
        //     ->whereIn('store_orders.status', ['confirmed'])
        //     ->where('is_offer', 1)

        //     ->select('order_productes.offer_id', \DB::raw('COUNT(order_productes.id) as orders'), \DB::raw('SUM(order_productes.qte) as qte'), \DB::raw('SUM(order_productes.total) as total'))
        //     ->with(['product' => function ($q) {
        //         $q->with('media');

        //     }])
        //     ->groupBy('order_productes.store_product_id')
        //     ->orderBy('orders', 'DESC')
        //     ->limit(10)->get();
        // dd($this->top_offers);
    }

    public function getViews()
    {
        $this->view_week = array();
        $last7days = Carbon::today()->subDays(7)->format('Y-m-d');
        $store_view = StoreView::where('store_id', $this->store_info->id)
            ->select(\DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date"), \DB::raw('COUNT(id) as views'))
            ->whereDate('created_at', '>=', $last7days)
            ->groupBy('date')
            ->get();
        $product_view = ProductView::where('store_id', $this->store_info->id)
            ->select(\DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d') as date"), \DB::raw('COUNT(id) as views'))
            ->whereDate('created_at', '>=', $last7days)
            ->groupBy('date')
            ->get();

        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::today()->subDays($i)->format('Y-m-d');
            $this->view_week[$i]['d'] = $day;

            $this->view_week[$i]['orders'] = $this->orders['all'][$day] ?? 0;
            $this->view_week[$i]['store'] = $store_view->where('date', $day)->first()->views ?? 0;
            $this->view_week[$i]['product'] = $product_view->where('date', $day)->first()->views ?? 0;

        }
    }

}
