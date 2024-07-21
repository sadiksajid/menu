<div>

    <style>
    .delete_bg_color {
        background-color: #eb6a6a;
        /* Optional: to reset default margin */
    }

    .collapse_div {
        background-color: white;
        width: 0px;
        height: 100vh;
        position: fixed;
        z-index: 99999;
        right: 0px;
        top: 0px;
        transition: 0.5s;
        overflow: auto;
    }

    .collapse_div_show {
        width: 450px !important;
        padding: 20px;

    }

    .collapse_div_hover {
        background-color: #000000;
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 9999;
        top: 0;
        left: 0;
        opacity: 0;
        transition: 0.5s;
    }


    .collapse_div_hover_opacity {
        opacity: 0.5 !important;
    }



    h3 {
        font: 25px sans-serif;
        text-align: center;
        text-transform: uppercase;
    }




    h3.no-background {
        position: relative;
        overflow: hidden;
    }

    .h2-span {
        display: inline-block;
        vertical-align: baseline;
        zoom: 1;
        *display: inline;
        *vertical-align: auto;
        position: relative;
        padding: 0 20px;

        &:before,
        &:after {
            content: '';
            display: block;
            width: 1000px;
            position: absolute;
            top: 0.73em;
            border-top: 1px solid black;
        }

        &:before {
            right: 100%;
        }

        &:after {
            left: 100%;
        }
    }

    .order_list_onlin {
        width: 60%;

    }

    .order_list_caise {
        width: 92%;
    }


    .order_list_card {
        padding: 7px 11px;
        width: 410px !important;
        border: 1px solid #524f4f;
        border-left: 5px solid #524f4f;
        border-radius: 5px;
    }

    .order_list_card_title {
        height: auto;
        border-radius: 50px;
        border-radius: 10px;
        font-size: 17px;
    }

    .client_info_row {
        padding-top: 5px;
        font-size: 17px;
        padding-bottom: 5px;
    }


    .order_list_onlin_icon_man {
        width: 50px;
        float: right;
        margin-right: unset;
        position: absolute;
        top: -18px;
        right: 10px;
    }


    .order_list_onlin_icon_moto {
        width: 66px;
        float: right;
        margin-right: unset;
        position: absolute;
        top: -25px;
        right: 1px;

    }

    .order_edit_icon_man {
        width: 90px;
        margin-right: unset;
        position: absolute;
        right: 5px;
        height: 90px;
        top: -33px;
    }

    .order_edit_icon_moto {
        width: 100px;
        margin-right: unset;
        position: absolute;
        right: 6px;
        height: 100px;
        top: -44px;
    }

    .products_list {
        background-color: #f0f0f0;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        overflow: hidden;
    }

    .product_list_title_div {
        background-color: rgb(0, 0, 0, 0.5);
        position: absolute;
        z-index: 10;
        color: white;
        bottom: 0px;
        width: 100%;
        height: 30%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 5px 5px 5px 5px;
    }

    .product_list_content{
        overflow: hidden;
        width: 100%;
        height: 150px;
        position:relative;
    }
    /* //////////////////////////////////////////////////////////////////// */



    .danger-neon-border span {
        position: absolute;
        display: block;
    }

    .danger-neon-border span:nth-child(1) {
        top: 0;
        background: linear-gradient(90deg, transparent, red);
        animation: animate1 1s linear infinite;
        left: 0;
        width: 100%;
        height: 2px;
    }

    /* add keyframes for animation*/
    @keyframes animate1 {
        0% {
            left: -100%;
        }

        50%,
        100% {
            left: 100%;
        }
    }

    /* 2nd line animation*/
    .danger-neon-border span:nth-child(2) {
        top: -100%;
        background: linear-gradient(180deg, transparent, red);
        animation: animate2 1s linear infinite;
        right: 0;
        width: 2px;
        height: 100%;
        animation-delay: 0.25s;
    }

    /* add keyframes*/
    @keyframes animate2 {
        0% {
            top: -100%;
        }

        50%,
        100% {
            top: 100%;
        }
    }

    /* 3rd line animation*/
    .danger-neon-border span:nth-child(3) {
        bottom: 0;
        right: 0;
        background: linear-gradient(270deg, transparent, red);
        animation: animate3 1s linear infinite;
        width: 100%;
        height: 2px;
    }

    @keyframes animate3 {
        0% {
            right: -100%;
        }

        50%,
        100% {
            right: 100%;
        }
    }

    /* 4th line animation*/
    .danger-neon-border span:nth-child(4) {
        bottom: -100%;
        left: 0;
        background: linear-gradient(360deg, transparent, red);
        animation: animate4 1s linear infinite;
        width: 2px;
        height: 100%;
        animation-delay: 0.75s;
    }

    @keyframes animate4 {
        0% {
            bottom: -100%;
        }

        50%,
        100% {
            bottom: 100%;
        }
    }

    /* ///////////////////////////////////////////////// */
    </style>


    <div class="container-fluid">
        <div class='collapse_div_hover d-none' id='collapse_div_close'>

        </div>

        <div class="row">
            <div class="col-md-1 col-12 p-0" style="max-height: 88vh;overflow:auto">
                <ul class="side-menu app-sidebar3">
                    <li class="slide">
                        <a class="side-menu__item p-0" href="#" wire:click='SelectCat(0)'>
                            <!-- <img src="{{ URL::asset('assets/images/all.png') }}" alt="..." style='    width: 70px;
                            height: 70px;object-fit: cover; @if($selected_cat ==0 )  border: 3px solid black;  @endif'
                                class='img-thumbnail rounded-pill'> -->
                            <button class='btn btn-primary'
                                style=' width: 70px;height: 70px;object-fit: cover; @if($selected_cat ==0 )  border: 3px solid black;  @endif  border-radius: 100px;font-size: 30px;padding: 0;padding-left: 3px'
                                class='img-thumbnail rounded-pill'>
                                <center><i class="fa fa-arrows-alt" aria-hidden="true"></i></center>
                            </button>

                            <h5> {{$translations['all']}}</h5>
                        </a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item p-0" href="#" wire:click='SelectCat(-1)'>
                            <button class='btn btn-primary'
                                style=' width: 70px;height: 70px;object-fit: cover; @if($selected_cat ==-1 )  border: 3px solid black;  @endif  border-radius: 100px;font-size: 30px;padding: 0;padding-left: 3px'
                                class='img-thumbnail rounded-pill'>
                                <center><i class="fa fa-star-o" aria-hidden="true"></i></center>
                            </button>

                            <h5> {{$translations['offers']}}</h5>
                        </a>
                    </li>

                    @foreach ( $categories as $category)
                    <li class="slide" style="cursor: pointer">
                        <a class="side-menu__item p-0" rol="button" wire:click='SelectCat({{$category["id"]}})'>
                            <img src="{{ get_image('tmb/'.$category['image']) }}" alt="..."
                                style='    width: 70px;
                            height: 70px;object-fit: cover; @if($selected_cat == $category["id"] )  border: 3px solid black;  @endif' class='img-thumbnail rounded-pill'
                                onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';">

                            <h5> {{ $category['title_tr'] }} </h5>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-7 col-12" style="max-height: 88vh;overflow:auto">
                <div class="row">
                    @if(count($offers) != 0)
                    <div class="col-12">
                        <h3 class="no-background"><span class='h2-span'>offers</span></h3>
                    </div>
                    @endif
                    @foreach ( $offers as $offer)
                    <div class="col-xl-3  col-md-4 col-6 product_list_click" data-id="{{$offer->id}}" data-offer='1'
                        wire:click='SelectProd({{$offer->id}},1)' style="cursor: pointer ; @if($offer->in_stock == 0) opacity:0.4 @endif">
                        <input type="text" class='d-none status' value='{{$offer->in_stock}}'>

                        <div class="card products_list"
                            style="background-image: url('{{ get_image('tmb/'.$offer->image) }}')">

                            <div class='product_list_content' style="@if(in_array('o_'.$offer->id,$selected_products_ids)) border: 4px solid #343a40; @endif">
                                <span class="badge badge-dark" role="button"
                                    style="position: absolute; z-index:10;color:white;top:0px">
                                    <h5 class="mb-0"><strong class='price'>{{ $offer->price}} {{$currency}}</strong></h5>
                                </span>
                                <div class='product_list_title_div'>
                                    <center>
                                        <h6 class="card-title " style='font-size: 101%;'>{{$offer->title}}</h6>
                                    </center>
                                </div>
                        
                            </div>
                        </div>
                    </div>

                    @endforeach


                    @foreach ( $categories as $category)
                    @php
                    if( $products != []){
                    $products_cat = $products->where('product_category_id', $category["id"]) ;
                    }else{
                    $products_cat = [];
                    }
                    @endphp

                    @if(count($products_cat) != 0)
                    <div class="col-12">
                        <h3 class="no-background"><span class='h2-span'>{{ $category['title_tr'] }} </span></h3>
                    </div>
                    @endif
                    @foreach ( $products_cat as $product)

                    <div class="col-xl-2  col-md-3 col-6 product_list_click" onclick="selectProd({{$product->id}})"
                        style="cursor: pointer ; @if($product->in_stock == 0) opacity:0.4 @endif" data-id="{{$product->id}}" data-offer='0'>
                        <input type="text" class='d-none status' value='{{$product->in_stock}}'>

                        <div class="card products_list"
                            style="background-image: url('{{ get_image('tmb/'.$product->media[0]->media) }}')">
                            <div class='product_list_content' style=" @if(in_array($product->id,$selected_products_ids)) border: 4px solid #343a40; @endif">
                                <span class="badge badge-dark" role="button"
                                    style="position: absolute; z-index:10;color:white;top:0px">
                                    <h5 class="mb-0"><strong  class='price'>{{ $product->price}} {{$currency}}</strong></h5>
                                </span>
                                <div class='product_list_title_div'>
                                    <center>
                                        <h6 class="card-title " style='font-size: 101%;'>{{$product->title }}</h6>
                                    </center>
                                </div>
                                <!-- <img src="{{ get_image('tmb/'.$product->media[0]->media) }}" lass="card-image1 "
                                    style='height: 100%;width: 100%;'
                                    onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';"> -->
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @endforeach

                </div>
            </div>
            <div class="col-md-4 col-12">
                <!-- ///////////////////////////////////////////////////////// -->
                <div class='collapse_div'>
                    @php
                    krsort($new_orders);
                    @endphp

                    @foreach ( $new_orders as $order )
                    @php
                    if(isset($order["offers"])){
                    if($order["offers"] == null){
                    $is_offer = 0 ;
                    }else{
                    $is_offer = 1 ;
                    }
                    }else{
                    $is_offer = 0 ;
                    }

                    if($order["status"] == 'pending'){
                    $div_color = "#ff6f00";
                    }else if($order["status"] == 'confirmed'){
                    $div_color = "#8500ff";

                    }else{
                    $div_color = "#444444";
                    }
                    @endphp

                    <!-- }else if($order["status"] == 'ready' or $order["status"] == 'shipped'){
                                $div_color = "#0dd700"; -->

                    <div class="list-card pb-0 order_list_card " style="border-left-color: {{$div_color }}">
                        <button class="btn btn-outline-dark  " style='height: 70px;float: left;'
                            wire:click='editOrder({{$order["id"]}},{{$is_offer}},"{{$order["order_type"]}}")'>
                            <i class="fe fe-edit me-1 d-inline-flex"></i>
                        </button>
                        <button class='btn btn-outline-secondary' style='height: 70px;float:right'
                            wire:click='deleteOrder({{$order["id"]}})'>
                            <i class="fe fe-trash-2 me-1 d-inline-flex"></i>
                        </button>
                        <div class="row align-items-center">
                            <div class="col-12 pr-0">
                                <div class="d-sm-flex mt-0">

                                    <div class="media-body ms-3 ">
                                        @if($order['order_type'] != 'caisse')
                                        <span class="avatar avatar-rounded border  order_list_card_title "
                                            style='background-color:{{$div_color}} ;width:20%; font-size: 10px;'>
                                            {{$order['status']}}
                                        </span>
                                        @endif
                                        <span
                                            class="avatar avatar-rounded border  order_list_card_title @if($order['order_type'] == 'caisse') order_list_caise @else order_list_onlin @endif"
                                            style='background-color:{{$div_color}}'>
                                            Order ID : {{$order['id']}}
                                        </span>

                                        @if($order['order_type'] == 'coming')
                                        <lottie-player class='order_list_onlin_icon_man'
                                            src="{{ URL::asset('assets/SVG/coming_icon_orange.json') }}"
                                            background="transparent" speed="1" loop autoplay></lottie-player>
                                        @elseif($order['order_type'] == 'shipping')
                                        <lottie-player class='order_list_onlin_icon_moto'
                                            src="{{ URL::asset('assets/SVG/moto_orange.json') }}"
                                            background="transparent" speed="1" loop autoplay></lottie-player>
                                        @endif

                                        <div class="p-0" style="float: right;margin-right: 20px; margin-top: 3px;">
                                            <div class="text-end"> <span class="fw-semibold  fs-16 number-font">
                                                    <center>
                                                        <h3 style=" margin: 0;">{{$order['total']  }} {{$currency}}</h3>
                                                    </center>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-md-flex align-items-center mt-1">
                                            <p class="ml-1 mt-1" style='font-size: 14px;'>
                                                <strong>{{\Carbon\Carbon::parse($order['created_at'])->format('Y-m-d H:i') }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    @endforeach
                </div>
                <!-- ///////////////////////////////////////////////////////// -->

                <div class="card mb-0">
                    <div class="card-header">
                        <h5 class="card-title">{{$translations['selected_products']}} - {{count($selected_products)}}
                        </h5>
                        <button class="btn btn-warning label-btn rounded-pill"
                            style="float: right;right: 13px; position: absolute;" wire:click='ResetAll()'> <i
                                class="fa fa-refresh label-btn-icon me-2 rounded-pill" style='color:black'></i>
                        </button>
                    </div>
                    <div class="card-body p-2" style="height: 50vh;overflow:auto">
                        @foreach ( $selected_products as $product )

                        <div class="list-card pb-0" style="padding: 9px 11px;!important" data-id='{{$product["id"]}}'>
                            <span class="bg-warning list-bar"></span>
                            <div class="row align-items-center">
                                <div class="col-md-7 col-12 pr-0">
                                    <div class="d-sm-flex mt-0">

                                        <div class="media-body ms-3 ">
                                            <span class="avatar avatar-rounded border border-warning"
                                                style="width: 2.3rem;height: 2.3rem;border-radius:50px;    border-radius: 10px">
                                                <img src="{{ $product['image'] }}" alt="img"
                                                    style="    border-radius: 10px;"
                                                    onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';">
                                            </span>
                                            <div class="p-0" style="float: right;margin-right: 50px; margin-top: 10px;">
                                                <div class="text-end"> <span class="fw-semibold  fs-16 number-font">
                                                        <center>
                                                            {{$product['price'] * $selected_products_qty[$product['id']] }}
                                                            {{$currency}}
                                                        </center>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="d-md-flex align-items-center mt-1">
                                                <p class="ml-1 mt-1"><strong>{{$product['title'] }}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-11 p-0 pr-2">
                                    <div class="input-group mb-3">
                                        <button class="btn btn-dark" type="button" class="button-addon1"
                                            wire:click='changeQte("{{$product["id"] }}","plus")'>+</button>
                                        <input type="text" class="form-control" placeholder=""
                                            aria-label="Example text with button addon" aria-describedby="button-addon1"
                                            wire:model="selected_products_qty.{{$product['id'] }}"
                                            style=" text-align: center;">
                                        <button class="btn btn-dark" type="button" class="button-addon1"
                                            wire:click='changeQte("{{$product["id"] }}","minus")'>-</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    @if($is_online == true )
                    <div class="card-footer p-0">
                        <ul class="list-group">
                            <li class="list-group-item active" aria-current="true"
                                style='padding-top:3px;padding-bottom:3px'>
                                <div class="d-flex align-items-center">
                                    <div> <span class="fs-15"> <i class="bi bi-house-door"></i> </span> </div>
                                    <div class="ms-2" style='font-size: 20px;'>
                                        <strong>{{ $online_client->firstname ?? 'firstname' }}
                                            {{ $online_client->lastname ?? 'lastname' }}</strong>
                                    </div>



                                    @if($online_order_type == 'coming')
                                    <lottie-player class='order_edit_icon_man'
                                        src="{{ URL::asset('assets/SVG/coming_icon_orange.json') }}"
                                        background="transparent" speed="1" loop autoplay></lottie-player>
                                    @elseif($online_order_type == 'shipping')
                                    <lottie-player class='order_edit_icon_moto'
                                        src="{{ URL::asset('assets/SVG/moto_orange.json') }}" background="transparent"
                                        speed="1" loop autoplay></lottie-player>
                                    @endif



                                </div>
                            </li>
                            <li class="list-group-item client_info_row">
                                <div class="d-flex align-items-center ">
                                    <div> <span class="fs-15"> <i class="bi bi-bell"></i> </span> </div>
                                    <div class="ms-2"> <i class="fa fa-phone mr-2"></i>
                                        {{ $online_client->phone ?? '0000' }} </div>
                                </div>
                            </li>
                            @if($online_order_type == 'coming')
                            <li class="list-group-item client_info_row">
                                <div class="d-flex align-items-center">
                                    <div> <span class="fs-15"> <i class="bi bi-gift"></i> </span> </div>
                                    <div class="ms-2"><i class="fa fa-clock-o mr-2"></i> {{$online_client_time}}</div>
                                </div>
                            </li>
                            @else

                            <li class="list-group-item client_info_row">
                                <div class="d-flex align-items-center">
                                    <div> <span class="fs-15"> <i class="bi bi-gift"></i> </span> </div>
                                    <div class="ms-2"><i class="fa fa-map-signs	 mr-2"></i>
                                        {{$this->online_client_address->city->city }} -
                                        {{$this->online_client_address->quartier->quartier }}</div>
                                </div>
                            </li>
                            <li class="list-group-item client_info_row">
                                <div class="d-flex align-items-center">
                                    <div> <span class="fs-15"> <i class="bi bi-gift"></i> </span> </div>
                                    <div class="ms-2"><i class="fa fa-map-marker mr-2"></i>
                                        {{$this->online_client_address->address}}</div>
                                </div>
                            </li>
                            @endif

                        </ul>
                    </div>
                    @endif

                </div>

                <div class="card bg-warning mb-3">
                    <div class="card-body p-2">
                        <div class="no-block ">
                            <div>
                                <h2 class="text-fixed-white m-0 fw-bold"
                                    style="float: left;    margin-top: 5px !important;">{{$translations['total']}} :
                                    {{$total}}</h2>
                            </div>
                            <div class="ms-auto" style="float: right"> <span
                                    class="text-fixed-white display-6">{{$currency}}</span> </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if($update_order == false)
                    <div class="col-12">
                        <button class="btn btn-dark btn-lg" style="width:100%" wire:click="ValidCheckout()"
                            id='checkout'>{{$translations['checkout']}} <i
                                class="fe fe-dollar-sign me-1 d-inline-flex"></i>
                            <div wire:loading class="spinner-border text-info ml-3" role="status"
                                style="width: 25px;height: 25px;position: absolute;">
                                <span class="sr-only">{{ $translations['loading'] }} ...</span>
                        </button>
                    </div>
                    @else
                    <div class="col-8">
                        <button class="btn btn-dark btn-lg" style="width:100%"
                            wire:click="confirmPassword('updateOrder')" id='checkout'>

                            @if($online_order_status == 'pending')
                            {{$translations['order_confirm']}}
                            @elseif($online_order_type == 'coming' and $online_order_status == 'confirmed' )
                            {{$translations['order_ready']}}
                            @elseif($online_order_type == 'shipping' and $online_order_status == 'confirmed' )
                            {{$translations['order_ship']}}
                            @else
                            {{$translations['update']}}
                            @endif
                            <i class="fe fe-edit-sign me-1 d-inline-flex"></i>

                        </button>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-danger btn-lg" style="width:100%"
                            wire:click="cancelUpdate()">{{$translations['cancel']}}
                            <i class="fe fe-close-sign me-1 d-inline-flex"></i>

                        </button>
                    </div>
                    @endif
                    <div class="col-8 mt-3">
                        @if($online_orders_pending > 0)
                        <h1 style='position: absolute;top: 0;'><span class="badge badge-danger"
                                style='font-size: 20px;height: 50px;padding: 15px;'>{{$online_orders_pending }}</span>
                        </h1>

                        <button class="btn btn-outline-danger btn-lg danger-neon-border"
                            style="overflow: hidden;width:100%;position: relative;height: 50px;" id='collapse_div_show'>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>

                            New Orders
                            <lottie-player src="{{ URL::asset('assets/SVG/notification_red.json') }}"
                                background="transparent" speed="1"
                                style="width: 100px;height: 100px;position: absolute;top: -28px;right: -19px;" loop
                                autoplay></lottie-player>
                        </button>

                        @else
                        <button class="btn btn-outline-primary btn-lg " style="width:100%"
                            id='collapse_div_show'>{{$translations['orders']}}
                            <i class="fe fe-clock me-1 d-inline-flex"></i></button>
                        @endif

                    </div>

                    @if($update_order == true)
                    <div class="col-4 mt-3">
                        <button class="btn btn-outline-danger btn-lg h-100" style="width:100%"
                            wire:click='deleteOrder({{$update_order_id }})'>
                            <i class="fe fe-trash-2 me-1 d-inline-flex"></i>
                    </div>
                    @endif

                    @if($last_order_id != null and $update_order == false)
                    <div class="col-4 mt-3">
                        <button class="btn btn-primary btn-lg" wire:click='printLastOrder({{$last_order_id }})'>
                            <span style='font-size:27px'><i class="fa fa-print"></i></span>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style='background-color:#705ec8'>
                <div class="modal-body">
                    <input type="text" id='functionName' class='d-none'>
                    <input type="text" id='functionId' class='d-none'>
                    <center>
                        <lottie-player src="{{ URL::asset('assets/SVG/code_bar.json') }}" background="transparent"
                            speed="0.2" style="width:250px;margin-top:-30px" loop autoplay></lottie-player>
                        <h4 style='color:white ; margin-top: -39px;'>{{$translations['cart_scan']}} </h4>
                    </center>
                </div>
                <div class="modal-footer border-0" style='    justify-content: center;'>

                    <button type="button" tabindex="-1" class="btn btn-light mr-6"
                        id='scanToPassword'>{{$translations['use_password']}}</button>
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{$translations['close']}}</button>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="edit_product_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style='border-radius:30px'>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{$translations['quick_edit']}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class='row'>
                        <div class='col-md-6 col-12'>
                            <div class="card products_list mb-0 h-100"   id='quick_edit_image' >
                                <div style="overflow: hidden;
                                                width: 100%;
                                                min-height: 30vh;
                                                height: 100%;
                                                position:relative;
                                                ">
                                    <div class='product_list_title_div'>
                                        <center>
                                            <h6 class="card-title " id='quick_edit_title' style='font-size: 101%;'></h6>
                                        </center>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class='col-md-6 col-12'>
                        
                        <div class='col-12'>
                            <label class="col-12 form-label" >{{$translations['status']}} :</label>
                            <label class="switch">
                                <input type="checkbox" class="switch-input" id='quick_edit_stock'>
                                <span class="switch-label" data-on="In Stock" data-off="Out Of Stock"></span>
                                <span class="switch-handle"></span>
                            </label>
                        </div>

                        <div class="input-group mb-3 col-12" >
                            <label class="col-12 form-label">{{ $translations['price'] }}<span class="text-red">*</span></label>
               
                            <input class="form-control " placeholder="{{ $translations['price'] }}" type="number"
                            pattern="[0-9]+([\.,][0-9]+)?" step="0.01" id='quick_edit_price'>
                            <div class="input-group-append">
                                <span class="input-group-text  bg-dark text-white" id='quick_edit_curency'>MAD</span>
                            </div>
                        </div>
                        <div class='col-12 align-text-bottom' style='text-align:end'>
                            <button type="button" class="btn btn-dark"
                                data-dismiss="modal">{{$translations['close']}}</button>
                            <button type="button" class="btn btn-warning text-dark" id='quick_edit_save'>{{$translations['save']}}</button>
                        </div>

                    </div>
                </div>
  
            </div>
        </div>
    </div>


    <div id="print_show" class='d-none'>
        <iframe id="pdf_iframe" style="width: 100%; height: 500px;"></iframe>
    </div>

</div>
@section('js')




<script src="{{ URL::asset('dist/ScannerScript.js') }}"></script>
<script src="{{ URL::asset('dist/CacheManage.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<!--INTERNAL Index js-->
<script src="{{ asset('js/app.js') }}"></script>

<script>
$(document).ready(function() {

function playSound() {
    console.log('here');
    const audio = new Audio("{{ URL::asset('assets/mp3/notification.wav') }}");
    audio.play();
}



Echo.channel('new_orders')
    .listen('CaiseOrder', function(e) {
        Livewire.emit('onlineOrder', e.data)
        playSound()
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "New Incoming Order!",
            text: "Please check the orders list",
            showConfirmButton: false,
            timer: 3000
        });
    })
})
</script>






