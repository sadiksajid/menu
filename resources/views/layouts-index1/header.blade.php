<div>

<style>
    .main-menu > ul > li:hover > a {
        color: {{$store_info->text_color}}!important;
    }
</style>


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
                <img src="{{ url('storage/store_logo') }}/{{ $store_info->logo }}" height="70px" alt=""
                class="logo_normal">
                @else
                <img src="{{ URL::asset('index1/img/logo.svg') }}" width="140" height="35" alt=""
                class="logo_normal">
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
                            <h6 class=" text-white " id='cart_price' style='margin-left: 13px; font-size: 15px;float: right;margin-bottom: 2px;'>Bag</h6>

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
                            Login
                        </button>
                    @endif
          
            </li>
        </ul>
        <!-- /top_menu -->
        <a href="#0" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>
        <nav class="main-menu">
            <div id="header_menu">
                <a href="#0" class="open_close">
                    <i class="icon_close"></i><span>Menu</span>
                </a>
                @isset($store_info->logo)
                <img src="{{ url('storage/store_logo') }}/{{ $store_info->logo }}" width="60px"
                                        height="60px" class="header-brand-img desktop-lgo" alt="Appino logo">
                @else
                <a href="index.html"><img src="{{ URL::asset('index1/img/logo.svg') }}" width="140"
                    height="35" alt=""></a>
                @endisset
         
            </div>
            <ul>
         
                <li class="submenu">
                    <a href="/" >Home</a>
                </li>
                <li class="submenu">
                    <a href="/menu" >Menu</a>
                </li>
                <li class="submenu">
                    <a href="/shop" >Shop</a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- Search -->
    <div class="search-overlay-menu">
        <span class="search-overlay-close"><span class="closebt"><i class="icon_close"></i></span></span>
        <form role="search" id="searchform" method="get">
            <input value="" name="q" type="search" placeholder="Search..." />
            <button type="submit"><i class="icon_search"></i></button>
        </form>
    </div><!-- End Search -->




</header>
<!-- /header -->
</div>