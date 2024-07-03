<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="GoodForHealth - Admin Panel" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="GoodForHealth" name="author">
    <meta name="keywords" content="admin panel GoodForHealth" />
    @include('admin.layouts_caisse.head')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
</head>

@php
use App\Models\StoreProduct;
use App\Models\ProductCategory;
use Symfony\Component\Intl\Currencies;

$store_info = Auth::user()->store ;
$products = StoreProduct::where('store_id', Auth::user()->store_id)
->select('id','title','price','product_category_id')
->where('to_menu', 1)
->orderBy('id', 'DESC')
->get();

if (isset($store_info->currency)) {
$currency = Currencies::getSymbol($store_info->currency);
} else {
$currency = 'DH';
}
if (Cache::has('caisse_categories')) {
$categories = Cache::get('caisse_categories');
} else {
$currentLocale = app()->getLocale();
$categories = ProductCategory::where('store_id', Auth::user()->store_id)
->select('*','title->' . $currentLocale.' as title_tr')
->orderBy('sort','asc')
->get()->toArray();

Cache::put('caisse_categories', $categories, 86400);
}

@endphp

<body class="app sidebar-mini sidenav-toggled">

    <div class="container-fluid">

        <div class="home-demo">

            @php
            $itms = 0 ;
            $row = 1 ;
            $x = 1 ;
            @endphp

            @foreach ( $categories as $category)
            @if($itms == 0 and $row == 1)
            <div class="owl-carousel owl-theme mt-5">
                @php
                $row = 0 ;
                $x++ ;
                if($x >3){
                $x = 1 ;
                }
                @endphp
                @endif

                @php


                if( $products != []){
                $products_cat = $products->where('product_category_id', $category["id"]) ;
                }else{
                $products_cat = [];
                }

                $itms = $itms + count( $products_cat );

                if($itms >= 7){
                $row = 1 ;
                $itms = 0 ;

                }


                @endphp




                @foreach ( $products_cat as $product)

                <div class="item" style=' background: #ff3f4d;'>
                    <span class="badge badge-dark badge" role="button"
                        style="position: absolute; z-index:10;color:white;top:0px">
                        <h2 class="mb-0"><strong>{{ $product->price}} {{$currency}}</strong>
                        </h2>
                    </span>
                    <div
                        style="background-color:rgb(0,0,0,0.5);position: absolute; z-index:10;color:white;bottom:0px;width:100%;height:30%;display: flex;justify-content: center;align-items: center;padding: 5px 5px 5px 5px;">
                        <center>
                            <h6 class="card-title " style='font-size: 25px'>
                                {{$product->title }}</h6>
                        </center>
                    </div>
                    <img src="{{ get_image('tmb/'.$product->media[0]->media) }}" lass="card-image1 "
                        style='height: 100%;width: 100%;'
                        onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';">
                </div>


                @endforeach

                @if($row == 1)
            </div>
            @endif



            @endforeach

            @if($itms < 7 and $itms> 0)
        </div>

        @endif

    </div>

    </div>


    <div class="modal fade modal-order" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" style='    max-width: 70%;'>
            <div class="modal-content " style=' padding: 60px;padding-bottom: 20px; background-color: rgba(255,255,255,0.9);border-radius: 30px;'>
                <div class='row products_div'>

                </div>
           <center>
           <div class="card bg-warning" style=' width: 50%;'>
                    <div class="card-body p-2" >
                        <div class="no-block ">
                                <h1 class="text-fixed-white m-0 fw-bold"
                                    style=" margin-top: 5px !important;font-size: 50px;">Total : <span id='total'></span> </h1>
                            <div class="ms-auto" style="float: right"> <span class="text-fixed-white display-6"></span>
                            </div>
                        </div>
                    </div>
                </div>
           </center>
            </div>
        </div>
    </div>
    @include('admin.layouts_caisse.footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    // <script src="{{ URL::asset('dist/CacheManage.js') }}">
    </script>

    </script>
    <script>
    function getCachedData(key) {
        const cachedData = localStorage.getItem(key);
        return cachedData ? JSON.parse(cachedData) : null;
    }

    function addProdToModal(data, qty, currency) {
        var productPrice = data['price'];
        var currency = currency;
        var productTitle = data['title'];
        var productImage = data['iamge'];

        // HTML block as a JavaScript variable with placeholders
        var productHTML = `
                        <div class="col-3 mb-8"  >
                            <span class="badge badge-dark badge" role="button"
                                style="position: absolute; z-index:10;color:white;top:0px">
                                <h2 class="mb-0"><strong> ${qty} x ${productPrice} ${currency}</strong></h2>
                            </span>
                  
                            
                            <img src="${productImage}" class="card-image1"
                                style="width: 100%;border-radius: 10px;"
                                onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';">

                            <div style="background-color:rgba(0,0,0,0.6);color:white;bottom:0px;width:100%;height:30%;display: flex;justify-content: center;align-items: center;padding: 5px 5px 5px 5px;border-radius: 0 0 10px 10px ;">
                                <center>
                                    <h6 class="card-title" style="font-size: 25px">${productTitle}</h6>
                                </center>
                            </div>
                        </div>
                    `;

        $('.products_div').append(productHTML);


    }

    function areObjectsDifferent(obj1, obj2) {
        return JSON.stringify(obj1) !== JSON.stringify(obj2);
    }




    $(document).ready(function() {
        var data
        var prods = {}
        var qty 

        setInterval(() => {
            data = getCachedData('CaiseSelectedProducts')
            if (data != null) {
                if (data['total'] == 0) {
                    $(".modal-order").modal('hide')
                    $('.products_div').html('')
                    prods = {}
                } else {

                    $.each(data['data'], function(key, row) {
                        if (!prods.hasOwnProperty(key)) {
                            console.log(prods)
                            prods[key] = row;
                            addProdToModal(row, data['qty'][key], data['currency'])
                        }

                        if (areObjectsDifferent(qty, data['qty'])) {
                            console.log('Objects are different.');
                        } else {
                            console.log('Objects are the same.');
                        }
                        qty = data['qty'] ;


                    });
                    
                    $("#total").html(data['total']+' '+data['currency'])
                    $(".modal-order").modal('show')

                }
            } else {
                $(".modal-order").modal('hide')
                $('.products_div').html('')
                prods = {}
            }
        }, 1000);




        var x = 1;

        $('.owl-carousel').each(function() {
            if (x == 1) {
                $(this).owlCarousel({
                    center: true,
                    items: 5,
                    loop: true,
                    margin: 20,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    slideTransition: 'linear',
                    autoplayTimeout: 4000,
                    autoplaySpeed: 4000,

                });
            } else if (x == 2) {
                $(this).owlCarousel({
                    center: true,
                    items: 5,
                    loop: true,
                    margin: 20,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    slideTransition: 'linear',
                    autoplayTimeout: 3000,
                    autoplaySpeed: 6000,

                });
            } else if (x == 3) {
                $(this).owlCarousel({
                    center: true,
                    items: 5,
                    loop: true,
                    margin: 20,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    slideTransition: 'linear',
                    autoplayTimeout: 6000,
                    autoplaySpeed: 6000,

                });
            }
            x = x + 1;
            if (x > 3) {
                x = 1;
            }

        });



        $(".owl-carousel2").owlCarousel({
            rtl: true,
            center: true,
            items: 5,
            loop: true,
            margin: 20,
            nav: false,
            dots: false,
            autoplay: true,
            slideTransition: 'linear',
            autoplayTimeout: 1000,
            autoplaySpeed: 10000,
            // autoplayHoverPause: true,

        });
        $(".owl-carousel3").owlCarousel({
            rtl: true,
            center: true,
            items: 5,
            loop: true,
            margin: 20,
            nav: false,
            dots: false,
            autoplay: true,
            slideTransition: 'linear',
            autoplayTimeout: 6000,
            autoplaySpeed: 10000,
            // autoplayHoverPause: true,

        });


    });
    </script>
</body>

</html>