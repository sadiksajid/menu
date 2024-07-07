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
                <h3>{{Cache::get('store_info')[$store_name]['title'] ?? 'Good For Health'}}</h3>
            </div>
            @foreach ( $store as $key => $product )
            <div class="item d-flex pr-0">
                <div class="item-img mr-2">
                    @if($product['type']=='product')
                    <img src="{{ get_image('tmb/'.$product['image']) }}" alt="Image" class="img-fluid"
                        style='border-radius: 10px;'>
                    @else
                    <img src="{{ get_image('tmb/'.$product['image']) }}" alt="Image" class="img-fluid"
                        style='border-radius: 10px;'>
                    <br>
                    <span class="badge badge-info" style="width: 100%;">{{$translations['offer']}}</span>

                    @endif
                </div>
                <div class="item-info " style="">
                    <span class="title"
                        style="margin: 0;text-align: left;font-weight: 600;font-family: sans-serif;">{{$product['product']->title}}</span>
                    <span class="price" style="margin: 0;font-weight: 700;font-size: medium;font-family: sans-serif;margin-bottom:10px">{{$product['qte']}}
                        x {{$product['product']->price}} {{$currency}}</span>
                    <a href="#" wire:click="removeProduct('{{$key}}')" class="remove"
                        style="padding: 0">{{$translations['remove']}}</a>
                </div>
            </div>
            @endforeach
            @endforeach
            <div class="item d-flex">
                <div class="item-img mr-4">
                    <a class="btn btn-warning rounded-3 btn-block" style=" width: 80px"
                        href="/client/cart">{{$translations['cart']}}</a>
                </div>
            </div>
            <div class="total  border-top pt-2"  >
                <div class="w-100" style='text-align: center;'>
                    <button class='btn btn-warning w-100'>
                        <h4 class='m-0'>
                        <strong class="total-price"
                            style="font-family: sans-serif">{{$total}}
                            {{$currency}}</strong>
                        </h4>
                    </button>
                </div>
                <div class="w-100 text-center">
                <a class="btn  rounded-5 btn-block"
                href="/client/checkout">
                    <button class='btn btn-dark' style='width:80%'>
                             {{$translations['checkout']}}
                    </button>
                    </a>
                  
                </div>
            </div>

        </div>

    </aside>

</div>

<script>
document.addEventListener("DOMContentLoaded", function(event) {
    document.getElementById('orders_nbr').innerHTML = "{{$order_nbr}}";

});
</script>