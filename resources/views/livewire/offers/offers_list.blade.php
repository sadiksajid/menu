@section('css')
<style>
    .offer-box {
        box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
        border-radius: 20px !important;
        transition:0.5s
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

    .offers_image {
        background-color: #f0f0f0;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        overflow: hidden;
        height:35vh;
        border-radius: 20px 20px 10px 10px ;

    }



</style>
@endsection
<div>
    @php
        $cart = Session::get('my_cart');
    @endphp
   
    <div wire:ignore class="hero_single inner_pages background-image" @if (isset($images_offer)) data-background="url({{ get_image($images_offer)}})"  @else data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif
        style="position: relative  ;  " >

            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1  > {{ $titles_offer ?? 'Store' }}  </h1>
                            <p  >{{ $texts_offer ?? 'Cooking delicious and tasty food since 2005' }} </p>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>

        </div>
    </div>

    <div class="collection-wrapper" >
        <div class="container">
            <div class="row">
                <div class="collection-content col">
                    <div class="page-main-content">
                        <div class="row">
                            <div class="col-sm-12">
                 
                                <div class="collection-offer-wrapper mt-4">

                                    <div class="offer-wrapper-grid ">
                                        <div class="row">
                                        
                                            @foreach ($offers as $offer)
                                           
                                                <div class="col-xl-3 col-md-4 col-6 col-grid-box four"  style="padding-left:6px;padding-right:6px" >
                                                <a href="/shop/offer/{{ $offer->offer_meta }}">
                                                    <div class="offer-box">
                                                        <div class="img-wrapper">

                                                            <div class="front offers_image" style='background-image:url({{ get_image($offer->image_squad) }})'>
                                                         
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
                                                                        href="/shop/offer/{{ $offer->offer_meta }}">
                                                                        <h4 class='mb-3'>{{ substr($offer->title, 0, 40) }}</h4>
                                                                    </a>
                                                                    <!-- <p class="mt-2">
                                                                        {{ substr($offer->description, 0, 40) }}</p> -->
                                                                    <h5 class="mt-2 mb-2 " style='color:{{$store_info->btn_color}}'>
                                                                        <span class="badge badge-pill badge-dark">
                                                                            <del>
                                                                                {{ $offer->old_price }}
                                                                                {{ $currency }}
                                                                            </del>
                                                                        </span>

                                                                        <span class="badge badge-pill badge-warning text-dark">
                                                                            {{ $offer->price }}
                                                                            {{ $currency }}
                                                                        </span>
                                                                    </h5>
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
            window.livewire.offers = @json($offers)['data'];
            var path = @json(get_image('moyen'));
            var currency = @json($currency);
            var history = {};
            var history_image = {};
     
            window.addEventListener('putoffers', event => {
                window.livewire.offers = event.detail.offers;
                images = event.detail.images;
     
            });

            $(document).on('click', '#add_to_cart', function() {
                var id = $(this).attr("data-id");
                Livewire.emit('addToCart', id)

            });


        })
    </script>
@endsection