<script>
$(document).ready(function() {



    localStorage.removeItem('CaiseSelectedProducts');
    cacheData('CaiseFinishOrder', false)
    cacheData('CaiseRefresh', false)


})

function selectProd(id) {
    Livewire.emit('SelectProd', id);
}

window.addEventListener('SendToAds', event => {

    cacheData('CaiseSelectedProducts', event.detail.data)

})
window.addEventListener('SendToAdsfinish', event => {
    cacheData('CaiseFinishOrder', true)

})

/////////////////////////////////////////////////// show pdf print
window.addEventListener('pdfRendered', event => {
    var pdfData = event.detail.pdfData;
    // Decode the base64 string to binary data
    var binary = atob(pdfData);
    var len = binary.length;
    var buffer = new ArrayBuffer(len);
    var view = new Uint8Array(buffer);

    for (var i = 0; i < len; i++) {
        view[i] = binary.charCodeAt(i);
    }

    // Create a Blob object from the binary data
    var blob = new Blob([view], {
        type: 'application/pdf'
    });
    var url = URL.createObjectURL(blob);

    // Set the source of the existing iframe to the Blob URL
    var iframe = document.getElementById('pdf_iframe');
    // $('#print_show').removeClass("d-none");

    iframe.src = url;

    // Add an event listener for when the iframe has loaded
    iframe.onload = function() {
        // Trigger the print dialog
        // console.log(iframe.contentWindow);
 
        var check = false
        var x = 0 ;
        do {
            setTimeout(function() {
                check =   (iframe.contentWindow == undefined);
                console.log(check);
            }, 500);
            x = x + 1 ; 
        } while ( check == true || x == 6);


        iframe.contentWindow.print()


    };


});


