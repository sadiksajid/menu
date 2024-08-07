<div>

    <style>
    .main-menu>ul>li:hover>a {
        /* color: {{$store_info->text_color}}!important; */
    }

    .main-menu > ul > li > a {
        color:#262626!important;
    }
    .search-overlay-menu-btn {
        color:#262626!important;
    }


    .lang-image {
        height: 80px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }
    @media only screen and (max-width: 390px) {
    /* Your CSS styles here */
        .lang-image {
            height: 50px;

        }
    }
    </style>


    @isset($store_info->logo)

    <link rel="icon" id='site_icon' href="{{ str_replace('//','/',get_image($store_info->logo)) }}" type="image/x-icon">


    @else

    <link rel="icon" href="{{  URL::asset('index1/img/logo.svg') }}" type="image/x-icon" />

    @endisset



    @php
    $translations = app('translations')['system'];
    @endphp

    <div id="preloader" wire:ignore>
        <div data-loader="circle-side"></div>
    </div><!-- /Page Preload -->
    @if (!Auth::guard('client')->check())
    @livewire('client-login')
    @endif
    <header class="header clearfix  p-2" style='height: 48px;background-color: rgb(238, 238, 238, 0.9)'>
        <div class="container-fluid">
            <div id="logo">
                <a href="/">
                    @isset($store_info->logo)
                    <img src="{{ get_image($store_info->logo) }}" height="70px" alt=""
                        class="logo_normal rounded-circle">
                    @else
                    <img src="{{ URL::asset('index1/img/logo.svg') }}" width="140" height="35" alt=""
                        class="logo_normal rounded-circle">
                    <img src="{{ URL::asset('index1/img/logo_sticky.svg') }}" width="140" height="35" alt=""
                        class="logo_sticky">
                    @endisset

                </a>
            </div>
            <ul id="top_menu">
               
                <li><a href="#0" class="search-overlay-menu-btn"></a></li>
                <li style="margin-right: -5px; ">
                    <a href="#0" class="cart js-cart" wire:ignore>
                        <button class="btn " style='  background-color: #262626;color: #fff;float: right'>
                            <img src="{{ URL::asset('assets/images/bag-white.png') }}" width="20px" height="20px" alt=""
                                style="    float: left;">
                            <h6 class=" text-white " id='cart_price'
                                style='margin-left: 13px; font-size: 15px;float: right;margin-bottom: 2px;'>
                                {{$translations['bag']}}</h6>

                        </button>

                    </a>

                    @if (Auth::guard('client')->check())
                    <a href="/client/my_orders" class="" wire:ignore>
                        <button class="btn "
                            style='  background-color: #262626;color: #fff;float: right; margin-right:20px'>
                            <img src="{{ URL::asset('assets/images/moto-white.png') }}" width="20px" height="20px"
                                alt="" style="    float: left;">
                            <h6 class=" text-white " id='orders_nbr'
                                style='margin-left: 13px; font-size: 15px;float: right; margin-bottom: 2px;'></h6>

                        </button>
                    </a>

                    @else
                    <button class="btn login_show"
                        style=' background-color:{{$store_info->text_color}};color: black;float: right; margin-right:20px;font-size:13px'>
                        <i class="fa fa-user" style="margin-right: 5px;"></i>
                        {{$translations['login']}}
                    </button>
                    @endif

                </li>
            </ul>
            <!-- /top_menu -->
            <a href="#0" class="open_close text-dark">
                <i class="icon_menu"></i><span>x</span>
            </a>
            <nav class="main-menu"
                style='display: flex;-webkit-box-align: center;-ms-flex-align: center;align-items: flex-start;margin: 0;border: 0;flex-direction: column;'>
                <div id="header_menu" style=' background-color: transparent;color: black;width: 100%;padding: 10px;'>

                    <a href="#0" class="open_close">
                        <i class="icon_close"></i><span>x</span>
                    </a>

                    @isset($store_info->logo)
                    <img src="{{ get_image($store_info->logo) }}" width="60px" height="60px"
                        class="header-brand-img desktop-logo rounded-circle" alt="Appino logo"
                        style='border: 0px solid #3e3e3e; box-shadow: 0px 0px 10px 0px black; margin-top: 10px;margin-right: 20px;float: right;'>
                    @else
                    <a href="index.html"><img src="{{ URL::asset('index1/img/logo.svg') }}" width="140" height="35"
                            style='border: 0px solid #3e3e3e; box-shadow: 0px 0px 10px 0px black; margin-top: 10px;margin-right: 20px;float: right;'>
                        alt=""></a>
                    @endisset

                </div>
                <ul>
                    <li >
                        <a href="#" class='show_modal_language'><img class="card-img-top"
                                src="{{ asset('assets/countries/' . $flag[$current_lang] . '.svg') }}" style="height: 30px"
                                class="card-img-top"></a>
                    </li>
                    <li>
                        <a href="/">{{$translations['home']}}</a>
                    </li>
                    <li>
                        <a href="/menu">{{$translations['menu']}}</a>
                    </li>
                    <li>
                        <a href="/shop">{{$translations['shop']}}</a>
                    </li>
                    <li>
                        <a href="/shop/offers">{{$translations['offers']}}</a>
                    </li>
                    <li>
                        <a href="/contact_us">{{$translations['contact_us']}}</a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Search -->
        <div class="search-overlay-menu">
            <span class="search-overlay-close"><span class="closebt"><i class="icon_close"></i></span></span>
            <form role="search" id="searchform" method="get">
                <input value="" name="q" type="search" placeholder="{{$translations['search']}}..." />
                <button type="submit"><i class="icon_search"></i></button>
            </form>
        </div><!-- End Search -->




    </header>
    <!-- /header -->
    <div wire:ignore class="modal fade bd-example-modal-lg" id="select_modal_language" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border:5px solid #262626;background-color:#f7f8fc">
       
                <div class="modal-body pb-0">
                    <div class="container text-center">
                        <lottie-player src="{{ URL::asset('assets/SVG/world.json') }}" class="lottie"
                            background="transparent" speed="0.5" loop autoplay mode="bounce"
                            style="width: 250px;margin: auto;">
                        </lottie-player>
                        <h3>
                            Welcome To {{$store_info->title}}
                        </h3>
                        <p>Feel free to choose your language</p>

                        <div class="row px-md-5 mb-4 d-flex justify-content-center">
                            @foreach ($languages as $lang => $language)
                            <div class="col-md-4 col-4 mt-2 p-1"
                                wire:click="changeLang('{{ $lang }}','{{url()->current()}}')" style="cursor: pointer">
                                <div class="card p-0" style="box-shadow: 3px 2px 13px -4px rgba(0,0,0,0.75); ">
                                    <!-- <img class="card-img-top mt-2"
                                        src="" style="height: 60px"
                                        class="card-img-top" alt="{{ $language }} flag"> -->

                                    <div class='w-100 lang-image rounded-2' style="background-image:url({{ asset('assets/countries/' . $lang . '.svg') }})">

                                    </div>
                                    <p class="card-text mt-2 p-0 " style="    font-weight: bold;color: #626262;">
                                        {{ $language }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn  mx-auto" aria-label="Close" class="close" data-dismiss="modal"
                        wire:click="changeLang('en','{{url()->current()}}')"
                        style='background-color: #262626;color: #fff;width: 130px;'>
                        <span>Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>