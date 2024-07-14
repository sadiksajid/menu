<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <!-- <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <meta content="GoodForHealth - Admin Panel" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="GoodForHealth" name="author">
    <meta name="keywords" content="admin panel GoodForHealth" />
    @include('admin.layouts_caisse.head')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <style>
    .prod_div {
        opacity: 0;
        transition: 0.6s;
    }

    .show_div {
        opacity: 1;
    }

    .products_list {
        height: 30vh;
        background-color: #f0f0f0;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border-radius:15px;
        border: 1px solid black;
        overflow: hidden;
    }

    .products_title {
        background-color: rgb(62 62 62 / 60%);
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
        border-radius:15px;   
     }
    </style>
</head>

@php
use App\Models\StoreProduct;
use App\Models\ProductCategory;
use Symfony\Component\Intl\Currencies;

$store_info = Auth::user()->store ;
$products = StoreProduct::where('store_id', Auth::user()->store_id)
->select('id','title','price','product_category_id','in_stock')
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

        <button id='full_screen_btn' onclick="openFullscreen()" class='btn btn-warning btn-md ' style='position:fixed;position: fixed;z-index: 99;color: black !important;border: 2px solid black;'>
        <i class="fa fa-arrows-alt" style="font-size:36px;"></i>

        </button>

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

                <div class="item products_list"
                    style='background-image: url({{ get_image("tmb/".$product->media[0]->media) }}); @if($product->in_stock == 0) ; opacity:0.4 @endif'>
                    <span class="badge badge-dark badge" role="button"
                        style="position: absolute; z-index:10;color:white;top:0px">
                        @if($product->in_stock == 0)
                        <h2 class="mb-0 text-danger" style='font-size: 1.5vw'>
                            <strong>
                                Out of Stock
                            </strong>
                        </h2>
                        @else
                        <h2 class="mb-0" style='font-size: 1.5vw'>
                            <strong>
                                {{ $product->price}} {{$currency}} 
                            </strong>
                        </h2>
                         @endif
                    </span>
                    <div class='products_title'>
                        <center>
                            <h6 class="card-title " style='font-size: 1vw'> {{$product->title }} </h6>
                        </center>
                    </div>
         
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
        <div class="modal-dialog modal-lg modal-dialog-centered" style='max-width: 70%;'>
            <div class="modal-content "
                style=' padding: 60px;padding-bottom: 20px; background-color:rgb(62 62 62 / 80%);border-radius: 30px;'>
                <div class='row products_div'>

                </div>
                <center>
                    <div class="card bg-warning">
                        <div class="card-body p-2">
                            <div class="no-block ">
                                <h1 class="text-fixed-white m-0 fw-bold"
                                    style=" margin-top: 5px !important;font-size: 50px;">Total : <span
                                        id='total'></span> </h1>
                                <div class="ms-auto" style="float: right"> <span
                                        class="text-fixed-white display-6"></span>
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

    </script>

    </script>
    <script>
    function getCachedData(key) {
        const cachedData = localStorage.getItem(key);
        return cachedData ? JSON.parse(cachedData) : null;
    }

    function cacheData(key, data) {
        localStorage.setItem(key, JSON.stringify(data));
    }

    function addProdToModal(data, qty, currency) {
        var productPrice = data['price'];
        var currency = currency;
        var productTitle = data['title'];
        var productImage = data['image'];

        // HTML block as a JavaScript variable with placeholders
        var productHTML = `
                        <div class="col-3 mb-8 prod_div " id="prod-${data['id']}">
                            <span class="badge badge-dark badge" role="button"
                                style="position: absolute; z-index:10;color:white;top:0px;">
                                <h2 class="mb-0" style='font-size: 1.5vw;' ><strong> <span id='qty-${data['id']}' style='color: #ffab00'>${qty}</span> x ${productPrice} ${currency}</strong></h2>
                            </span>


                            <img src="${productImage}" class="card-image1"
                                style="width: 100%; border-radius: 10px 10px 0 0;"
                                onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';">

                            <div style="overflow:hidden;background-color:rgba(0,0,0,0.6);color:white;bottom:0px;width:100%;height:30%;display: flex;justify-content: center;align-items: center;padding: 5px 5px 5px 5px;border-radius: 0 0 10px 10px ;">
                                <center>
                                    <h6 class="card-title" style="font-size: 1vw">${productTitle}</h6>
                                </center>
                            </div>
                        </div>
                    `;

        $('.products_div').append(productHTML);


        setTimeout(function() {
            $('.prod_div').each(function() {
                if (!$(this).hasClass('show_div')) {
                    $(this).addClass('show_div');
                }
            });
        }, 500);


    }

    function areObjectsDifferent(obj1, obj2) {
        return JSON.stringify(obj1) !== JSON.stringify(obj2);
    }



    function findDifferent(old_qty, new_qty) {
        $.each(old_qty, function(key, val) {
            if (new_qty.hasOwnProperty(key)) {
                if (new_qty[key] != val) {
                    $('#qty-' + key).html(new_qty[key])
                }
            } else {
                $('#prod-' + key).removeClass('show_div');
                setTimeout(function() {
                    $('#prod-' + key).remove();
                }, 700);
            }
        })
    }



    $(document).ready(function() {
        var data
        var prods = {}
        var qty = {}

        setInterval(() => {
            data = getCachedData('CaiseSelectedProducts')
            finish = getCachedData('CaiseFinishOrder')
            refresh = getCachedData('CaiseRefresh')
            if(refresh == true){
                location.reload(true);
                cacheData('CaiseRefresh', false)
            }

            if (data != null) {
                if (data['total'] == 0) {
                    $(".modal-order").modal('hide')
                    $('.products_div').html('')
                    prods = {}
                } else {

                    $.each(data['data'], function(key, row) {
                        if (!prods.hasOwnProperty(key)) {
                            prods[key] = row;
                            addProdToModal(row, data['qty'][key], data['currency'])
                        }


                        if (areObjectsDifferent(qty, data['qty'])) {
                            findDifferent(qty, data['qty'])
                        }
                        // else {
                        //     console.log('Objects are the same.');
                        // }


                        qty = data['qty'];


                    });

                    $("#total").html(data['total'] + ' ' + data['currency'])
                    $(".modal-order").modal('show')

                }
            } else {
                $(".modal-order").modal('hide')
                $('.products_div').html('')
                prods = {}
            }

            if (finish == true) {

                let timerInterval;
                Swal.fire({
                    title: "Order Submitted Successfully &#128512; ",
                    text: "Please wait to prepare your order.",
                    icon: "success",
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                        const timer = Swal.getPopup().querySelector("b");

                    },
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */

                });


                cacheData('CaiseFinishOrder', false)

            }
        }, 500);




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


        document.addEventListener("fullscreenchange", onFullscreenChange);
        document.addEventListener("webkitfullscreenchange", onFullscreenChange);
        document.addEventListener("mozfullscreenchange", onFullscreenChange);
        document.addEventListener("MSFullscreenChange", onFullscreenChange);

        function onFullscreenChange() {
            if (document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement) {
                $('#full_screen_btn').addClass('d-none')
            } else {
                $('#full_screen_btn').removeClass('d-none')
            }
        }



        /* View in fullscreen */
    

        setTimeout(() => {
            document.getElementById('full_screen_btn').click();
        }, 4000);



        
    });


    function openFullscreen() {
        var elem = document.documentElement;

    if (elem.requestFullscreen) {
        elem.requestFullscreen();
    } else if (elem.webkitRequestFullscreen) { /* Safari */
        elem.webkitRequestFullscreen();
    } else if (elem.msRequestFullscreen) { /* IE11 */
        elem.msRequestFullscreen();
    }
    }

    </script>
</body>

</html>