function removeIfram() {
    iframe = $('#pdf_iframe')
    var iframeSrc = iframe.attr('src');
    if (iframeSrc && iframeSrc.trim() !== "") {
        $('#print_show').html(`<iframe id="pdf_iframe" style="width: 100%; height: 500px;"></iframe>`);

    }
}

$("body").hover(function() {
    removeIfram()
});


window.addEventListener('pdfRenderedPrint', event => {


    var url = event.detail.url;

    $("#wait_print").attr("href", url);

    $('#wait_print').addClass("print_python");


});




window.addEventListener('swip', event => {

    // Variables to store the initial touch position
    let initialX = null;
    let initialY = null;

    // Add touch event listeners to the draggable elements
    $(".list-card").on("touchstart", function(event) {
        const touch = event.touches[0];
        initialX = touch.clientX;
        initialY = touch.clientY;
        $(this).addClass("dragging");
    });

    $(".list-card").on("touchmove", function(event) {
        if (initialX === null || initialY === null) {
            return;
        }
        const touch = event.touches[0];
        const currentX = touch.clientX;
        const deltaX = currentX - initialX;
        if (deltaX > $(this).width() / 2) {
            $(this).addClass("delete_bg_color");
        } else {
            $(this).removeClass("delete_bg_color");

        }
        if (deltaX > $(this).width() / 10) {
            $(this).css({
                transform: `translateX(${deltaX}px)`
            });
            event.preventDefault();
        }

    });

    $(".list-card").on("touchend", function(event) {
        if (initialX === null || initialY === null) {
            return;
        }
        const touch = event.changedTouches[0];
        const currentX = touch.clientX;
        const deltaX = currentX - initialX;
        $(this).removeClass("dragging");

        if ($(this).hasClass("delete_bg_color")) {
            var id = $(this).data('id');
            $(this).remove();
            Livewire.emit('RemoveProd', id);
        }

        $(this).css({
            transform: "translateX(0)"
        });

        initialX = null;
        initialY = null;
    });


});



