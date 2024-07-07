<div>
    <aside class="sidebar" style="z-index: 999999">
        <div class="toggle" style="height: 67px;
        background-color: white;
        z-index: 10;">
            <a href="#" class="burger js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
                <span></span>
            </a>

            <span class="bag-label">{{$translations['your_bag']}}</span>
        </div>
        <div class="side-inner">
            @foreach ($my_cart as $store_name => $store)
            <div class="item d-flex">
                <h3>{{Cache::get('store_info')[$store_name]['title'] ?? 'Store'}}</h3>
            </div>
            @foreach ( $store as $key => $product )
            <div class="item d-flex">
                <div class="item-img mr-4" style="    margin-right: 13px !important; ">
                    @if($product['type']=='product')
                    <img src="{{ get_image('tmb/'.$product['image']) }}" alt="Image" class="img-fluid">
                    @else
                    <img src="{{ get_image('tmb/'.$product['image']) }}" alt="Image" class="img-fluid">
                    <br>
                    <span class="badge badge-info" style="width: 100%;">{{$translations['offer']}}</span>

                    @endif
                </div>
                <div class="item-info " style="margin-left: 20px;">
                    <span class="title"
                        style="margin: 0;font-weight: 600;font-size: medium;font-family: sans-serif;">{{$product['product']->title}}</span>
                    <span class="price"
                        style="margin: 0;font-weight: 700;font-size: medium;font-family: sans-serif;margin-bottom:10px">{{$product['qte']}}
                        x {{$product['product']->price}} {{$currency}}</span>
                    <a href="#" wire:click="removeProduct('{{$key}}')" class="remove"
                        style="padding: 0">{{$translations['remove']}}</a>
                </div>
            </div>
            @endforeach
            @endforeach
            <div class="item d-flex ">
                <div class="item-img mr-4">
                    <a class="btn btn-warning rounded-3 btn-block" style=" width: 80px"
                        href="/client/cart">{{$translations['cart']}}</a>
                </div>
            </div>
            <div class="total d-flex align-items-center border-top py-5" style="margin-top:10px">
                <div class="w-50">
                    <span class="d-block subtotal-label">{{$translations['subtotal']}} </span>
                    <strong class="total-price"
                        style="font-weight: 700;font-size: medium;font-family: sans-serif;margin-bottom:10px">{{$total}}
                        {{$currency}}</strong>
                </div>
                <div class="w-50">
                    <a class="btn btn-secondary rounded-0 btn-block"
                        href="/client/checkout">{{$translations['checkout']}}</a>
                </div>
            </div>

        </div>

    </aside>

</div>

<script>

document.addEventListener("DOMContentLoaded", function(event) { 
    document.getElementById('orders_nbr').innerHTML = "{{$order_nbr}}" ;

});

</script>