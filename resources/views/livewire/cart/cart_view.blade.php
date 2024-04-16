<div>
    
    <div wire:ignore class="hero_single inner_pages background-image" style="height:260px"
    @if (isset($images_cart))   data-background=" {{ get_image($images_cart)}} " @else data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif >

        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1  > {{ $titles_cart ?? $translations['cart']['en'] }}  </h1>
                        {{-- <p  >{{ $titles['title-2'] ?? 'Cooking delicious and tasty food since 2005' }} </p> --}}
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="frame white"></div>
    </div>
    <section class="cart-section " style="padding-top:10px">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table cart-table table-responsive-xs">
                        <thead>
                        <tr class="table-head">
                            <th scope="col">{{$translations['image']['en']}}</th>
                            <th scope="col">{{$translations['product_name']['en']}}</th>
                            <th scope="col">{{$translations['price']['en']}}</th>
                            <th scope="col">{{$translations['quantity']['en']}}</th>
                            <th scope="col">{{$translations['actions']['en']}}</th>
                            <th scope="col">{{$translations['total']['en']}}</th>
                        </tr>
                        </thead>
                        @foreach ($my_cart as $store_name => $store)    
                        @php
                            $currency = Cache::get('store_info')[$store_name]['currency'] ?? 'DH';
                        @endphp            
                            <tr>
                                <td colspan="2">
                                    <h3>{{Cache::get('store_info')[$store_name]['title'] ?? 'Store'}}</h3>
                                </td>
                            </tr>
                            <tbody>
                                @foreach ($store as $key => $product)
                    
                                    <tr>
                                        <td>

                                            @if($product['type']=='product')
                                            <a href="#"><img alt="" src="{{ get_image($product['image']) }}" class="rounded-circle"></a>
                                            @else
                                            <a href="#"><img alt="" src="{{ get_image($product['image']) }}" class="rounded-circle" width="90px"></a>
                                            <span class="badge badge-info" style="width: 80%;">{{$translations['offer']['en']}}</span>

                                            @endif


                                        </td>
                                        <td><a href="#">{{$product['product']->title}}</a>
                                            <div class="mobile-cart-content row">
                                                <div class="col-xs-3">
                                                    <div class="qty-box">
                                                        <div class="input-group">
                                                            <input class="form-control input-number" name="quantity" type="text"
                                                                value="{{$product['qte']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-3">
                                                    @if ($product['type'] == 'offer')
                                                        <del><h2 class="td-color">{{$product['product']->old_price}} {{$currency}}</h2></del>
                                                    @endif

                                                    <h2 class="td-color">{{$product['product']->price}} {{$currency}}</h2>
                                                </div>
                                                <div class="col-xs-3">
                                                    <h2 class="td-color">
                                                        <a class="icon" wire:click="removeProduct('{{$key}}','{{$store_name}}')">
                                                            <i aria-hidden="true" class="fa fa-times"></i>
                                                        </a>
                                                    </h2>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($product['type'] == 'offer')
                                                <del><h2>{{$product['product']->old_price}} {{$currency}}</h2></del>
                                            @endif

                                            <h2>{{$product['product']->price}} {{$currency}}</h2>
                                        </td>
                                        <td>
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <input class="form-control input-number" name="quantity" type="number" wire:click="changeQte('{{$key}}','{{$store_name}}')" wire:model.defer="quantity.{{$key}}" value="{{$product['qte']}}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="icon" wire:click="removeProduct('{{$key}}','{{$store_name}}')">
                                                <i aria-hidden="true" class="fa fa-times"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <del><h2 class="td-color">{{ $product['qte'] * $product['product']->old_price}} {{$currency}}</h2>                                            </del>

                                            <h2 class="td-color">{{ $product['qte'] * $product['product']->price}} {{$currency}}</h2>
                                        </td>
                                    </tr>
                    
                                @endforeach
                            </tbody>
                        @endforeach
                    </table>
                    <table class="table cart-table table-responsive-md">
                        <tfoot>
                        <tr>
                            <td>{{$translations['total_price']['en']}} :</td>
                            <td>
                                <h2>{{$total}}  {{$currency}}</h2></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row cart-buttons">
                {{-- <div class="col-6"><a class="btn primary-btn btn-default" href="/store/{{Cache::get('last_store')}}">continue shopping</a></div> --}}
                <div class="col-6"><a class="btn primary-btn btn-default" href="/shop">{{$translations['continue_shopping']['en']}}</a></div>
                <div class="col-6"><a class="btn primary-btn btn-default" href="/client/checkout">{{$translations['checkout']['en']}}</a></div>
            </div>
        </div>
    </section>
</div>