window.addEventListener('confirmPassword', event => {

    // Get the modal

    //////////////////////////////////// password 
    function password() {
        Swal.fire({
            title: "Submit your password",

            html: `
            <center> <lottie-player src="{{ URL::asset('assets/SVG/password.json') }}"  background="transparent"  speed="0.2"  style="width:250px;margin-top:-30px"  loop  autoplay></lottie-player> </center>
        `,

            input: "password",
            showCancelButton: true,
            confirmButtonText: "Next",
            confirmButtonColor: '#7066e0',
            customClass: {
                popup: 'swal2-custom-zindex' // Apply the custom z-index class
            },
        }).then((result) => {
            if (result.isConfirmed) {

                try {
                    $.ajax({
                        url: '{{ route("check_admin_password") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // CSRF token
                            password: result.value,

                        },
                        success: function(response) {
                            if (response.data == -1) {
                                Swal.fire({
                                    title: "Incorrect Password!",
                                    text: "Please Try Again",
                                    icon: "error"
                                });
                            } else {
                                data = {
                                    val: event.detail.id,
                                    id: response.data,
                                    name: response.name
                                }
                                Livewire.emit(event.detail.function, data);

                            }
                        },
                        error: function(err) {
                            Swal.fire({
                                title: "Incorrect Password!",
                                text: "Please Try Again",
                                icon: "error"
                            });
                        }
                    });


                } catch (error) {
                    Swal.fire({
                        title: "Incorrect Password!",
                        text: "Please Try Again",
                        icon: "error"
                    });
                }


            }
        });
    }

    //////////////////////////////////////////////////// scamner

    function scanner() {


        $('#functionName').val(event.detail.function);
        $('#functionId').val(event.detail.id);

        $('#scanModal').modal("show");

        $("#scanToPassword").on("click", function(event) {
            $('#scanModal').modal("hide");

            password()
        });

    }

    scanner()
});


