@section('css')
<link href="{{ URL::asset('assets2/css/slick.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets2/css/slick-theme.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('index1/css/flex_slider.css') }}" rel="stylesheet">


<style>
    .product-box {
        box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
    }

    .product-box:hover {
        box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
    }

    .cat_title{
        font-family: cursive;
        font-weight: bold;
    }
    .cat_div{
        background-position: center; /* Center the image */
        background-repeat: no-repeat; /* Do not repeat the image */
        background-size: cover;
        width:120px;
        cursor:pointer;
        transition: 0.5s;
        height:120px;
        margin-left: 20px;
        margin-top: 20px;
        padding: 0px!important;
        overflow: hidden;
    }

    .over_cat{
        width: 100%;
        height: 100%;
        background-color: rgb(38, 57, 77,0);
        align-items: center;
        justify-content: center;
        display: flex;

        transition: 0.5s

    }

    .cat_titel{
        color: white;
        /* display: none; */
        opacity: 0;
        transition: 0.5s

    }
    .cat_div:hover .cat_titel{
        opacity: 1;

    }
    .cat_div:hover  .over_cat{
        background-color: rgb(38, 57, 77,0.7);

    }

</style>

@endsection
<div>
    @php
    $cart = Cache::get('my_cart');
    @endphp
    <!-- section start -->

    <div wire:ignore class="hero_single inner_pages background-image" style="height:260px" @if (isset($offer->image ))
        data-background="url({{ get_image($offer->image)}})" @else
        data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif >

        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1> {{ $offer->title ?? 'offer' }} </h1>
                        {{-- <p  >{{ $titles['title-2'] ?? 'Cooking delicious and tasty food since 2005' }} </p> --}}
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="frame white"></div>
    </div>
    
    <section class="pb-2 pt-0">
        <div class="collection-wrapper">
            <div class="container">
                
                <div class="row data-sticky_parent">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="container-fluid">

                            <div class="container" style="position: relative">
                                <div class=" col-md-12 client-box text-center p-0 " data-cue="slideInUp">
                                    <center>
                                        <div class="owl-carousel saas-brand owl-theme">
                                            @foreach ($offer->products as $product)
                                              <div style="height: 150px">
                                                  {{-- <a href="/store/goodforhealth/{{ $category->category_meta }}" > --}}
                                                    <a href="/shop/product/{{ $product->product->product_meta }}" >
                                                        <div class="item hover-overlay pt-2 cat_div background-image  shadow border border-dark ; position:relative"
                                                            data-background="url({{ get_image($product->product->media[0]?->media)  }})">
                                                            <span class="badge badge-warning mt-1" role="button"   style="position: absolute; z-index:10;color:black">
                                                                <h7 class="mb-0"><strong>{{ $product->product->price}} {{$currency}}</strong></h7>
                                                            </span>
                                                        </div>

                                                    </a>
                                              </div>
                                            @endforeach
                                        </div>
                
                                    </center>
                                </div>
                            </div>

                            
                            <div class="row">
                                @if(!testMobile())
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-12 offer_img_scroll image-scroll" data-sticky_column>
                                            <div>
                                                <div>
                                                    <img alt="" class="img-fluid"
                                                        src="{{ get_image($offer->image_squad ) }}">
                                                </div>
                                                @foreach ($offer->products as $product)
                                                <div class="mb-2">
                                                    <img alt="" class="img-fluid"
                                                        src="{{ get_image($product->product->media[0]?->media)  }}">
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @else
                                <div class="col-lg-6">
                                    <div class="product-slick">
                                        <div>
                                            <img alt="" class="img-fluid"
                                                src="{{ get_image($offer->image_squad ) }}">
                                        </div>
                                        @foreach ($offer->products as $product)
                                        <div>
                                            <img alt="" class="img-fluid"
                                                src="{{ get_image($product->product->media[0]?->media)  }}">
                                        </div>
                                        @endforeach

                                    </div>
                                    <div class="row">
                                        <div class="col-12 p-0">
                                            <div class="slider-nav">
                                                <div>
                                                    <img alt="" class="img-fluid"
                                                        src="{{ get_image($offer->image_squad ) }}">
                                                </div>
                                                @foreach ($offer->products as $product)
                                                <div>
                                                    <img alt="" class="img-fluid image_zoom_cls-0"
                                                        src="{{ get_image($product->product->media[0]?->media)  }}">
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-lg-6 rtl-text">
                                    <div class="product-right pro_sticky_info" data-sticky_column>
                                        <h2>{{$offer->title}}</h2>
                                        <h3>{{$offer->s_title}}</h3>
                                        <h4>
                                            <del>{{$offer->old_price}} {{$currency}}</del>
                                            <span>{{ intval((($offer->old_price-$offer->price)/$offer->old_price) * 100)}}   % off</span></h4>
                                        <h3>{{$offer->price}} {{$currency}}</h3>

                                        <div class="product-description border-product">

                                            {{-- <div class="size-box">
                                                <ul>
                                                    <li class="active"><a href="#">s</a></li>
                                                    <li><a href="#">m</a></li>
                                                    <li><a href="#">l</a></li>
                                                    <li><a href="#">xl</a></li>
                                                </ul>
                                            </div> --}}
                                            <h6 class="product-title">quantity</h6>
                                            <div class="qty-box">
                                                <div class="input-group"><span class="input-group-prepend"><button
                                                            class="btn quantity-left-minus" data-field=""
                                                            data-type="minus" type="button"><i aria-hidden="true"
                                                                class="fa fa-chevron-left"></i></button> </span>
                                                    <input class="form-control input-number" name="quantity" type="text"
                                                        value="1" wire:model.defer="qte"> <span
                                                        class="input-group-prepend"><button
                                                            class="btn quantity-right-plus" data-field=""
                                                            data-type="plus" type="button"><i aria-hidden="true"
                                                                class="fa fa-chevron-right"></i></button></span></div>
                                            </div>
                                        </div>
                                        <div class="product-buttons">
                                            <a class="btn btn-default primary-btn radius-0" wire:click="addToCart()">
                                                add to cart
                                                @isset($cart[$offer->offer_meta])
                                                <i aria-hidden="true" class="fa fa-check-circle-o" style="font-size: 20px;
                                                        margin-left: 12px;"></i>

                                                @endisset

                                            </a>
                                            <a class="btn btn-default primary-btn radius-0" href="#">
                                                buy now
                                            </a>
                                        </div>
                                        <div class="border-product">
                                            <h6 class="product-title">offer products</h6>

                                            @foreach ($offer->products as $product)
                                             <a href="/shop/product/{{ $product->product->product_meta }}"><h7> {{$product->qty}} x {{$product->product->title}}</h7></a>
                                             <br>
                                            @endforeach
                                          
                                            <h6 class="product-title">offer details</h6>
                                            <p>{{$offer->description}}</p>
                                        </div>
                                        <div class="border-product">
                                            <h6 class="product-title mb-2">share it</h6>
                                            <div class="product-icon">
                                                <ul class="product-social">
                                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                                </ul>
                                                <form class="d-inline-block">
                                                    <button class="wishlist-btn"><i class="fa fa-heart"></i><span
                                                            class="title-font">Add To WishList</span></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@section('js')

<script src="{{ URL::asset('index1/js/slider_func.js') }}"></script>
<script src="{{ URL::asset('index1/js/common_func.js') }}"></script>
<script src="{{ URL::asset('index1/js/jquery.flexslider.js') }}"></script>

<script src="{{ URL::asset('assets2/js/slick.js') }}"></script>

<script src="{{ URL::asset('assets2/js/sticky-kit.js') }}" type="text/javascript"></script>

<script src="{{ URL::asset('assets2/js/product.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function() {
        if ($(window).width() > 991) {
            $(".offer_img_scroll, .pro_sticky_info").stick_in_parent();
        }
    });
</script>
@endsection