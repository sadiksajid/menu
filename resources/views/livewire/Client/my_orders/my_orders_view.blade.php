@section('css')
<style>
    .order_div {
        border: 2px solid {
                {
                $store_info->background_color
            }
        }

        ;
        padding: 15px;
        border-radius: 30px;
        /* background-color: rgb(158 186 255 / 50%); */
    }

    .order_imgs {
        border: 1px solid black;
        height: 50px !important;
        width: 50px !important;
    }

    .order {
        padding-left: 70px !important;
        padding: 16px;
        min-height: 60px;
    }

    .card {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }

    .card_p1 {
        border-bottom: 2px solid black;
        height: 50px;
    }
    .card_p2 {
        background-color: #fffbe9;
        border-radius: 10px;

    }
</style>
@endsection
<div>
    @php
    $orders = Cache::get('orders-' . $client->id);
    @endphp
    <div wire:ignore class="hero_single inner_pages background-image" style="height:260px"        
     @if (isset($images_orders))   data-background="url({{get_image($images_orders)}})" @else data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif >


        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1> {{ $titles_orders ?? $translations['my_orders']}} </h1>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="frame white"></div>
    </div>

    <section class="cart-section mt-3" style="padding-top:10px">
        <div class="container">
            <div class="row">

                <div class="col-12">
                    <table class="table cart-table table-responsive-xs">

                        <div class="container">
                            <div class="row">

                                @foreach ($orders as $order)

                                @php
                                if($order->offers != null){
                                    $arr = json_decode($order->offers, true);
                                    $offers =[];
                                    foreach ($arr as  $value) {
                                        $offers[$value['id']] = $value ;
                                    }
                                }
                                    
                                @endphp
                                <div class="  col-md-6 col-12 ">
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <div class="row ">
                                                <div class="col-md-12 col-12 card_p1">
        
                                                    <center>
                                                        <h5 style=";margin:0px" class="mb-1 mt-1">
                                                            <span
                                                                class="badge badge-dark"> {{$translations['order']}} : REF-0{{ $order->id }}
                                                            </span>
                                                            <span
                                                                    class="badge badge-dark ">{{ $order->created_at->format('d-m-Y h:m') }}
                                                            </span>
                                                        
                                                        </h5>
                                                        
                                                    </center>
        
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="container ">
                                                        <div class="row  menu-gallery mt-3 mb-3">
                                                            @foreach ( $order->products->where('is_offer',1)->groupBy('offer_id')  as $key => $offer)
                                                               <div class="p-2 mb-2 " style="border:2px solid #ffc107 ; border-radius:10px ;    padding-top: 20px !important;">
                                                                <span class="badge badge-warning  " style="color: black;position: absolute;margin-top: -30px;">
                                                                    {{$translations['offer']}} : {{ $offers[$key]['price'] }} {{ $currency }} /  <del>{{ $offers[$key]['old_price'] }} {{ $currency }} </del>
                                                                </span>
                                                                @foreach ($offer as $o_prod)
                                                                    @php
                                                                        $prod = $o_prod->product ;
                                                                    @endphp

                                                                    <div class="col-12">
                                                                        <div class="menu_item order mb-0">
                                                                            <figure class="order_imgs">
                                                                                <a href="{{ get_image('moyen/'.$prod['media'][0]['media'])}}"  data-effect="mfp-zoom-in">
                
                                                                                    <img src="{{ URL::asset('index1/img/menu_items/menu_items_placeholder.png') }}"
                                                                                        data-src="{{ get_image('moyen/'.$prod)}}"
                                                                                        class="lazy" alt="">
                                                                                </a>
                                                                            </figure>
                                                                            <div class="menu_title">
                                                                                <h3>{{$prod['title']}}</h3><em>{{ $prod['price']}}
                                                                                    {{ $currency }} x {{ $o_prod->qte }}</em>
                                                                            </div>
                
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                               </div>
                                                            @endforeach
                                                            @foreach ( $order->products->where('is_offer',0) as $o_prod)
                                                            @php
                                                            $prod = $o_prod->product ;
                                                            @endphp
                                                            <div class="col-12">
                                                                <div class="menu_item order mb-0">
                                                                    <figure class="order_imgs">
                                                                        <a href="{{ get_image('moyen/'.$prod['media'][0]['media'])}}"
                                                                            title="Summer Berry" data-effect="mfp-zoom-in">
        
                                                                            <img src="{{ URL::asset('index1/img/menu_items/menu_items_placeholder.png') }}"
                                                                                data-src="{{ get_image('moyen/'.$prod['media'][0]['media'])}}"
                                                                                class="lazy" alt="">
                                                                        </a>
                                                                    </figure>
                                                                    <div class="menu_title">
                                                                        <h3>{{$prod['title']}}</h3><em>{{ $prod['price']}}
                                                                            {{ $currency }} x {{ $o_prod->qte }}</em>
                                                                    </div>
        
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12 card_p2">
        
                                                    <h5 style="" class="mb-2 mt-2">
                                                        <div class="container">
                                                            <div class="row">
                                                                <span class="badge badge-dark col-5">
                                                                    {{ $order->store->title }}
                                                                </span>
                                                                
                                                            </div>
                                                        </div>
                                                    </h5>
        
                                                    <h5 style=";margin:0px" class="mb-2"><span class="badge badge-primary">{{$translations['type']}}
                                                            :
                                                            {{ $order->order_type }}</span></h5>
        
                                                    <h5 style=";margin:0px" class="mb-2">
                                                        @if($order->status == 'pending')
                                                        <span class="badge badge-dark">{{$translations['status']}} :
                                                            {{ $order->status }}
                                                        </span>
                                                        @elseif($order->status == 'confirmed')
                                                        <span class="badge badge-primary">{{$translations['status']}}  :
                                                            {{ $order->status }}
                                                        </span>
                                                        @elseif($order->status == 'shipped')
                                                        <span class="badge badge-info">{{$translations['status']}}  :
                                                            {{ $order->status }}
                                                        </span>
                                                        @elseif($order->status == 'declined' or $order->status == 'canceled')
                                                        <span class="badge badge-danger">{{$translations['status']}}  :
                                                            {{ $order->status }}
                                                        </span>
                                                        @elseif($order->status == 'ready' or $order->status == 'delivered')
                                                        <span class="badge badge-success">{{$translations['status']}}  :
                                                            {{ $order->status }}
                                                        </span>
                                                        @endif
                                                    </h5>
        
                                                    <h4 style=" margin: 0px" class="mb-2"><span class="badge badge-warning "
                                                            style="color: rgba(0, 0, 0, 0.591) ; width:100%"><strong>{{$translations['total']}}  :
                                                                {{ $order->total }}
                                                                {{ $order->currency }}</strong></span></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                @endforeach
                            </div>

                        </div>
                    </table>

                </div>
                <div class="col-12 mt-2">

                    @if ($orders->hasPages())
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            @if ($orders->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">{{$translations['previous']}}</a>
                            </li>
                            @else
                            <li class="page-item"><a class="page-link" href="{{ $orders->previousPageUrl() }}">
                                {{$translations['previous']}}</a>
                            </li>
                            @endif

                            @if ($orders->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next">{{$translations['next']}}</a>
                            </li>
                            @else
                            <li class="page-item disabled">
                                <a class="page-link" href="#">{{$translations['next']}}</a>
                            </li>
                            @endif
                        </ul>
                    </nav>
                    @endif
                </div>
            </div>

        </div>
    </section>
</div>