window.addEventListener('close_modal', event => {
    $('#scanModal').modal("hide");
    $('#edit_product_modal').modal('hide')

});

var modalScan = document.getElementById('scanModal');


document.body.addEventListener('keydown', function(event) {

    if (event.key === 'Enter') {
        event.preventDefault(); // Prevent the default action
    }
    if (modalScan.style.display === 'block') { // Check if modal is shown

        getkey(event); // Call getkey function
    } else {
        getkeyOrder(event);
    }
});


$(document).ready(function() {

    // document.body.style.zoom = "70%";

    $("#collapse_div_show").on("click", function(event) {


        $('.collapse_div').addClass("collapse_div_show");
        $('.collapse_div_hover').removeClass("d-none");

        setTimeout(() => {
            $('.collapse_div_hover').addClass("collapse_div_hover_opacity");
        }, 100);

    });

    $("#collapse_div_close").on("click", function(event) {
        $('.collapse_div').removeClass("collapse_div_show");
        $('.collapse_div_hover').removeClass("collapse_div_hover_opacity");

        setTimeout(() => {
            $('.collapse_div_hover').addClass("d-none");
        }, 1000);


    });


    $(".list-card").on("touchend", function(event) {
        if (initialX === null || initialY === null) {
            return;
        }
        const touch = event.changedTouches[0];
        const currentX = touch.clientX;
        const deltaX = currentX - initialX;
        $(this).removeClass("dragging");

        if ($(this).hasClass("delete_bg_color")) {
            var id = $(this).data('id');
            $(this).remove();
            Livewire.emit('RemoveProd', id);
        }

        $(this).css({
            transform: "translateX(0)"
        });

        initialX = null;
        initialY = null;
    });


});


