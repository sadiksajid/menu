<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class ShippingCompaniesDataTable extends Controller
{
    public function ShippingCompaniesList(Request $request)
    {
     

        if ($request->ajax()) {
            $company = ShippingCompany::where('id','>=',1);
            

             $tb = Datatables::of($company)
      
             ->editColumn('id', function ($item) {
                return  $item->id ;             
             })

             ->editColumn('logo', function ($item) {
                return '<img width="100px" src="'.get_image($item->logo).'" alt="">';
            })
            ->editColumn('name', function ($item)  {
                return $item->name;
            })
            ->editColumn('tag', function ($item)  {
                return $item->tag;
            })

 
            ->editColumn('url', function ($item) {
                return '  
                <a href="'.$item->site.'" target="_blank">
                    <button type="button" class="btn btn-dark btn-sm">
                        <i class="fa fa-external-link"></i>
                    </button>
                </a>
                ';
            })
            ->editColumn('date', function ($item) {
                return $item->created_at->format('d/m/Y');
            })
            ->editColumn('actions', function ($item) {
                return '  
                <a href="/staf/shipping_companies/edit/'.$item->id.'" target="_blank">
                <button type="button" class="btn btn-orange btn-sm">
                    <i class="fa fa-pencil-square-o"></i>
                </button>
                </a>
                ';
            })
    
            ->rawColumns(['id', 'logo', 'name', 'tag','url','date','actions'])
            ->only(['id', 'logo', 'name', 'tag','url','date','actions'])
            ->make(true);
            return $tb ; 
        } else return abort(404);
    }




    public function OrdersListAssign(Request $request)
    {

        if ($request->filter_dates && $request->filter_dates['startDate'] && $request->filter_dates['endDate']) {
            $startDate = Carbon::parse(date("Y/m/d", strtotime($request->filter_dates['startDate'])))->startOfDay();
            $endDate = Carbon::parse(date("Y/m/d", strtotime($request->filter_dates['endDate'])))->endOfDay();
        } else {
            $currentTime = time();
            $currentHourMinute = date('H:i', $currentTime);
    
            if(env('APP_ENV') == 'local'){
                if ($currentHourMinute <= '16:00') {
                    // sadik testing change ->subDays(150) to ->subDays(1)
                    $startDate = Carbon::now()->subDays(300)->format('Y-m-d 16:01:00'); 
                } else {
                    // sadik testing remove ->subDays(150)
                    $startDate = Carbon::now()->subDays(300)->format('Y-m-d 16:01:00'); 
                }
            } else {
                if ($currentHourMinute <= '16:00') {
                    $startDate = Carbon::now()->subDays(1)->format('Y-m-d 16:01:00'); 
                } else {
                    $startDate = Carbon::now()->format('Y-m-d 16:01:00'); 
                }
            }  

             $endDate = Carbon::now()->format('Y-m-d H:i:s') ;

        }

        $warehouses_name = null ; 
        if (isset($request->filter_warehouses)) {
            $warehouses_name = $request->filter_warehouses ;
        }else{

            $user = Auth::user();

            if($user->user_type == 'warehouse'){
                $warehouses_name = $user->warehouses->pluck('warehouse_code')[0];
            }
        }


        if ($request->ajax()) {
            $leads = Orders::leftJoin('order_details','order_details.order_id','orders.id')
            ->leftJoin('products','order_details.product_id','products.id')
            ->where('order_status', 'Confirmed')
                ->where('shipment_status', 'Pending')
                ->where(function ($q) use ($startDate, $endDate) {
                        $q->where(DB::raw('DATE_FORMAT(order_status_date, "%Y-%m-%d %H:%i:%s")'), '>=', $startDate);
                        $q->where(DB::raw('DATE_FORMAT(order_status_date, "%Y-%m-%d %H:%i:%s")'), '<=', $endDate);
                    
                })


                ->where(function ($q) use ($warehouses_name) {
                    if (isset($warehouses_name)) {
                        $q->where('warehouse_code', $warehouses_name);
                    }
                })
                ->where(function ($q) use ($request) {
                    if (isset($request->filter_cities)) {
                        $q->whereIn('orders.customer_city', $request->filter_cities);
                    }
                })
      
                ->select('orders.id','orders.weight','orders.shipment_status','orders.customer_city','orders.order_status_date','order_details.product_id','order_details.sku_code','order_details.quantity','products.name' )
                ->groupBy('orders.id')
                ;
            

            if(Auth::user()->can('warehouse_orders_assign_edit')){
                $editing = True ; 
            }else{
                $editing = False ; 
            }

             $tb = Datatables::of($leads)
             ->editColumn('action', function ($item) use($editing) {
                if($editing){
                    return "<button class='btn btn-primary' wire:click='EditOrder(".$item->id.")'>Pending</i></button>";             
                }else{
                    return '';
                }
             })
             ->editColumn('checkbox', function ($item) {
                return '<label class="ckbox"><input class="checkChild"  value="' . $item->id . '" type="checkbox" form="actionForm" name="checked[]" autocomplete="off" ><span></span></label>';             
             })

             ->editColumn('id', function ($item) use ($request) {
                return '<a class="font-weight-semibold m-0 text-uppercase" href="#">' . ($item->id) . '</a>';
            })


            ->editColumn('sku_code', function ($item) use ($request) {
                return '<a class="font-weight-semibold m-0 text-uppercase" href="#">' . ($item->sku_code) . '</a>';
            })

            ->editColumn('order_status_date', function ($item) {
                return $item->order_status_date;
            })

            ->editColumn('name', function ($item) {
                return $item->name;
            })
            ->editColumn('customer_city', function ($item) {
                return $item->customer_city;
            })
            ->editColumn('quantity', function ($item) {
                return $item->quantity;
            })
            ->editColumn('weight', function ($item) use ($request) {
                return '<a class="font-weight-semibold m-0 text-uppercase" href="#">' . ($item->weight) . ' Kg </a>';
            })

    
            ->rawColumns(['sku_code', 'name', 'order_status_date', 'checkbox','quantity','id','customer_city','action','weight'])
            ->only(['sku_code', 'name', 'order_status_date', 'total_sku','checkbox','quantity','id','customer_city','action','weight'])
            ->make(true);
            return $tb ; 
        } else return abort(404);
    }





    public function OrdersListToShip(Request $request)
    {

        if ($request->filter_dates && $request->filter_dates['startDate'] && $request->filter_dates['endDate']) {
            $startDate = Carbon::parse(date("Y/m/d", strtotime($request->filter_dates['startDate'])))->startOfDay();
            $endDate = Carbon::parse(date("Y/m/d", strtotime($request->filter_dates['endDate'])))->endOfDay();
        } else {
            $startDate = null;
            $endDate = null;
        }

        $warehouses_name = null ; 
        if (isset($request->filter_warehouses)) {
            $warehouses_name = $request->filter_warehouses ;
        }else{

            $user = Auth::user();

            if($user->user_type == 'warehouse'){
                $warehouses_name = $user->warehouses->pluck('warehouse_code')[0];
            }
        }


        if ($request->ajax()) {

            $leads =  Orders::where('order_status', 'Confirmed')
            ->where('shipment_status', 'Fulfilled')
            // ->whereIn('shipper_id',$this->shippers_list->pluck('id'))
            ->where(function ($q) use ($warehouses_name) {
                if (isset($warehouses_name)) {
                    $q->where('warehouse_code', $warehouses_name);
                }
            })
            // ->select('shipper_id',DB::raw('count(*) as orders'))->groupBy('shipper_id')->get()->pluck('orders','shipper_id')->toArray();
            ->select('shipper_id',DB::raw('count(*) as orders'))->count();
            
            $leads = Orders::where('order_status', 'Confirmed')
                ->where('shipment_status', 'Fulfilled')
                ->when($startDate != null  and $endDate != null , function ($q) use ($startDate, $endDate) {
                    if( $startDate != null  and $endDate != null)
                        $q->where(DB::raw('DATE_FORMAT(shipment_status_date, "%Y-%m-%d %H:%i:%s")'), '>=', $startDate);
                        $q->where(DB::raw('DATE_FORMAT(shipment_status_date, "%Y-%m-%d %H:%i:%s")'), '<=', $endDate);
                })
                 ->where(function ($q) use ($warehouses_name) {
                    if (isset($warehouses_name)) {
                        $q->where('warehouse_code', $warehouses_name);
                    }
                })
               
     
                ->select('orders.id','orders.shipment_status','orders.customer_city','orders.shipment_status_date')
                ->with(['order_details'=>function($q){
                    $q->with('product');
                }])
                ->groupBy('orders.id')
                ;
            

             $tb = Datatables::of($leads)
             ->editColumn('checkbox', function ($item) {
                return '<label class="ckbox"><input class="checkChild"  value="' . $item->id . '" type="checkbox" form="actionForm" name="checked[]" autocomplete="off" ><span></span></label>';             
             })

             ->editColumn('id', function ($item) use ($request) {
                return '<a class="font-weight-semibold m-0 text-uppercase" href="#">' . ($item->id) . '</a>';
            })


            ->editColumn('sku_code', function ($item) use ($request) {
                $sku = '';
                $x = 0 ; 
                foreach($item->order_details as $detail ){
                    if( $x > 0){
                        $sku .= '</br>';
                    }
                    $sku .= '<a class="font-weight-semibold m-0 text-uppercase" href="#">' . ($detail->sku_code) .' : '.($detail->quantity). '</a>';
                    $x++;
                }
               
                return $sku;
            })

            ->editColumn('shipment_status_date', function ($item) {
                return $item->shipment_status_date;
            })

            ->editColumn('name', function ($item) {
                $name = '';
                $x = 0 ; 
                foreach($item->order_details as $detail ){
                    if( $x > 0){
                        $name .= '</br>';
                    }
                    $name .= '- '.$detail->product->name ?? $detail->sku_code;
                    $x++;
                }
               
                return $name;
            })
            ->editColumn('customer_city', function ($item) {
                return $item->customer_city;
            })
            ->editColumn('quantity', function ($item) {
                return $item->order_details->sum('quantity');
            })
            ->editColumn('action', function ($item) {
                $output = "<div class='button-list d-flex'><a href='#' class='btn btn-rollback' data-id='".$item->id."'><i class='fas fa-backspace'></i></a> ";
        
                $output .= '</div>';
            
                return $output;
            })

    
            ->rawColumns(['sku_code', 'name', 'shipment_status_date', 'checkbox','quantity','id','customer_city','action'])
            ->only(['sku_code', 'name', 'shipment_status_date', 'total_sku','checkbox','quantity','id','customer_city','action'])
            ->make(true);
            return $tb ; 
        } else return abort(404);
    }





    public function OrdersReturn(Request $request)
    {
        if ($request->filter_dates && $request->filter_dates['startDate'] && $request->filter_dates['endDate']) {
            $startDate = Carbon::parse(date("Y/m/d", strtotime($request->filter_dates['startDate'])))->startOfDay();
            $endDate = Carbon::parse(date("Y/m/d", strtotime($request->filter_dates['endDate'])))->endOfDay();
        } else {
            $currentTime = time();
            $currentHourMinute = date('H:i', $currentTime);
    
            if(env('APP_ENV') == 'local'){
                if ($currentHourMinute <= '16:00') {
                    // sadik testing change ->subDays(150) to ->subDays(1)
                    $startDate = Carbon::now()->subDays(700)->format('Y-m-d 16:01:00'); 
                } else {
                    // sadik testing remove ->subDays(150)
                    $startDate = Carbon::now()->subDays(700)->format('Y-m-d 16:01:00'); 
                }
            } else {
                if ($currentHourMinute <= '16:00') {
                    $startDate = Carbon::now()->subDays(1)->format('Y-m-d 16:01:00'); 
                } else {
                    $startDate = Carbon::now()->format('Y-m-d 16:01:00'); 
                }
            }  

    
             $endDate = Carbon::now()->format('Y-m-d H:i:s') ;

        }

        $warehouses_name = null ; 
        if (isset($request->filter_warehouses)) {
            $warehouses_name = $request->filter_warehouses ;
        }else{

            $user = Auth::user();

            if($user->user_type == 'warehouse'){
                $warehouses_name = $user->warehouses->pluck('warehouse_code')[0];
            }
        }

        if ($request->ajax()) {
            $leads = Orders::
                join('shipment_statuses_histories',function($q)  use ($startDate, $endDate) {
                    $q->on('shipment_statuses_histories.order_id', 'orders.id');
                    $q->where('shipment_statuses_histories.shipment_status', 'Returned');
                    $q->where(DB::raw('DATE_FORMAT(shipment_statuses_histories.date, "%Y-%m-%d %H:%i:%s")'), '>=', $startDate);
                    $q->where(DB::raw('DATE_FORMAT(shipment_statuses_histories.date, "%Y-%m-%d %H:%i:%s")'), '<=', $endDate);

                })
                ->whereNull('orders.shipment_substatus')
                ->where('order_status', 'Confirmed')
                ->where('orders.shipment_status', 'Returned')
                ->where(function ($q) use ($warehouses_name) {
                    if (isset($warehouses_name)) {
                        $q->where('warehouse_code', $warehouses_name);
                    }
                })
                ->where(function ($q) use ($request) {
                    if (isset($request->filter_cities)) {
                        $q->whereIn('orders.customer_city', $request->filter_cities);
                    }
                })
                ->where(function ($q) use ($request) {
                    if (isset($request->filter_shippers)) {
                        $q->whereIn('orders.shipper_name', $request->filter_shippers);
                    }
                })
                ->with(['order_details'=>function($q){
                    $q->with('product');
                }])
                ->select('orders.id','orders.shipper_name','orders.shipment_status','orders.customer_city','orders.shipment_status_date','orders.tracking_number','shipment_statuses_histories.date')
                ->groupBy('orders.id')
                ;
            
             $tb = Datatables::of($leads)
      
             ->editColumn('checkbox', function ($item) {
                return '<label class="ckbox"><input class="checkChild"  value="' . $item->id . '" type="checkbox" form="actionForm" name="checked[]" autocomplete="off" ><span></span></label>';             
             })

             ->editColumn('id', function ($item) {
                return '<a class="font-weight-semibold m-0 text-uppercase" href="#">' . ($item->id) . '</a>';
            })
            ->editColumn('tracking_number', function ($item)  {
                return '<span class="badge badge-primary">'.$item->tracking_number.'</span>';
            })

            ->editColumn('sku_code', function ($item){
                $x = 0 ;
                $output = '';
                foreach($item->order_details as $detail ){
                    if($x > 0){
                        $output .= '<br>';
                    }
                    $output .= '- <a class="font-weight-semibold m-0 text-uppercase" href="#">' . ($detail->sku_code) .' : '.$detail->quantity. '</a>' ; 
                    $x++ ; 
                }
               
                return $output ;
            })


            ->editColumn('name', function ($item) {
                $x = 0 ;
                $output = '';
                foreach($item->order_details as $detail ){
                    if($x > 0){
                        $output .= '<br>';
                    }
                    $name = $detail->product->name ?? $detail->sku_code ;
                    $output .= '- ' . ((strlen($name) > 40) ? Str::substr($name, 0, 37). '...' :$name) ; 
                    $x++ ; 
                }
               
                return $output ;
            })

            ->editColumn('shipment_status', function ($item) {
                if($item->shipment_status == 'Returned'){
                    return '<span class="badge badge-warning">'.$item->shipment_status.'</span>';

                }else{
                    return '<span class="badge badge-danger">'.$item->shipment_status.'</span>';

                }

                return $item->customer_city;
            })
            ->editColumn('date', function ($item) {
                return $item->date;
            })

            ->editColumn('customer_city', function ($item) {
                return $item->customer_city;
            })
            ->editColumn('quantity', function ($item) {
                return $item->order_details->sum('quantity');
            })
            ->editColumn('shipper_name', function ($item) {
                return $item->shipper_name;
            })
    
            ->rawColumns(['sku_code', 'name', 'checkbox','quantity','id','customer_city','shipper_name','tracking_number','shipment_status','date'])
            ->only(['sku_code', 'name', 'total_sku','checkbox','quantity','id','customer_city','shipper_name','tracking_number','shipment_status','date'])
            ->make(true);
            return $tb ; 
        } else return abort(404);
    }


    public function OrdersReturnHistory(Request $request)
    {
        if ($request->filter_dates && $request->filter_dates['startDate'] && $request->filter_dates['endDate']) {
            $startDate = Carbon::parse(date("Y/m/d", strtotime($request->filter_dates['startDate'])))->startOfDay();
            $endDate = Carbon::parse(date("Y/m/d", strtotime($request->filter_dates['endDate'])))->endOfDay();
        } else {
            $currentTime = time();
            $currentHourMinute = date('H:i', $currentTime);
    
            if(env('APP_ENV') == 'local'){
                if ($currentHourMinute <= '16:00') {
                    // sadik testing change ->subDays(150) to ->subDays(1)
                    $startDate = Carbon::now()->subDays(700)->format('Y-m-d 16:01:00'); 
                } else {
                    // sadik testing remove ->subDays(150)
                    $startDate = Carbon::now()->subDays(700)->format('Y-m-d 16:01:00'); 
                }
            } else {
                if ($currentHourMinute <= '16:00') {
                    $startDate = Carbon::now()->subDays(1)->format('Y-m-d 16:01:00'); 
                } else {
                    $startDate = Carbon::now()->format('Y-m-d 16:01:00'); 
                }
            }  

    
             $endDate = Carbon::now()->format('Y-m-d H:i:s') ;

        }

        $warehouses_name = null ; 
        if (isset($request->filter_warehouses)) {
            $warehouses_name = $request->filter_warehouses ;
        }else{

            $user = Auth::user();

            if($user->user_type == 'warehouse'){
                $warehouses_name = $user->warehouses->pluck('warehouse_code')[0];
            }
        }

        if ($request->ajax()) {
            $return = OrderRestockHistory::
                leftJoin('warehouse_skus_places', function ($q) {
                    $q->on('warehouse_skus_places.sku_code', 'order_restock_histories.quantity_sku');
                    $q->on('warehouse_skus_places.warehouse_code', 'order_restock_histories.warehouse_code');
                })
                ->leftJoin('warehouse_places', 'warehouse_places.id', 'warehouse_skus_places.warehouse_place_id')
                ->leftJoin('warehouses', 'warehouses.code', 'order_restock_histories.warehouse_code')

                ->when($startDate != null  and $endDate != null , function ($q) use ($startDate, $endDate) {
                    if( $startDate != null  and $endDate != null)
                        $q->where(DB::raw('DATE_FORMAT(order_restock_histories.created_at, "%Y-%m-%d %H:%i:%s")'), '>=', $startDate);
                        $q->where(DB::raw('DATE_FORMAT(order_restock_histories.created_at, "%Y-%m-%d %H:%i:%s")'), '<=', $endDate);
                })
                ->where(function ($q) use ($warehouses_name) {
                    if (isset($warehouses_name)) {
                        $q->where('order_restock_histories.warehouse_code', $warehouses_name);
                    }
                })
                ->with(['product'=>function($q){
                    $q->select('id','name');
                }])
                ->select('order_restock_histories.*','warehouse_places.place_name','warehouses.name as warehouse_name')
                ->orderBy('created_at','DESC')
                ;
            

             $tb = Datatables::of($return)

             
            ->editColumn('id', function ($item) {
                return '<a class="font-weight-semibold m-0 text-uppercase" href="#">' . ($item->id) . '</a>';
            })
            ->editColumn('quantity_sku', function ($item)  {
                return '<span class="badge badge-warning">'.$item->quantity_sku.'</span>';
            })
            ->editColumn('warehouse_name', function ($item)  {
                return '<span class="badge badge-primary">'.$item->warehouse_name.'</span>';
            })
 
            ->editColumn('order_ids', function ($item){
                $x = 1 ;
                $output = '';
                foreach(json_decode($item->quantity_orders, true) as $order ){
                    if($x % 3 == 0){
                        $output .= '<br>';
                    }
                    $output .= '<span class="badge badge-info ml-1">'.$order.'</span>' ; 
                    $x++ ; 
                }
               
                return $output ;
            })
            ->editColumn('total_qty', function ($item){
                return '<span class="badge badge-primary">'.($item->quantity_restocked + $item->quantity_damaged + $item->quantity_lost).'</span>';

            })
            ->editColumn('quantity_restocked', function ($item)  {
                return '<span class="badge badge-primary">'.$item->quantity_restocked.'</span>';
            })
            ->editColumn('quantity_damaged', function ($item)  {
                return '<span class="badge badge-primary">'.$item->quantity_damaged.'</span>';
            })

            ->editColumn('quantity_lost', function ($item)  {
                return '<span class="badge badge-primary">'.$item->quantity_lost.'</span>';
            })

            ->editColumn('place_name', function ($item)  {
                return '<span class="badge badge-primary">'.$item->place_name.'</span>';
            })


            ->editColumn('created_at', function ($item) {
                return $item->created_at->format('Y-m-d H:i');;
            })

         
            ->rawColumns(['id', 'quantity_sku', 'warehouse_name','order_ids','total_qty','quantity_restocked','quantity_damaged','quantity_lost','place_name','created_at'])
            ->only(['id', 'quantity_sku', 'warehouse_name','order_ids','total_qty','quantity_restocked','quantity_damaged','quantity_lost','place_name','created_at'])
            ->make(true);
            return $tb ; 
        } else return abort(404);
    }






}