<div>

<style>
    .main-menu > ul > li:hover > a {
        /* color: {{$store_info->text_color}}!important; */
    }
</style>
@php
$translations = app('translations')['system'];
@endphp

<div id="preloader" wire:ignore>
    <div data-loader="circle-side"></div>
</div><!-- /Page Preload -->
@if (!Auth::guard('client')->check())
@livewire('client-login')
@endif
<header class="header clearfix element_to_stick">
    <div class="container-fluid">
        <div id="logo">
            <a href="/">
                @isset($store_info->logo)
                <img src="{{ get_image($store_info->logo) }}" height="70px" alt=""
                class="logo_normal rounded-circle">
                @else
                <img src="{{ URL::asset('index1/img/logo.svg') }}" width="140" height="35" alt=""
                class="logo_normal rounded-circle">
                <img src="{{ URL::asset('index1/img/logo_sticky.svg') }}" width="140" height="35"
                    alt="" class="logo_sticky">
                @endisset
            
            </a>
        </div>
        <ul id="top_menu">
            <li><a href="#0" class="search-overlay-menu-btn"></a></li>
            <li style="margin-left:10px ">
                    <a href="#0" class="cart js-cart">
                        <button class="btn " style='  background-color: #262626;color: #fff;float: right'>
                            <img src="{{ URL::asset('assets/images/bag-white.png') }}" width="20px"
                            height="20px" alt="" style="    float: left;">
                            <h6 class=" text-white " id='cart_price' style='margin-left: 13px; font-size: 15px;float: right;margin-bottom: 2px;'>{{$translations['bag']}}</h6>

                        </button>

                    </a>

                    @if (Auth::guard('client')->check())
                        <a href="/client/my_orders" class="">
                            <button class="btn " style='  background-color: #262626;color: #fff;float: right; margin-right:20px'>
                                <img src="{{ URL::asset('assets/images/moto-white.png') }}" width="20px"
                                height="20px" alt="" style="    float: left;">
                                <h6 class=" text-white " id='orders_nbr' style='margin-left: 13px; font-size: 15px;float: right; margin-bottom: 2px;'></h6>

                            </button>
                        </a>

                    @else   
                        <button  class="btn login_show" style=' background-color:{{$store_info->text_color}};color: black;float: right; margin-right:20px;font-size:13px'>
                            <i class="fa fa-user"  style="margin-right: 5px;"></i>
                            {{$translations['login']}}
                        </button>
                    @endif
          
            </li>
        </ul>
        <!-- /top_menu -->
        <a href="#0" class="open_close">
            <i class="icon_menu"></i><span>{{$translations['menu']}}</span>
        </a>
        <nav class="main-menu">
            <div id="header_menu">
            
                <a href="#0" class="open_close">
                    <i class="icon_close"></i><span>{{$translations['menu']}}</span>
                </a>
                @isset($store_info->logo)
                <img src="{{ get_image($store_info->logo) }}" width="60px"
                                        height="60px" class="header-brand-img desktop-lgo rounded-circle" alt="Appino logo">
                @else
                <a href="index.html"><img src="{{ URL::asset('index1/img/logo.svg') }}" width="140"
                    height="35" alt=""></a>
                @endisset
         
            </div>
            <ul>
                <li class="submenu">
                    <a href="#" class='show_modal_language' ><img class="card-img-top" src="{{ asset('assets/countries/' . $flag[$current_lang] . '.svg') }}"
                        style="height: 20px" class="card-img-top" ></a>
                </li>
                <li class="submenu">
                    <a href="/" >{{$translations['home']}}</a>
                </li>
                <li class="submenu">
                    <a href="/menu" >{{$translations['menu']}}</a>
                </li>
                <li class="submenu">
                    <a href="/shop" >{{$translations['shop']}}</a>
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
            {{-- <div class="text-center modal-header bg-primary">
                    <h5 class="text-center modal-title m-0 text-white">Welcome to exxpress !</h5>
                </div> --}}
            <div class="modal-body pb-0">
                <div class="container text-center">
                    <lottie-player src="{{ URL::asset('assets/SVG/world.json') }}" class="lottie" background="transparent"
                        speed="0.5" loop autoplay mode="bounce" style="width: 250px;margin: auto;">
                    </lottie-player>
                    <h3>
                        Welcome To {{$store_info->title}}
                    </h3>
                    <p>Feel free to choose your language</p>

                    <div class="row px-md-5 mb-4 d-flex justify-content-center">
                        @foreach ($languages as $lang => $language)
                        <div class="col-md-4 col-4 mt-2" wire:click="changeLang('{{ $lang }}','{{url()->current()}}')" 
                            style="cursor: pointer">
                            <div class="card p-0" style="box-shadow: 3px 2px 13px -4px rgba(0,0,0,0.75); ">
                                <img class="card-img-top mt-2" src="{{ asset('assets/countries/' . $lang . '.svg') }}"
                                    style="height: 60px" class="card-img-top" alt="{{ $language }} flag">
                                <p class="card-text mt-2 p-0 fs-13" style="    font-weight: bold;color: #626262;">{{ $language }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn  mx-auto" aria-label="Close" class="close"
                    data-dismiss="modal" wire:click="changeLang('en')" style='  background-color: #262626;color: #fff;    width: 130px;'>
                    <span>Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

</div>