$("#ads_caise_btn").on("click", function(event) {
    $('.collapse_div').removeClass("collapse_div_show");
    $('.collapse_div_hover').removeClass("collapse_div_hover_opacity");

    setTimeout(() => {
        $('.collapse_div_hover').addClass("d-none");
    }, 1000);

    openNewWindow()
});


function openNewWindow() {
    // URL of the new page (this can be any valid URL)
    const url = "{{ url('/admin/caisse/ads')}}";
    // Calculate screen dimensions
    const screenX = window.screenX || window.screenLeft;
    const screenY = window.screenY || window.screenTop;
    const screenWidth = window.screen.width;
    const screenHeight = window.screen.height;

    // Determine the position of the second screen
    const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : screenX;
    const dualScreenTop = window.screenTop !== undefined ? window.screenTop : screenY;

    // Calculate the position for the new window
    const left = dualScreenLeft + screenWidth;
    const top = dualScreenTop;

    // Options for the new window (full screen on the second screen)
    const windowFeatures = `left=${left},top=${top},width=${screenWidth},height=${screenHeight}`;

    // Open the new window with the specified URL and features
    const newWindow = window.open(url, 'NewWindow', windowFeatures);

    // Maximize the new window if it was successfully created
    if (newWindow) {
        newWindow.moveTo(left, top);
        newWindow.resizeTo(screenWidth, screenHeight);
        newWindow.focus();
    }
}
//////////////////////////////////////////////////





