<?php

namespace App\Http\Livewire;

use DNS1D;
use DNS2D;
use Carbon\Carbon;
use Dompdf\Dompdf;
// use charlieuki\ReceiptPrinter\ReceiptPrinter as ReceiptPrinter;
use App\Models\Offer;
use Livewire\Component;
use App\Models\StoreOrder;
use App\Models\DeletedOrder;
use App\Models\OfferProduct;
use App\Models\StoreProduct;
use Livewire\WithPagination;
use App\Models\OrderProducte;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Intl\Currencies;
use Illuminate\Support\Facades\Storage;

class Caisse extends Component
{
    use WithPagination;
    public $currency;
    public $store_info;
    public $new_orders;
    public $update_order = false ;
    public $update_order_id = null ;
    public $order_to_delete = null ;

    public $categories;
    public $products = [] ;
    public $all_products = [];
    public $offers = [];
    public $all_offers = [];
    public $category_id;
    public $total = 0;

    public $selected_cat = 0;
    public $selected_products = [];
    public $selected_products_ids = [];
    public $selected_products_qty = [];

    protected $listeners = ['confirmPassword','RemoveProd', 'confirmed','confirmDelete','updateOrder','SelectProd','onlineOrder'];
////////////////////////////////
    public $translations;
    public $langs = [];



    public $show_pdf = false ;
    public $is_online = false ;
    public $online_order_type = null ;
    public $online_order_status = null ;
    public $online_client = null ;
    public $online_client_address = null ;
    public $online_client_time = null ;
    public $online_orders_pending = 0 ;
    
    public function mount()
    {
        session()->forget('password_confirmed_at'); // Deleting specific session variable

        $this->langs = languages()['langs'];
        $this->translations = app('translations_admin');
///////////////////////////////////
        $this->store_info = Auth::user()->store;
        $this->store_id = $this->store_info->id;

        if (isset($this->store_info->currency)) {
            $this->currency = Currencies::getSymbol($this->store_info->currency);
        } else {
            $this->currency = 'DH';
        }
        $this->getCategories();
        $this->getProducts();
        $this->getNewOrders();
    }
    public function render()
    {   
        // dd( $this->show_pdf );
        // $this->show_pdf = false ;
        return view('livewire.admin.caisse.caisse');

    }
    public function dehydrate()
    {   
        // dd( $this->show_pdf );
        $this->show_pdf = false ;

    }


    public function getCategories()
    {
        $currentLocale = app()->getLocale();
        // Cache::clear('caisse_categories');

        if (Cache::has('caisse_categories')) {
            $this->categories = Cache::get('caisse_categories');
        } else {

            $this->categories = ProductCategory::where('store_id', $this->store_id)
            ->select('*','title->' . $currentLocale.' as title_tr')
            ->orderBy('sort','asc')
            ->get()->toArray();
            
            Cache::put('caisse_categories', $this->categories, 86400);
        }

    }

    public function getProducts($id = 0)
    {
        // Cache::clear('caisse_products');

        // if (Cache::has('caisse_products')) {
        //     $this->products = Cache::get('caisse_products');

        //     if ($this->selected_cat != 0) {
        //         $this->products = $this->products->where('product_category_id', $this->selected_cat);
        //         $this->offers = [];
        //     }else{
        //         $this->offers = Cache::get('caisse_offers') ?? [];
        //     }
        // } else {

            $this->products  = StoreProduct::where('store_id', $this->store_id)
                ->select('id','title','price','product_category_id')
                ->where('to_menu', 1)
                ->orderBy('id', 'DESC')

                // ->when($id!=0,function($q) use($id){
                //     $q->where('product_category_id', $id);
                // })

                ->get();

            $this->all_products = $this->products; 
            $this->offers = $this->all_offers = Offer::where('store_id', $this->store_id)
                ->select('id','title','image','price','old_price')
                ->where('status', 1)
                ->get();

            // Cache::put('caisse_products', $this->products, 86400);
            // Cache::put('caisse_offers', $this->offers, 86400);
            // if ($this->selected_cat != 0) {
            //     $this->getProducts($this->selected_cat);
            // }
        // }
    }

    public function SelectCat($id)
    {
        $this->selected_cat = $id;
        
      
        switch ($id) {
            case 0:
                $this->products = $this->all_products;
                $this->offers = $this->all_offers ;
                break;
            case -1 :
                $this->products = [];
                $this->offers = $this->all_offers ;
                break;
            default:
                $this->products = $this->all_products->where('product_category_id', $id);
                $this->offers = [];
                break;
        }

        // $this->getProducts($this->selected_cat);
    }


