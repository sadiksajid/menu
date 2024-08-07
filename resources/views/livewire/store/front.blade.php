@section('css')
<style>
    .product-box {
        box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
        border-radius: 20px !important;
        transition:0.5s

    }

    .product-box:hover {
        box-shadow: rgb(0, 0, 0,0.5) 0px 20px 30px -10px
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

    .img-wrapper{
        border-radius: 20px 20px 10px 10px ;

    }

    .products_image {
        background-color: #f0f0f0;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        overflow: hidden;
        height:35vh
    }
</style>
@endsection
<div>

    <div wire:ignore class="hero_single inner_pages background-image"
        @if (isset($images_shop))   data-background="url({{get_image($images_shop)}})" @else data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif
        style="position: relative  ;  " >

            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1  > {{ $titles_shop ?? $translations['store'] }}  </h1>
                            <p  >{{ $texts_shop ?? $translations_resto['store_meta']  }} </p>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
            <div class="container-fluid p-0" style="position: absolute  ; bottom:0px;height:150px;z-index:10; ">
            <div class="row">
                <div
                    style='width:100%;height:100%;
                    background: rgba(255, 255, 255, 0.2);
                    backdrop-filter: blur(5px);
                    position: absolute;mask: linear-gradient(transparent, black, black);right: 0px;'>

                </div>
                <div class=" col-md-12 client-box text-center p-0 " data-cue="slideInUp">
                    <center>
                        <div class="owl-carousel saas-brand owl-theme">
                            @foreach ($categories as $category)
                              <div style="height: 150px">
                                  {{-- <a href="/store/goodforhealth/{{ $category->category_meta }}" > --}}
                                    <a href="/shop/{{ $category->category_meta }}" >
                                        <div class=" item hover-overlay pt-2 cat_div background-image rounded-circle shadow border border-dark"
                                            data-background="url({{ get_image('tmb/'.$category->image )}})">
                                            <div class="over_cat">
                                                <h5  class="cat_titel align-self-center">
                                                    <strong>{{ $category->title }}</strong>
                                                </h5>
                                            </div>
                           
                                        </div>
                                    </a>
                              </div>
                            @endforeach

                        </div>

                    </center>
                </div>
            </div>
        </div>
    </div>

    <div class="collection-wrapper" >
        <div class="container">
            <div class="row">
                <div class="collection-content col">
                    <div class="page-main-content">
                        <div class="row">
                            <div class="col-sm-12">
        
                                <div class="collection-product-wrapper">

                                    <div class="product-wrapper-grid ">
                                        <div class="row">
                                            @php
                                                $products_images = [];
                                            @endphp
                                            @foreach ($products as $product)
                                                @php
                                                    $products_images[$loop->index] = $product?->media[0]->media ?? 'pngs/food-icon.jpg';
                                                @endphp
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box four"  style="padding-left:6px;padding-right:6px" >
                                                <a href="/shop/product/{{ $product->product_meta }}">

                                                    <div class="product-box ">
                                                        <div class="img-wrapper">

                                                            <div class="front products_image" style="background-image:url({{ get_image('moyen/'.$product->media[0]->media) }})">
                                                          
                                                            </div>
                                                            <div class="back products_image"  style="background-image:url({{ get_image('moyen/'.($product->media[1]->media ?? $product->media[0]->media)) }})">
                                               
                                                            </div>
                                                            <div class="cart-info cart-wrap gray-bg-color"
                                                                style='border-radius:8px'>
                                                                <a href="#" title="Add to cart"
                                                                    wire:click="addToCart({{ $product->id }},0)">

                                                                    @isset($cart[$product->product_meta])
                                                                        <i aria-hidden="true" class="fa fa-shopping-cart"
                                                                            style=" background-color: #ffd500;
                                                                    border-color: #343434;
                                                                    color: #343434;"></i>
                                                                    @else
                                                                        <i aria-hidden="true"
                                                                            class="fa fa-shopping-cart"></i>
                                                                    @endisset
                                                                </a>


                                                                <a title="Quick View" class='showDetail'
                                                                    data-id='{{ $loop->index }}'><i aria-hidden="true"
                                                                        class="fa fa-search"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="product-detail p-0">
                                                            <div>
                                                                <center>
                                                                    <div class="rating"><i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i>
                                                                        (4.5)
                                                                    </div>
                                                                    {{ $product->category->title }}
                                                                    <a class="mt-2"
                                                                        href="/shop/product/{{ $product->product_meta }}">
                                                                        <h4 class='mb-3'>{{ substr($product->title, 0, 40) }}</h4>
                                                                    </a>
                                                                    <p class="mt-2">
                                                                        {{ substr($product->description, 0, 40) }}</p>
                                                                    <!-- <h6 class="mt-2 " style='color:{{$store_info->btn_color}}'></h6> -->
                                                                    <button class='btn btn-warning btn-sm' style='width: 100%;margin-top: 7px;border-radius: 10px 10px 20px 20px;'><h4>{{ $product->price }}
                                                                    {{ $currency }}</h4></button>
                                                                </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="load-more-sec"><a >{{$translations['load_more'] }} <span wire:loading 
                                                style="height: 20px;width:20px;transition: 0.5s;margin-right: 10px;"
                                                class="spinner-border spinner-border-sm ml-3"></span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- section End -->

    <!-- Quick-view modal popup start-->
    <div wire:ignore aria-hidden="true" class="modal fade bd-example-modal-lg theme-modal" id="quick-view-product"
        role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content quick-view-modal">
                <div class="modal-body">
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                    <div class="row">
                        <div class="col-lg-6 col-xs-12">
                            <div class="quick-view-img"><img alt="" class="img-fluid" id='detail_image'
                                    src="#"></div>
                        </div>
                        <div class="col-lg-6 rtl-text">
                            <div class="product-right">
                                <h2 id='detail_title'>Women Pink Shirt</h2>
                                <h3 id='detail_price'>$32.96</h3>

                                <div class="border-product">
                                    <h6 class="product-title">{{$translations['product_details']}}</h6>
                                    <p id='detail_description'>Sed ut perspiciatis, unde omnis iste natus error sit
                                        voluptatem accusantium
                                        doloremque laudantium</p>
                                </div>
                                <div class="product-description border-product">
                       
                                    <h6 class="product-title">{{$translations['quantity']}}</h6>
                                    <div class="qty-box">
                                        <div class="input-group"><span class="input-group-prepend"><button
                                                    class="btn quantity-left-minus" data-field="" data-type="minus"
                                                    type="button"><i aria-hidden="true"
                                                        class="fa fa-chevron-left"></i></button> </span>
                                            <input class="form-control input-number" name="quantity" type="text"
                                                value="1" wire:model.defer="qte"> <span
                                                class="input-group-prepend"><button class="btn quantity-right-plus"
                                                    data-field="" data-type="plus" type="button"><i
                                                        aria-hidden="true"
                                                        class="fa fa-chevron-right"></i></button></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="product-buttons">
                                    <a class="btn btn-default primary-btn radius-0" href="#" id='add_to_cart'>
                                        {{$translations['add_to_cart']}} 
                                    </a>
                                    <a class="btn btn-default primary-btn radius-0" href="#"id='pop_up_url'>
                                        {{$translations['view_detail']}} 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 

</div>

@section('js')
    <script>

        
        // function getpath(){
        //     let currentPath = window.location.pathname;
        //     // Split the path by '/' and filter out empty segments
        //     let pathSegments = currentPath.split('/').filter(segment => segment.trim() !== '');
        //     // Get the last subpath
        //     let lastSubpath = pathSegments[pathSegments.length - 1];
        //     return lastSubpath ;
        // }
        // function isKeyInArray(array, key) {
        // return array.some(item => item.key === key);
        // }
        document.addEventListener("DOMContentLoaded", function() {
            const loadMoreSection = document.querySelector('.load-more-sec');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // The load-more-sec is in the viewport, run your function
                        Livewire.emit('nextPage')

                    }
                });
            }, { threshold: 0.1 }); // Adjust the threshold as needed

            observer.observe(loadMoreSection);
        });


        window.addEventListener('endPages', function (event) {
            $('.load-more-sec').html('')
        });

        $(document).ready(function() {
            Livewire.emit('setViewStore')

            changeTitle(@json($store_info)['title'])
            window.livewire.products = @json($products)['data'];
            var path = @json(get_image('moyen'));
            var currency = @json($currency);
            var images = @json($products_images);
            var history = {};
            var history_image = {};

            window.addEventListener('putProducts', event => {
                window.livewire.products = event.detail.products;
                images = event.detail.images;
                // var current_path = getpath();
                // history[event.detail.category] = window.livewire.products ?? window.livewire.products.data
                // history_image[event.detail.category] = images
            });
            // var current_path = getpath();
            // history[current_path] = window.livewire.products ?? window.livewire.products.data
            // history_image[current_path] = images
            $(document).on('click', '.showDetail', function() {
                var id = $(this).attr("data-id");
                product = window.livewire.products[id] ?? window.livewire.products.data[id]
                lang    = "{{app()->getLocale()}}"
                $("#detail_image").attr("src", path + '/' + images[id])
                $("#detail_title").html(product['title'][lang])
                $("#detail_price").html(product['price'] + ' ' + currency)
                $("#detail_description").html(product['description'][lang])
                $("#add_to_cart").attr("data-id", product['id']);
                $("#pop_up_url").attr("href", "/shop/product/" + product['product_meta']);

                // detail_image
                // @this.set('quick_key', id);
                $('#quick-view-product').modal('show');
                Livewire.emit('setViewProduct', product['id']);
            });

            $(document).on('click', '#add_to_cart', function() {
                var id = $(this).attr("data-id");
                Livewire.emit('addToCart', id)

            });


        })
    </script>
@endsection
