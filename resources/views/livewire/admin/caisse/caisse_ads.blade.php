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

    <style>
    .delete_bg_color {
        background-color: #eb6a6a;
        /* Optional: to reset default margin */
    }

    .collapse_div {
        background-color: white;
        width: 0px;
        height: 100vh;
        position: fixed;
        z-index: 99999;
        right: 0px;
        top: 0px;
        transition: 0.5s;
        overflow: auto;
    }

    .collapse_div_show {
        width: 450px !important;
        padding: 20px;

    }

    .collapse_div_hover {
        background-color: #000000;
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 9999;
        top: 0;
        left: 0;
        opacity: 0;
        transition: 0.5s;
    }


    .collapse_div_hover_opacity {
        opacity: 0.5 !important;
    }



    h3 {
        font: 25px sans-serif;
        text-align: center;
        text-transform: uppercase;
    }




    h3.no-background {
        position: relative;
        overflow: hidden;
    }

    .h2-span {
        display: inline-block;
        vertical-align: baseline;
        zoom: 1;
        *display: inline;
        *vertical-align: auto;
        position: relative;
        padding: 0 20px;

        &:before,
        &:after {
            content: '';
            display: block;
            width: 1000px;
            position: absolute;
            top: 0.73em;
            border-top: 1px solid black;
        }

        &:before {
            right: 100%;
        }

        &:after {
            left: 100%;
        }
    }
    </style>

    <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">
</head>

@php
use App\Models\StoreProduct;
use Symfony\Component\Intl\Currencies;

$store_info = Auth::user()->store ;
$products  = StoreProduct::where('store_id', Auth::user()->store_id)
            ->select('id','title','price','product_category_id')
            ->where('to_menu', 1)
            ->orderBy('id', 'DESC')
            ->get();

if (isset($store_info->currency)) {
    $currency = Currencies::getSymbol($store_info->currency);
} else {
    $currency = 'DH';
}
$categories = Cache::get('caisse_categories');

@endphp
<body class="app sidebar-mini sidenav-toggled">
    <!---Global-loader-->
    <div id="global-loader">
        <img src="{{ URL::asset('assets/images/svgs/loader.svg') }}" alt="loader">
    </div>
    <!--- End Global-loader-->
    <!-- Page -->
    <div class="page">
        <div class="page-main">
            <!-- App-Content -->
            <div class="app-content main-content ml-0">
                <div class="side-app p-3">
                    <div class="container-fluid">

                        <div class="row ">
                          
                            <div class="col-12" style="max-height: 88vh;overflow:auto">
                                
                             

                                    @foreach ( $categories as $category)
                                    <div class="row">
                                        @php
                                        if( $products != []){
                                        $products_cat = $products->where('product_category_id', $category["id"]) ;
                                        }else{
                                        $products_cat = [];
                                        }
                                        @endphp

                                        @if(count($products_cat) != 0)
                                        <div class="col-12">
                                            <h3 class="no-background"><span class='h2-span'>{{ $category['title_tr'] }}
                                                </span></h3>
                                        </div>
                                        @endif
                                        @foreach ( $products_cat as $product)

                                        <div class="col-xl-3  col-md-3" onclick="selectProd({{$product->id}})"
                                            style="cursor: pointer" data-id="{{$product->id}}">
                                            <div class="card overflow-hidden">
                                                <div
                                                    style="overflow: hidden;
                                                    width: 100%;
                                                    position:relative;">
                                                    <span class="badge badge-dark badge" role="button"
                                                        style="position: absolute; z-index:10;color:white;top:0px">
                                                        <h2 class="mb-0"><strong>{{ $product->price}} {{$currency}}</strong>
                                                        </h2>
                                                    </span>
                                                    <div
                                                        style="background-color:rgb(0,0,0,0.5);position: absolute; z-index:10;color:white;bottom:0px;width:100%;height:30%;display: flex;justify-content: center;align-items: center;padding: 5px 5px 5px 5px;">
                                                        <center>
                                                            <h6 class="card-title " style='font-size: 30px'>
                                                                {{$product->title }}</h6>
                                                        </center>
                                                    </div>
                                                    <img src="{{ get_image('tmb/'.$product->media[0]->media) }}"
                                                        lass="card-image1 " style='height: 100%;width: 100%;'
                                                        onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';">
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                        @endforeach
                                    @endforeach

                            </div>
                           
                        </div>
                    </div>
                </div>
                @include('admin.layouts_caisse.footer-scripts')
                <script src="owlcarousel/owl.carousel.min.js"></script>
                <script>
                    $(document).ready(function(){
                        $(".owl-carousel").owlCarousel({
                            items: 1, // Number of items to display
                            loop: true, // Infinite loop
                            margin: 10, // Space between items
                            autoplay: true, // Enable auto-play
                            autoplayTimeout: 3000, // Time between each auto scroll (3 seconds)
                            autoplaySpeed: 1000, // Auto scroll speed (1 second)
                            nav: true, // Enable next/prev buttons
                            dots: true // Enable pagination dots
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</body>

</html>