    public function getNewOrders()
    {


        $lastTime = Carbon::today()->subHours(4)->format('Y-m-d H:i');


        $new_orders = StoreOrder::where('store_id', $this->store_id)
        ->select('id','total','created_at','offers','order_type','coming_date','status')
        ->where(function($q) use($lastTime){
            $q->where(function($q) use($lastTime){
                $q->where('order_type', 'caisse');
                $q->whereDate('created_at', '>=', $lastTime);
            });
            $q->orWhere(function($q) use($lastTime){
                $q->whereIn('order_type', ['coming','shipping']);
                $q->where(function($q) use($lastTime){  
                    $q->where(function($q) {
                        $q->whereIn('status',['pending','confirmed']);
                    });
                    $q->orWhere(function($q) use($lastTime){
                        $q->whereIn('status',['shipped','ready']);
                        $q->whereDate('updated_at', '>=', $lastTime);
                    });
                });
         
            });
           
        })

        ->orderBy('created_at', 'desc')
        ->get() ;
        
        $this->online_orders_pending = $new_orders->where('status','pending')->count();
        $this->new_orders = $new_orders->keyBy('id')->toArray();
        
    }



    public function SelectProd($id,$is_offer = 0)
    {
        // $products = Cache::get('caisse_products');
        $products = $this->all_products ;
        if($is_offer == 0){
            $product = $products->where('id', $id)->first();
            if (!in_array($id, $this->selected_products_ids)) {
                $this->selected_products[$id] = array(
                    'image' => get_image('tmb/'.$product->media[0]->media),
                    'price' => $product->price,
                    'type' => 'product',
                    'title' => $product->title,
                    'id' => $product->id,
                );

                $this->selected_products_ids[$id] = $id;
                $this->selected_products_qty[$id] = 1;

                $this->dispatchBrowserEvent('swip');

            } else {
                $this->selected_products_qty[$id] += 1;
            }
        }else{
            $offer = $this->offers->where('id', $id)->first();
            if (!in_array('o_'.$id, $this->selected_products_ids)) {
                $this->selected_products['o_'.$id] = array(
                    'image' => get_image('tmb/'.$offer->image),
                    'price' => $offer->price,
                    'old_price' => $offer->old_price,
                    'type'  => 'offer',
                    'title' => $offer->title,
                    'id'    => 'o_'.$offer->id,
                );

                $this->selected_products_ids['o_'.$id] = 'o_'.$id;
                $this->selected_products_qty['o_'.$id] = 1;

                $this->dispatchBrowserEvent('swip');

            } else {
                $this->selected_products_qty['o_'.$id] += 1;

            }
        }
        
        $this->calculTotal();

    }

    public function RemoveProd($id)
    {
        unset($this->selected_products[$id]);
        unset($this->selected_products_ids[$id]);
        unset($this->selected_products_qty[$id]);

        $this->calculTotal();
    }
    public function ResetAll()
    {
        $this->selected_products = [];
        $this->selected_products_ids = [];
        $this->selected_products_qty = [];

        $this->dispatchBrowserEvent('swip');
        $this->calculTotal();
    }

    public function calculTotal()
    {
        $total = 0;
        foreach ($this->selected_products as $prod) {
            $total = $total + ($prod['price'] * $this->selected_products_qty[$prod['id']]);
        }
        $this->total = $total;

        $this->dispatchBrowserEvent('SendToAds', [
            'data' =>  array(
                'data'=>$this->selected_products,
                'qty'=>$this->selected_products_qty,
                'total'=>$this->total,
                'currency'=>$this->currency
            )
        ]);


    }

    public function changeQte($id, $type)
    {
        if ($type == 'plus') {
            $this->selected_products_qty[$id] += 1;

        } else {
            if($this->selected_products_qty[$id] > 1){
                $this->selected_products_qty[$id] -= 1;

            }else{
                unset($this->selected_products[$id]);
                unset($this->selected_products_ids[$id]);
                unset($this->selected_products_qty[$id]);
            }
        }

        $this->calculTotal();

        
    }