$('.product_list_click').on('contextmenu', function(event) {
    event.preventDefault(); // Prevent the default context menu

    var dataId = $(this).data('id');
    var isOffer = $(this).data('offer');
    console.log("Right-clicked item with data-id: " + dataId);

    var $this = $(this);
    var backgroundImage = $this.find('.products_list').css('background-image');
    var price = $this.find('.price').text();
    var status = $this.find('.status').val();
    var title = $this.find('.card-title').text();

    // Extract URL from background-image
    var imageUrl = backgroundImage.slice(5, -2);

    // Update context menu content
    $("#quick_edit_image").css("background-image", "url(" + imageUrl + ")");
    $("#quick_edit_title").text(title);


    
    if(status == 1){
        $( "#quick_edit_stock" ).prop( "checked", true );
    }else{
        $( "#quick_edit_stock" ).prop( "checked", false );
    }


    $("#quick_edit_price").val(parseInt(price));
    var curency = price.replace(/[^a-z]/gi, '');
    $("#quick_edit_curency").text(curency);

    $('#edit_product_modal').modal('show')


    $('#quick_edit_save').on('click', function(event) {

        var in_stock = $('#quick_edit_stock').is(":checked")

        var price = $("#quick_edit_price").val();

        var data = {
            'id':dataId,
            'is_offer':isOffer,
            'in_stock':in_stock,
            'price':price,
        }
        Livewire.emit('quickEditProduct', data);



    });

    window.addEventListener('SendToAdsRefresh', event => {
        cacheData('CaiseRefresh', true)

    })



});





</script>


@endsection