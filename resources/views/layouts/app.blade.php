<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Unice" name="description">
    <meta content="Unice" name="keywords">
    <meta content="Unice" name="author">

    <title>Unice</title>
    @include('layouts.head')

</head>
<!--loader start-->
<div class="loader-wrapper">
    <div class="loader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<header>
    {{-- <section class="saas1 client brand-slider p-3" id="client-box">

        <div class="container-fluid p-0">
            <div class="row">
                <div class=" col-md-12 client-box text-center">
                    <center id='cart_budy'>

          
                    </center>
                </div>
            </div>
        </div>
    </section> --}}
</header>

<style>
    .btn-icon {
        width: 40px;
        height: 40px;
        color: white;
        background-color: #ee042c !important;
        border-radius: 30px;
        float: left;
        margin-right: 10px;
    }
</style>

<body>
    @livewire('cart')

    <main>
        <div class="nav py-2 gray-bg-color text-white">
            <div class="container">
                <div class="row">

                    <div class="col-md-8">
                        @isset($store_info->logo)
                            <div class="row">
                                <div class="col-2">
                                    <img src="{{ get_image($store_info->logo) }}" width="60px"
                                        height="60px" class="header-brand-img desktop-lgo" alt="Appino logo">
                                </div>
                                <div class="col-3 mt-2">


                                    <button class='btn-icon'><i aria-hidden="true" class="fa fa-phone"></i></button>
                                    <h4 class="font-weight-bold ml-1 mt-2" style='color:white'>{{ $store_info->phone }}</h4>

                                </div>
                                @if ($store_info->phone2 != null)
                                    <div class="col-3 mt-2">

                                        <button class='btn-icon'><i aria-hidden="true" class="fa fa-phone"></i></button>
                                        <h4 class="font-weight-bold ml-1 mt-2" style='color:white'>{{ $store_info->phone2 }}
                                        </h4>

                                    </div>
                                @endif
                                @if ($store_info->email != null)
                                    <div class="col-4 mt-2">

                                        <button class='btn-icon'><i aria-hidden="true"
                                                class="fa fa-envelope-o"></i></button>
                                        <h5 class="font-weight-bold ml-1 mt-2" style='color:white'>{{ $store_info->email }}
                                        </h5>

                                    </div>
                                @endif
                            </div>
                            <hr>
                        @endisset
                    </div>
                    <div class="col-md-4 col-12 mt-2">
                        <a href="#" class="cart js-cart">
                            <div style="float: right">
                                <center>
                                    <img src="{{ URL::asset('assets/images/bag-white.png') }}" width="40px"
                                        height="40px" alt="">
                                    <br>
                                    <h6 class=" text-white " id='cart_price' style='margin-top: 3px;'>Cart</h6>
                                </center>
                            </div>

                        </a>
                        <a href="#">
                            <div style="float: right; margin-right:20px">
                                <center>
                                    <a href="/client/my_orders">
                                        <img src="{{ URL::asset('assets/images/moto-white.png') }}" width="40px"
                                            height="40px" alt="">
                                        <br>
                                        <h6 class=" text-white " id='orders_nbr' style='margin-top: 3px;'>Orders</h6>
                                    </a>
                                </center>
                            </div>

                        </a>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </main>

</body>

<!-- footer start -->
<footer class="resume copyright copyright-bg inner-pages-footer gray-bg-color">
    <div class="container">
        <div class="row">
            @isset($store_info->logo)
                <div class="col-12">
                    <div class="link link-horizontal  text-center mb-3">
                        <img src="{{ get_image($store_info->logo) }}" width="60px" height="60px"
                            class="header-brand-img desktop-lgo" alt="Appino logo">
                    </div>
                </div>
                <div class="col-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d284.8437868179177!2d-9.5674610137939!3d30.418516779962!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb3b7da202c3d19%3A0x66f3af64e85870ab!2zOUNWWCtWTVjYjCDYo9qv2KfYr9mK2LEgODAwMDA!5e1!3m2!1sar!2sma!4v1707651565793!5m2!1sar!2sma"
                        width="100%" height="600"
                        style="    border: 4px solid #ee042c;
                    border-radius: 40px;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                </div>
            @endisset
            <div class="col-12">
                <div class="text-center">
                    <div class="social-link link-horizontal">
                        <ul class="justify-content-center">
                            <li><a class="copyright-text" href="#"><i aria-hidden="true" class="fa fa-facebook"
                                        style='color: #ee042c;'></i></a>
                            </li>
                            <li><a class="copyright-text" href="#"><i aria-hidden="true" class="fa fa-twitter"
                                        style='color: #ee042c;'></i></a>
                            </li>

                            <li><a class="copyright-text " href="#"><i aria-hidden="true" class="fa fa-instagram"
                                        style='color: #ee042c;'></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->

<!-- copyright start -->
<div class="agency copyright inner-page">
    <div class="container">
        <div class="row">

            <div class="col-12">
                <div>
                    <h6 class="copyright-text text-white text-end">Copyright ©2024 by <i aria-hidden="true"
                            class="fa fa-heart"></i>
                        sadik sajid</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tap on Top-->
<div class="tap-top">
    <div><i class="fa fa-angle-double-up"></i></div>
</div>
<!-- Tap on Ends-->
</div>

<!-- latest jquery-->
@include('layouts.scripts')

</html>