    public function generateReceiptPDF($order_id,$text = '',$order_status = null,$client = null)
    {
        // $pdf->stream('receipt_n_' . $order_id . '_' . $date . '.pdf');
        $date = now()->format('d-m-Y H:i');
        $products = $this->getReceiptItems();
        $barcode = DNS1D::getBarcodeHTML($order_id, 'C39+');
        $qr_code = DNS2D::getBarcodeHTML(url('/to_competition'), 'QRCODE', 5, 5);

        // Ensure $date is UTF-8 encoded
        $date = utf8_encode($date);

        ///// logo
        $imagePath = public_path('assets/images/png/print_logo.png');
        $imageData = base64_encode(file_get_contents($imagePath));
        $logoBase64 = 'data:image/png;base64,' . $imageData;

        $data = [
            'items' => $products,
            'barcode' => $barcode,
            'qr_code' => $qr_code,
            'date' => $date,
            'order' => ['id' => $order_id.$text, 'total_price' => array_sum(array_column($products, 'total'))],
            'store' => ['name' => $this->store_info->title,'phone1'=> $this->store_info->phone,'phone2'=> $this->store_info->phone2],
            'client'=> $client ,
            'currency' => $this->currency,
            'logoBase64' => $logoBase64,
        ];



        if($order_status == null or $order_status == 'caisse_delivered'){
            $pdf_admin = View::make('livewire.admin.caisse.receipt_admin', $data) ;
            $pdf_client = View::make('livewire.admin.caisse.receipt_client', $data) ;   
            $full_pdf = $pdf_client.$pdf_admin ;

        }else if( $order_status == 'confirmed' ){
            $pdf_admin = View::make('livewire.admin.caisse.receipt_admin', $data) ;
            $full_pdf = $pdf_admin ;

        }else{
            $pdf_client = View::make('livewire.admin.caisse.receipt_client', $data) ;   
            $full_pdf = $pdf_client ;
        }

        $pdf = new Dompdf();


        $pdf->loadHtml($full_pdf);
        $pdf->setPaper([0, 0, 226.77, 2500], 'portrait'); // Set the paper size to match the width of an 80mm POS printer
        $pdf->render();



        $filePath = 'receipts/' . $order_id . '.pdf';
        Storage::put($filePath, $pdf->output());
    
        if($this->store_info->print_type == 'manual'){
            $this->dispatchBrowserEvent('pdfRendered', [
                'pdfData' => base64_encode($pdf->output()),
            ]);
        }else{
            $this->dispatchBrowserEvent('pdfRenderedPrint', [
                'url' => url('storage/' . $filePath),
            ]);    
        }

        

    }

    private function getReceiptItems()
    {
        $items = [];

        foreach ($this->selected_products as $key => $product) {
            $items[] = [
                'name' => $product['title'],
                'qty' => $this->selected_products_qty[$product['id']],
                'price' => $product['price'],
                'total' => $product['price'] * $this->selected_products_qty[$product['id']],
            ];
        }

        return $items;
    }

