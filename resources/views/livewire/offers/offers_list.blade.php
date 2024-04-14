@section('css')
<style>
    .offer-box {
        box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
    }

    .offer-box:hover {
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
   


    <div wire:ignore class="hero_single inner_pages background-image"
        @if (isset($images['img_1']))   data-background="get_image($images['img_1'])" @else data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif
        style="position: relative  ;  " >

            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1  > {{ $titles['title-1'] ?? 'Store' }}  </h1>
                            <p  >{{ $titles['title-2'] ?? 'Cooking delicious and tasty food since 2005' }} </p>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
            <div class="container-fluid p-0" style="position: absolute  ; bottom:0px;height:150px;z-index:10; ">

        </div>
    </div>

    <div class="collection-wrapper" >
        <div class="container">
            <div class="row">
                <div class="collection-content col">
                    <div class="page-main-content">
                        <div class="row">
                            <div class="col-sm-12">
                                {{-- <div class="top-banner-wrapper">
                                        <a href="#"><img alt="" class="img-fluid"
                                                         src="/assets2/images/inner-page/banner.jpg"></a>
                                     
                                    </div> --}}
                                <div class="collection-offer-wrapper mt-4">

                                    <div class="offer-wrapper-grid ">
                                        <div class="row">
                                        
                                            @foreach ($offers as $offer)
                                           
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box four"  style="padding-left:6px;padding-right:6px" >
                                                    <div class="offer-box ">
                                                        <div class="img-wrapper">

                                                            <div class="front">
                                                                <a
                                                                    href="/shop/offer/{{ $offer->offer_meta }}"><img
                                                                        alt="" class="img-fluid"
                                                                        src="{{ get_image($offer->image_squad) }}"></a>
                                                            </div>

                                                      
                                                        </div>
                                                        <div class="offer-detail pb-2 mt-1">
                                                            <div>
                                                                <center>
                                                                    <div class="rating"><i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i>
                                                                        <i class="fa fa-star"></i> <i
                                                                            class="fa fa-star"></i>
                                                                        (4.5)
                                                                    </div>
                                                                    <a class="mt-2"
                                                                        href="offer-page(no-sidebar).html">
                                                                        <h4>{{ substr($offer->title, 0, 40) }}</h4>
                                                                    </a>
                                                                    <p class="mt-2">
                                                                        {{ substr($offer->description, 0, 40) }}</p>
                                                                    <h5 class="mt-2 mb-2 " style='color:{{$store_info->btn_color}}'>
                                                                        <span class="badge badge-pill badge-danger">
                                                                            <del>
                                                                                {{ $offer->old_price }}
                                                                                {{ $currency }}
                                                                            </del>
                                                                        </span>

                                                                        <span class="badge badge-pill badge-success">
                                                                            {{ $offer->price }}
                                                                            {{ $currency }}
                                                                        </span>
                                                                    </h5>
                                                                </center>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="load-more-sec"><a wire:click="nextPage()">load
                                            more</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- section End -->

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
        $(document).ready(function() {
            Livewire.emit('setViewStore')

            changeTitle(@json($store_info)['title'])
            window.livewire.offers = @json($offers)['data'];
            var path = @json(get_image('moyen'));
            var currency = @json($currency);
            var history = {};
            var history_image = {};
            // window.addEventListener('popstate', function (event) {
            //     var current_path = getpath();
            //     window.livewire.offers = history[current_path]
            //     images = history_image[current_path]
            // });
            window.addEventListener('putoffers', event => {
                window.livewire.offers = event.detail.offers;
                images = event.detail.images;
                // var current_path = getpath();
                // history[event.detail.category] = window.livewire.offers ?? window.livewire.offers.data
                // history_image[event.detail.category] = images
            });
            // var current_path = getpath();
            // history[current_path] = window.livewire.offers ?? window.livewire.offers.data
            // history_image[current_path] = images
            $(document).on('click', '.showDetail', function() {
                var id = $(this).attr("data-id");
                console.log(window.livewire.offers);
                offer = window.livewire.offers[id] ?? window.livewire.offers.data[id]
                $("#detail_image").attr("src", path + '/' + images[id])
                $("#detail_title").html(offer['title'])
                $("#detail_price").html(offer['price'] + ' ' + currency)
                $("#detail_description").html(offer['description'])
                $("#add_to_cart").attr("data-id", offer['id']);
                $("#pop_up_url").attr("href", "/shop/offer/" + offer['offer_meta']);

                // detail_image
                // @this.set('quick_key', id);
                $('#quick-view-offer').modal('show');
                Livewire.emit('setViewoffer', offer['id']);
            });

            $(document).on('click', '#add_to_cart', function() {
                var id = $(this).attr("data-id");
                Livewire.emit('addToCart', id)

            });


        })
    </script>
@endsection
