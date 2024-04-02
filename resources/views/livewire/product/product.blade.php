@section('css')
<link href="{{ URL::asset('assets2/css/slick.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets2/css/slick-theme.css') }}" rel="stylesheet" type="text/css">
@endsection
<div>
    @php
    $cart = Cache::get('my_cart');
    @endphp
        <!-- section start -->

        <div wire:ignore class="hero_single inner_pages background-image" style="height:260px"
        @if (isset($product->media[0]->media ))   data-background="url({{ url(env('PATH_PRODUCTS')) }}/{{ $product->media[0]?->media  }})" @else data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif >
    
            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1  > {{ $product->title ?? 'Product' }}  </h1>
                            {{-- <p  >{{ $titles['title-2'] ?? 'Cooking delicious and tasty food since 2005' }} </p> --}}
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
        </div>


        <section class="p-b-0 ">
            <div class="collection-wrapper">
                <div class="container">
                    <div class="row data-sticky_parent">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="container-fluid">
                                <div class="row">
                                    @if(!testMobile())
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-12 product_img_scroll image-scroll" data-sticky_column>
                                                <div>
    
                                                    @foreach ($product->media as $media)
                                                    <div class="mb-2">
                                                        <img alt="" class="img-fluid"
                                                            src="{{ url(env('PATH_PRODUCTS')) }}/{{ $media->media  }}">
                                                    </div>
                                                    @endforeach
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    @else
                                    <div class="col-lg-6">
                                        <div class="product-slick">
                                            @foreach ($product->media as $media)
                                            <div>
                                                <img alt="" class="img-fluid"
                                                    src="{{ url(env('PATH_PRODUCTS')) }}/{{ $media->media  }}">
                                            </div>
                                            @endforeach

                                        </div>
                                        <div class="row">
                                            <div class="col-12 p-0">
                                                <div class="slider-nav">                                                 
                                                        @foreach ($product->media as $media)
                                                        <div>
                                                            <img alt="" class="img-fluid image_zoom_cls-0"
                                                                src="{{ url(env('PATH_PRODUCTS')) }}/{{ $media->media  }}">
                                                        </div>
                                                        @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
    
                                    <div class="col-lg-6 rtl-text" >
                                        <div class="product-right pro_sticky_info" data-sticky_column >
                                            <h2>{{$product->title}}</h2>
                                            <h3>{{$product->s_title}}</h3>
                                            <h4>
                                                <del>{{$product->price}} {{$currency}}</del>
                                                <span>55% off</span></h4>
                                            <h3>{{$product->price}} {{$currency}}</h3>
    
                                            <div class="product-description border-product">
    
                                                <div class="size-box">
                                                    <ul>
                                                        <li class="active"><a href="#">s</a></li>
                                                        <li><a href="#">m</a></li>
                                                        <li><a href="#">l</a></li>
                                                        <li><a href="#">xl</a></li>
                                                    </ul>
                                                </div>
                                                <h6 class="product-title">quantity</h6>
                                                <div class="qty-box">
                                                    <div class="input-group"><span class="input-group-prepend"><button
                                                                class="btn quantity-left-minus" data-field=""
                                                                data-type="minus" type="button"><i aria-hidden="true"
                                                                    class="fa fa-chevron-left"></i></button> </span>
                                                        <input class="form-control input-number" name="quantity" type="text"
                                                            value="1" wire:model.defer="qte"> <span class="input-group-prepend"><button
                                                                class="btn quantity-right-plus" data-field=""
                                                                data-type="plus" type="button"><i aria-hidden="true"
                                                                    class="fa fa-chevron-right"></i></button></span></div>
                                                </div>
                                            </div>
                                            <div class="product-buttons">
                                                <a class="btn btn-default primary-btn radius-0" wire:click="addToCart()">
                                                    add to cart 
                                                    @isset($cart[$product->product_meta])
                                                        <i aria-hidden="true" class="fa fa-check-circle-o" style="font-size: 20px;
                                                        margin-left: 12px;" ></i>
                                                            
                                                    @endisset
                                                  
                                                </a>
                                                <a class="btn btn-default primary-btn radius-0" href="#">
                                                    buy now
                                                </a>
                                            </div>
                                            <div class="border-product">
                                                <h6 class="product-title">product details</h6>
                                                <p>{{$product->description}}</p>
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
        <script src="{{ URL::asset('assets2/js/slick.js') }}"></script>
        
        <script src="{{ URL::asset('assets2/js/sticky-kit.js') }}" type="text/javascript"></script>
       
        <script src="{{ URL::asset('assets2/js/product.js') }}" type="text/javascript"></script>


        <script>
            $(document).ready(function() {
                if ($(window).width() > 991) {
                    $(".product_img_scroll, .pro_sticky_info").stick_in_parent();
                }
            });
        </script>
        @endsection