    public function ValidCheckout()
    {

        if (count($this->selected_products) > 0) {
            $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',
                'title' => $this->translations['please_confirm'],
                'message' => $this->translations['caisse_order_submit'],
            ]);
        }

    }

    public function confirmed()
    {

        if (count($this->selected_products) > 0) {


            $order = new StoreOrder();
            $order->store_id = $this->store_id;
            // $order->comment = $this->comment;
            $order->from_web = 0;
            $order->total = $this->total;
            $order->currency = $this->currency;
            $order->order_type = 'caisse';
            $order->payment_type = 'CASH';
            $order->status = 'caisse_delivered';
            $order->admin_id = Auth::id();
            $order->save();

            $products = [];
            $x = 0;
            $y = 0;
            $order_offers = array();
            $all_offers = [];
            foreach ($this->selected_products as $key => $product) {
                if ($product['type'] == 'offer') {
                    $all_offers[] = str_replace('o_','',$product['id']) ;
                }
            }
            if(count($all_offers) != 0){
                $offer_products = OfferProduct::whereIn('offer_id',$all_offers)->get();
            }

            foreach ($this->selected_products as $key => $product) {
                if ($product['type'] == 'offer') {
                    $offer_id = str_replace('o_','',$product['id']);
                    $offer_qte = $this->selected_products_qty[$product['id']];
                    $order_offers[$x]['id'] = $offer_id ;
                    $order_offers[$x]['price'] = $product['price'] * $offer_qte;
                    $order_offers[$x]['old_price'] = $product['old_price'] *  $offer_qte;
                    $order_offers[$x]['qte'] =  $offer_qte;
                    $x++;

                    ////////////////////////////////////
                    foreach ( $offer_products->where('offer_id',$offer_id) as $offer_prod) {
                        $products[$y] = array(
                            'store_product_id' => $offer_prod->store_product_id,
                            'store_order_id' => $order->id,
                            'qte' => $offer_prod->qty *  $offer_qte,
                            'price' => $offer_prod->product->price *  $offer_qte,
                            'total' => $offer_prod->product->price * $offer_prod->qty *  $offer_qte,
                            'offer_id' => $offer_id,
                            'is_offer' => 1,
                            "created_at" => now(),
                            "updated_at" => now(),
                        );
                        $y++;
                    }
                } else {
                    $products[$y] = array(
                        'store_product_id' => $product['id'],
                        'store_order_id' => $order->id,
                        'qte' => $this->selected_products_qty[$product['id']],
                        'price' => $product['price'],
                        'total' => $product['price'] * $this->selected_products_qty[$product['id']],
                        'offer_id' => null,
                        'is_offer' => 0,
                        "created_at" => now(),
                        "updated_at" => now(),
                    );
                }

                $y++;
            };
            if (count($order_offers) > 0) {
                $offers = json_encode($order_offers);
                $order->offers = $offers;
                $order->save();
            }else{
                $offers = null;
            }

            $this->new_orders[ $order->id] = array(
                "id" => $order->id ,
                "created_at" => $order->created_at ,
                "total" => $order->total ,
                "offers" =>  $offers ,
                "order_type" =>  'caisse' ,
                "coming_date" =>  $order->coming_date ,
                "status" =>   $order->status ,
            );

            OrderProducte::insert($products);


            $this->show_pdf = true ;

            $this->generateReceiptPDF($order->id);

        }

        $this->ResetAll();
        $this->dispatchBrowserEvent('SendToAdsfinish');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => $this->translations['caisse_order_success'],
        ]);

        // $this->generateReceiptPDF();

    }

    public function onlineOrder($data)
    {
        $this->new_orders[$data['id']] = array(
            "id" => $data['id'] ,
            "created_at" => $data['created_at']  ,
            "total" => $data['total'] ,
            "offers" =>  $data['offers'] ,
            "order_type" =>  $data['order_type'] ,
            "coming_date" =>  $data['coming_date'] ,
            "status" =>   $data['status'] ,
        );
        $this->online_orders_pending = $this->online_orders_pending + 1 ;

    }

    /////////////////////////////////////////////////////////


    public function editOrder($id,$is_offer = 0,$order_type)
    {

        // $this->products = Cache::get('caisse_products');
        // $this->offers = Cache::get('caisse_offers');
        $this->ResetAll();

        if($order_type != 'caisse'){
            $this->online_order_type = $order_type; 
            $order = StoreOrder::find($id);
            $this->is_online = true ;  
            $this->online_client = $order->client ;
            $this->online_order_status = $order->status ;
            
            if($order_type == 'shipping'){
                $this->online_client_address = $order->client_address   ;
            }else{
                $this->online_client_time = $order->coming_date   ;
            }

        }else{
            $this->is_online = false ;  
            $this->online_client = null ;   
        }

        $this->update_order = true ;    
        $this->update_order_id = $id ;  
        

       
        $products = OrderProducte::where('store_order_id',$id)->where('is_offer',0)->get();

        foreach ($products as $product ) {
            $this->SelectProd($product->store_product_id);
            $this->selected_products_qty[$product->store_product_id] = $product->qte;
        }

        if($is_offer == 1 ){
            $order = storeOrder::where('id',$id)->select('offers')->first();
           
            $offers = json_decode($order->offers,true);

            foreach ($offers as $offer ) {
                $this->SelectProd($offer['id'],1);
                $this->selected_products_qty['o_'.$offer['id']] = $offer['qte'] ?? 1;
            }
            
        }

        $this->calculTotal();


    }



    public function updateOrder($data)
    {
        if (count($this->selected_products) > 0) {

            $order =  StoreOrder::find($this->update_order_id );

            if($order->order_type != 'caisse'){

                if($order->status == 'pending'){
                    $this->online_orders_pending =  $this->online_orders_pending - 1;
                    $order->admin_id = Auth::id();
                }else if($order->total != $this->total){
                    $order->updated_by = $data['name'] ;
                    $order->updated_by_id = $data['id'] ;
                }
                if($order->status == 'pending'){
                    $order->status = 'confirmed';

                }else if( $order->status == 'confirmed'  ){
                    if($order->order_type == 'shipping'){
                        $order->status = 'shipped';
                    }else{
                        $order->status = 'ready';
                    }
                }


            } else{

                $order->updated_by = $data['name'] ;
                $order->updated_by_id = $data['id'] ;
            }

            $order->total = $this->total;

            $order->save();

            $products = [];
            $x = 0;
            $y = 0;
            $order_offers = array();
            $all_offers = [];
            foreach ($this->selected_products as $key => $product) {
                if ($product['type'] == 'offer') {
                    $all_offers[] = str_replace('o_','',$product['id']) ;
                }
            }
            if(count($all_offers) != 0){
                $offer_products = OfferProduct::whereIn('offer_id',$all_offers)->get();
            }

            
            foreach ($this->selected_products as $key => $product) {
                if ($product['type'] == 'offer') {
                    $offer_id = str_replace('o_','',$product['id']);
                    $offer_qte = $this->selected_products_qty[$product['id']];
                    $order_offers[$x]['id'] = $offer_id ;
                    $order_offers[$x]['price'] = $product['price'] * $offer_qte;
                    $order_offers[$x]['old_price'] = $product['old_price'] *  $offer_qte;
                    $order_offers[$x]['qte'] =  $offer_qte;
                    $x++;

                    ////////////////////////////////////
                    foreach ( $offer_products->where('offer_id',$offer_id) as $offer_prod) {
                        $products[$y] = array(
                            'store_product_id' => $offer_prod->store_product_id,
                            'store_order_id' => $order->id,
                            'qte' => $offer_prod->qty *  $offer_qte,
                            'price' => $offer_prod->product->price *  $offer_qte,
                            'total' => $offer_prod->product->price * $offer_prod->qty *  $offer_qte,
                            'offer_id' => $offer_id,
                            'is_offer' => 1,
                            "created_at" => now(),
                            "updated_at" => now(),
                        );
                        $y++;
                    }
                } else {
                    $products[$y] = array(
                        'store_product_id' => $product['id'],
                        'store_order_id' => $order->id,
                        'qte' => $this->selected_products_qty[$product['id']],
                        'price' => $product['price'],
                        'total' => $product['price'] * $this->selected_products_qty[$product['id']],
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
            
            OrderProducte::where('store_order_id',$this->update_order_id)->delete();

            OrderProducte::insert($products);

            $this->new_orders[ $order->id] = array(
                "id" => $order->id ,
                "created_at" => $order->created_at ,
                "total" => $order->total ,
                "offers" =>  $order->offers ,
                "order_type" =>  $order->order_type ,
                "coming_date" =>  $order->coming_date ,
                "status" =>   $order->status ,
            );


            if($order->order_type != 'caisse'){
                $client = array(
                    'type'=>$order->order_type,
                    'client' =>$order->client ,
                    'address' => $order->client_address->address ?? '' ,
                    'city' => $order->client_address?->city->city  ?? '',
                    'quartier' => $order->client_address?->quartier->quartier ?? '',
                    'date'=>$order->coming_date,
                );

            }else{
                $client = null ;
            }


            $this->generateReceiptPDF($order->id,' - Updated',$order->status,$client);

        }

        $this->cancelUpdate();
        $this->dispatchBrowserEvent('close_modal');
        $this->dispatchBrowserEvent('SendToAdsfinish');

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => $this->translations['caisse_order_success'],
        ]);


    }




    public function cancelUpdate()
    {
        $this->update_order = false ;    
        $this->update_order_id = null ;   
        
        $this->is_online = false ;  
        $this->online_client = null ;  
        $this->online_client_address = null ; 
        $this->online_order_type = null ; 
        $this->online_client_time = null ; 
        $this->online_order_status = null ; 


        $this->ResetAll();

    }

    public function deleteOrder($id)
    {
        $this->order_to_delete = $id ; 
        
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => $this->translations['please_confirm'],
            'message' => "Do you want to delete The order ID : ".$id,
            'function' => 'confirmPassword',
            'id' => 'confirmDelete',
        ]);
        $this->cancelUpdate();

    }

    public function confirmDelete($data)
    {
        $order = StoreOrder::find($this->order_to_delete);
        $o_products = OrderProducte::where('store_order_id',$this->order_to_delete);
        // ->delete()

        $arr_order = $order->toArray();
        unset( $arr_order['id'] );
        unset( $arr_order['updated_by'] );
        unset( $arr_order['updated_by_id'] );

        $arr_order['order_products'] = json_encode($o_products->get()->toArray())  ;
        $arr_order['deleted_by'] = $data['name']  ;
        $arr_order['deleted_by_id'] = $data['id']  ;
        $arr_order['created_at'] = Carbon::parse($arr_order['created_at']) ;
        $arr_order['updated_at'] = Carbon::now()  ;
        DeletedOrder::insert($arr_order);

        $order->delete();
        $o_products->delete();
        unset($this->new_orders[$this->order_to_delete]);

        $this->order_to_delete = null ; 

        $this->dispatchBrowserEvent('close_modal');


        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Order Deleted By '.$data['name'] .'!',
        ]);


    }


    public function confirmPassword($function)
    {

        $this->dispatchBrowserEvent('confirmPassword', [
            'function' => $function,
        ]);

    }


}
