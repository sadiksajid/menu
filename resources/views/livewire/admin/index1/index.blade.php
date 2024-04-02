<div>
    <div id="preloader" wire:ignore>
        <div data-loader="circle-side"></div>
    </div><!-- /Page Preload -->

    
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

    <main>
        <div class="header-video edit-image" >
            <button class="edit-button-image"  data-cue="slideInUp"  data-id='img_1' style='top: 50%;font-size: 180%;'><i class="fa fa-upload"></i></button>
            <div id="hero_video"
                @if (isset($images['img_1'])) style='background-image:url({{ url('storage/index1/' . $images['img_1']) }})' @endif>
                <div wire:ignore class="opacity-mask d-flex align-items-center  img_1" 
                    data-opacity-mask="rgba(0, 0, 0, 0.6)">
                    <div class="container">
                        <div class="row justify-content-center text-center">
                            <div class="col-xl-8 col-lg-10 col-md-8 mt-2">
                                <h1 class='edit-title' data-id='title-1'>
                                    {{ $titles['title-1'] ?? 'Taste Unique Food' }}</h1>
                                <p class='edit-title' data-id='title-2'>
                                    {{ $titles['title-2'] ?? 'Delicious food since 2005' }}</p>
                                <a data-id='btn-1' class="btn_1 edit-btn"
                                    href="{{ $buttons['btn-1']['url'] ?? '#menu-1.html' }}">{{ $buttons['btn-1']['title'] ?? 'Read more' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="{{ url('storage/index1/' . $images['img_1']) }}"
                data-video-src="{{ URL::asset('index1/video/intro') }}" class="header-video--media"
                data-teaser-source="{{ URL::asset('index1/video/intro') }}" data-provider="" data-video-width="1920"
                data-video-height="960">
        </div>
        <!-- /header-video -->

        <ul id="banners_grid" class="clearfix">
            <li class="edit-image">
                <a  @if (isset($urls['url_1'])) 
                        href="{{$urls['url_1']}}"
                    @else 
                        href="menu-1.html"
                    @endif
             class="img_container edit-url " data-id='url_1'>
                    
                    <img  @if (isset($images['img_2'])) 
                        src="{{ url('storage/index1/' . $images['img_2']) }}" 
                        data-src="{{ url('storage/index1/' . $images['img_2']) }}" 
                    @else 
                        src="{{ URL::asset('index1/img/banners_cat_placeholder.jpg') }}"  
                        data-src="{{ URL::asset('index1/img/banner_1.jpg') }}"
                    @endif

                        alt="" class="lazy">

                        <button class="edit-button-image"  data-cue="slideInUp"  data-id='img_2' style='top: 10%;font-size: 180%;'><i class="fa fa-upload"></i></button>

                    <div wire:ignore class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3 class='edit-title' data-id='title-3'> {{ $titles['title-3'] ?? 'Our Menu' }} </h3>
                        <p class='edit-title' data-id='title-4'>
                            {{ $titles['title-4'] ?? 'View Our Specialites' }} </p>
                    </div>
                </a>
            </li>
            <li class="edit-image">
                <a  @if (isset($urls['url_2'])) 
                        href="{{$urls['url_2']}}"
                    @else 
                        href="menu-1.html"
                    @endif
                    class="img_container edit-url " data-id='url_2'>
                    <img  @if (isset($images['img_3'])) 
                        src="{{ url('storage/index1/' . $images['img_3']) }}" 
                        data-src="{{ url('storage/index1/' . $images['img_3']) }}" 
                    @else 
                        src="{{ URL::asset('index1/img/banners_cat_placeholder.jpg') }}"  
                        data-src="{{ URL::asset('index1/img/banner_1.jpg') }}"
                    @endif alt="" class="lazy">

                    <button class="edit-button-image"  data-cue="slideInUp"  data-id='img_3' style='top: 10%;font-size: 180%;'><i class="fa fa-upload"></i></button>


                    <div wire:ignore class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">

                        <h3 class='edit-title' data-id='title-5'> {{ $titles['title-5'] ?? 'Delivery' }} </h3>
                        <p class='edit-title' data-id='title-6'>
                            {{ $titles['title-6'] ?? 'Home delivery or take away food' }} 
                        </p>

                    </div>
                </a>
            </li>
            <li class="edit-image">
                <a  @if (isset($urls['url_3'])) 
                        href="{{$urls['url_3']}}"
                    @else 
                        href="menu-1.html"
                    @endif
                    class="img_container edit-url " data-id='url_3'>
                    <img  @if (isset($images['img_4'])) 
                        src="{{ url('storage/index1/' . $images['img_4']) }}" 
                        data-src="{{ url('storage/index1/' . $images['img_4']) }}" 
                    @else 
                        src="{{ URL::asset('index1/img/banners_cat_placeholder.jpg') }}"  
                        data-src="{{ URL::asset('index1/img/banner_1.jpg') }}"
                    @endif alt="" class="lazy">
                    <button class="edit-button-image"  data-cue="slideInUp"  data-id='img_4' style='top: 10%;font-size: 180%;'><i class="fa fa-upload"></i></button>

                    <div wire:ignore class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">

                        <h3 class='edit-title' data-id='title-7'> {{ $titles['title-7'] ?? 'Inside Foores' }} </h3>
                        <p class='edit-title' data-id='title-8'>
                            {{ $titles['title-8'] ?? 'View the Gallery' }} 
                        </p>
                    </div>
                </a>
            </li>
        </ul>

        <div class="pattern_2">
            <div class="container margin_120_100 home_intro">
                <div class="row justify-content-center d-flex align-items-center">
                    <div class="col-lg-5 text-lg-center d-none d-lg-block " data-cue="slideInUp">
                        <figure class="edit-image">
                            <img

                                @if (isset($images['img_5'])) 
                                    src="{{ url('storage/index1/' . $images['img_5']) }}" 

                                    data-src="{{ url('storage/index1/' . $images['img_5']) }}" 
                                @else 
                                     src="{{ URL::asset('index1/img/home_1_placeholder.png') }}"

                                    data-src="{{ URL::asset('index1/img/home_1.jpg') }}" 
                                @endif 
                                width="354" height="440"
                                alt="" class="img-fluid lazy">
                                <button class="edit-button-image"  data-cue="slideInUp"  data-id='img_5' style='top: 50%;font-size: 180%;'><i class="fa fa-upload"></i></button>

                            <a  @if (isset($urls['url_4'])) 
                                 href="{{$urls['url_4']}}"
                                @else 
                                    href="https://www.youtube.com/watch?v=MO7Hi_kBBBg"
                                @endif
                                     data-id='url_4'
                        
                                class="btn_play  edit-url" data-cue="zoomIn"
                                data-delay="500"><span class="pulse_bt"><i
                                        class="arrow_triangle-right"></i></span></a>
                        </figure>
                    </div>
                    <div class="col-lg-5 pt-lg-4" data-cue="slideInUp" data-delay="500">
                        <div class="main_title">
                            <span><em></em></span>
                            <h2 class='edit-title' data-id='title-9' >{{ $titles['title-9'] ?? 'Some words about us' }}</h2>
                            <p class='edit-title' data-id='title-16' >{{ $titles['title-16'] ?? 'Cum doctus civibus efficiantur in imperdiet deterruisset.' }}</p>
                        </div>
                        <div class='edit-text' data-id='text-1'>
                            <p >
                                {!! $texts['text-1'] ?? 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
    
                                nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                officia deserunt mollit anim id est laborum.
                                <br>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                ullamco laboris nisi ut aliquip ex ea commodo consequat' !!}
                            </p>
                        </div>
                       
                        <p><img src="{{ URL::asset('index1/img/signature.png') }}" width="140" height="50"
                                alt="" class="mt-3"></p>
                    </div>
                </div>
                <!--/row -->
            </div>
            <!--/container -->
        </div>
        <!--/pattern_2 -->

        <div class="bg_gray">
            <div class="container margin_120_100" data-cue="slideInUp">
                <div class="main_title center mb-5">
                    <span><em></em></span>
                    <h2 class='edit-title' data-id='title-10' >{{ $titles['title-10'] ?? 'Our Daily Menu' }}</h2>

                </div>
                <!-- /main_title -->
                <div class="banner lazy  edit-image" 
                
                @if (isset($images['img_6'])) 
                    data-bg="url({{ url('storage/index1/' . $images['img_6']) }})" 
                @else 
                    data-bg="url({{ URL::asset('index1/img/banner_bg.jpg') }})"
                @endif                 
                >
                <button class="edit-button-image"  data-cue="slideInUp"  data-id='img_6' style='top: 50%;font-size: 180%;'><i class="fa fa-upload"></i></button>

                    <div wire:ignore class="wrapper d-flex align-items-center justify-content-between opacity-mask"
                        data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div>
                            <small class='edit-title' data-id='title-11'>{{ $titles['title-11'] ?? ' Special Offer' }}</small>
                            <h3 class='edit-title' data-id='title-12'>{{ $titles['title-12'] ?? ' Burgher Menu $18 only' }}</h3>
                            <p class='edit-title' data-id='title-13'>{{ $titles['title-13'] ?? ' Hamburgher, Chips, Mix Sausages, Beer, Muffin' }}</p>

                            <a data-id='btn-2' class="btn_1 edit-btn"
                                    href="{{ $buttons['btn-2']['url'] ?? '#reservations.html' }}">{{ $buttons['btn-2']['title'] ?? 'Reserve now' }}</a>


                        </div>
                        <figure class="d-none d-lg-block"><img src="{{ URL::asset('index1/img/banner.svg') }}"
                                alt="" width="200" height="200" class="img-fluid"></figure>
                    </div>
                    <!-- /wrapper -->
                </div>
                <!-- /banner -->
                <div class="row magnific-gallery homepage add_bottom_25">
                    @foreach ( $products as $product)
                        <div class="col-lg-6" data-cue="slideInUp">
                            <div class="menu_item">
                                <figure>
                                    <a href="{{ url(env('PATH_PRODUCTS')) }}/{{ $product->media[0]->media }}" title="Summer Berry"
                                        data-effect="mfp-zoom-in">
                                        
                                        <img src="{{ URL::asset('index1/img/menu_items/menu_items_placeholder.png') }}"
                                            data-src="{{ url(env('PATH_PRODUCTS')) }}/{{ $product->media[0]->media }}" class="lazy"
                                            alt="">
                                    </a>
                                </figure>
                                <div class="menu_title">
                                    <h3>{{ $product->title}}</h3><em>{{ $product->price}} {{ $currency }}</em>
                                </div>
                                <p>{{ substr($product->description, 0, 40) }}</p>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
                <!-- /row -->
                <p class="text-center"><a href="#0" class="btn_1 outline" data-cue="zoomIn">Download
                        Menu</a></p>
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_gray -->


        <div class="call_section lazy edit-image" 
            @if (isset($images['img_7'])) 
            style="position: relative; background-image:url({{ url('storage/index1/' . $images['img_7']) }})"     
                data-bg="url({{ url('storage/index1/' . $images['img_7']) }})" 
            @else 
                style="position: relative"     
                data-bg="url({{ URL::asset('index1/img/bg_call_section.jpg') }})"
            @endif  
            >
            <button class="edit-button-image"  data-cue="slideInUp"   data-id='img_7' style='top: 50%;font-size: 180%;'><i class="fa fa-upload"></i></button>

            <div class="container clearfix">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6 text-center">

                        <div class="box_1" data-cue="slideInUp">

                            <h2 class='edit-title' data-id='title-14' > {{ $titles['title-14'] ?? 'Celebrate' }}</h2>
                            <h2 class='edit-title' data-id='title-15' ><span> {{ $titles['title-15'] ?? ' a Special Event with us!' }}</span></h2>
                      
                            <p class='edit-text' data-id='text-2'  >{!! $texts['text-2'] ?? ' Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt' !!}.</p>
                            <a data-id='btn-3' class="btn_1  mt-3 edit-btn"
                            href="{{ $buttons['btn-3']['url'] ?? '#contacts.html' }}">{{ $buttons['btn-3']['title'] ?? 'Contact us' }}</a>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/call_section-->

        <div class="pattern_2">
            <div class="container margin_120_100 pb-0">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center d-none d-lg-block edit-image" data-cue="slideInUp">

                        @if (isset($images['img_8'])) 
                            <img src="{{ url('storage/index1/' . $images['img_8']) }}" width="420" height="770"
                            alt="" class="img-fluid">
                        @else 
                            <img src="{{ URL::asset('index1/img/chef.png') }}" width="420" height="770"
                            alt="" class="img-fluid">
                        @endif  
                        
                        <button class="edit-button-image"  data-cue="slideInUp"   data-id='img_8' style='top: 50%;font-size: 180%;'><i class="fa fa-upload"></i></button>
            
                       
                    </div>
                    <div class="col-lg-6 col-md-8" data-cue="slideInUp">
                        <div class="main_title">
                            <span><em></em></span>
                            <h2>Reserve a table</h2>
                            <p>or Call us at 0344 32423453</p>
                        </div>
                        <div id="wizard_container">
                            <form id="wrapped" method="POST">
                                <input id="website" name="website" type="text" value="">
                                <!-- Leave for security protection, read docs for details -->
                                <div id="middle-wizard">
                                    <div class="step">
                                        <h3 class="main_question"><strong>1/3</strong> Please Select a date</h3>
                                        <div class="form-group">
                                            <input type="hidden" name="datepicker_field" id="datepicker_field"
                                                class="required">
                                        </div>
                                        <div id="DatePicker"></div>
                                    </div>
                                    <!-- /step-->
                                    <div class="step">
                                        <h3 class="main_question"><strong>2/3</strong> Select time and guests</h3>
                                        <div class="step_wrapper">
                                            <h4>Time</h4>
                                            <div class="radio_select add_bottom_15">
                                                <ul>
                                                    <li>
                                                        <input type="radio" id="time_1" name="time"
                                                            value="12.00am" class="required">
                                                        <label for="time_1">12.00</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_2" name="time"
                                                            value="12.30pm" class="required">
                                                        <label for="time_2">12.30</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_3" name="time"
                                                            value="1.00pm" class="required">
                                                        <label for="time_3">1.00</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_4" name="time"
                                                            value="1.30pm" class="required">
                                                        <label for="time_4">1.30</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_5" name="time"
                                                            value="08.00pm" class="required">
                                                        <label for="time_5">8.00</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_6" name="time"
                                                            value="08.30pm" class="required">
                                                        <label for="time_6">8.30</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_7" name="time"
                                                            value="09.00pm" class="required">
                                                        <label for="time_7">9.00</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="time_8" name="time"
                                                            value="09.30pm" class="required">
                                                        <label for="time_8">9.30</label>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /time_select -->
                                        </div>
                                        <!-- /step_wrapper -->
                                        <div class="step_wrapper">
                                            <h4>How many people?</h4>
                                            <div class="radio_select">
                                                <ul>
                                                    <li>
                                                        <input type="radio" id="people_1" name="people"
                                                            value="1" class="required">
                                                        <label for="people_1">1</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="people_2" name="people"
                                                            value="2" class="required">
                                                        <label for="people_2">2</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="people_3" name="people"
                                                            value="3" class="required">
                                                        <label for="people_3">3</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="people_4" name="people"
                                                            value="4" class="required">
                                                        <label for="people_4">4</label>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /people_select -->
                                        </div>
                                        <!-- /step_wrapper -->
                                    </div>
                                    <!-- /step-->
                                    <div class="submit step">
                                        <h3 class="main_question"><strong>3/3</strong> Please fill with your
                                            details</h3>
                                        <div class="form-group">
                                            <input type="text" name="name_reserve" class="form-control required"
                                                placeholder="First and Last Name">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="email" name="email_reserve"
                                                        class="form-control required" placeholder="Your Email">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" name="telephone_reserve"
                                                        class="form-control required" placeholder="Your Telephone">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control" name="opt_message_reserve" placeholder="Please provide any additional info"></textarea>
                                        </div>
                                        <div class="form-group terms">
                                            <label class="container_check">Please accept our <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#terms-txt">Terms and
                                                    conditions</a>
                                                <input type="checkbox" name="terms" value="Yes"
                                                    class="required">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /step-->
                                </div>
                                <!-- /middle-wizard -->
                                <div id="bottom-wizard">
                                    <button type="button" name="backward" class="backward">Prev</button>
                                    <button type="button" name="forward" class="forward">Next</button>
                                    <button type="submit" name="process" class="submit">Submit</button>
                                </div>
                                <!-- /bottom-wizard -->
                            </form>
                        </div>
                        <!-- /Wizard container -->
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /pattern_2 -->
    </main>
    <!-- /main -->

    <footer>
        <div class="frame black"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_wp">
                        <i class="icon_pin_alt"></i>
                        <h3>Address</h3>
                        <p>{{$this->store_info->address}}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_wp">
                        <i class="icon_tag_alt"></i>
                        <h3>Reservations</h3>
                        <p><a href="tel:{{$this->store_info->phone}}">{{$this->store_info->phone}}</a><br><a
                                href="#0">{{$this->store_info->email}}</a></p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="footer_wp">
                        <i class="icon_clock_alt"></i>
                        <h3>Opening Hours</h3>
                        <ul>
                            <li>Mon - Sat: 10am - 11pm</li>
                            <li>Sunday: Closed</li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <h3>Keep in touch</h3>
                    <div id="newsletter">
                        <div id="message-newsletter"></div>
                        <form method="post" action="phpmailer/newsletter_template_email.php" name="newsletter_form"
                            id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" id="email_newsletter"
                                    class="form-control" placeholder="Your email">
                                <button type="submit" id="submit-newsletter"><i
                                        class="arrow_carrot-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <hr>
            <div class="row">
                <div class="col-sm-5">
                    <p class="copy">© Sadik Sajid  - All rights reserved</p>
                </div>
                <div class="col-sm-7">
                    <div class="follow_us">
                        <ul>
                            @if(!empty($this->store_info->twitter))
                                <li><a href="{{$this->store_info->twitter}}"><img
                                            src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                            data-src="{{ URL::asset('index1/img/twitter_icon.svg') }}" alt=""
                                            class="lazy"></a></li>
                            @endif
                            @if(!empty($this->store_info->facebook))

                            <li><a href="{{$this->store_info->facebook}}"><img
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                        data-src="{{ URL::asset('index1/img/facebook_icon.svg') }}" alt=""
                                        class="lazy"></a></li>
                            @endif
                            @if(!empty($this->store_info->instagram))
                            <li><a href="{{$this->store_info->instagram}}"><img
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                        data-src="{{ URL::asset('index1/img/instagram_icon.svg') }}" alt=""
                                        class="lazy"></a></li>
                            @endif
                            @if(!empty($this->store_info->youtube))

                            <li><a href="{{$this->store_info->youtube}}"><img
                                        src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                        data-src="{{ URL::asset('index1/img/youtube_icon.svg') }}" alt=""
                                        class="lazy"></a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <p class="text-center"></p>
        </div>
    </footer>
    <!--/footer-->

    <div id="toTop"></div><!-- Back to top button -->

    <!-- Modal terms -->
    <div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum
                            accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per
                        ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus
                        tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne
                        quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in
                        nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per
                        ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
                    <p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus
                        tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne
                        quod dicunt sensibus.</p>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- Modal -->
    <div class="modal fade" id="editimgModal" tabindex="-1" role="dialog" aria-labelledby="editimgModalTitle"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <label class="col-md-12 form-label">Category Image</label>

                        <div class="dropify-wrapper" style="height:auto;border: none;">

                            <img id='output' src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                style="height: 50%;width:50%">

                            <div class="dropify-loader">
                            </div>
                            <input type="file" id='upload_img' class="dropify" wire:model="upload_image"
                                data-height="210">
                        </div>
                        @error('upload_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id='saveImg' class="btn btn-primary" wire:click='editImg()'>Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>


</div>



<!-- COMMON SCRIPTS -->

<link href="{{ URL::asset('index1/css/wizard.css') }}" rel="stylesheet">

<script src="{{ URL::asset('index1/js/common_scripts.min.js') }}"></script>
<script src="{{ URL::asset('index1/js/common_func.js') }}"></script>
<script src="{{ URL::asset('index1/phpmailer/validate.js') }}"></script>

<!-- SPECIFIC SCRIPTS -->
<script src="{{ URL::asset('index1/js/modernizr.min.js') }}"></script>
<script src="{{ URL::asset('index1/js/video_header.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/plugins/fileupload/js/dropify.js') }}"></script>
<script src="{{ URL::asset('assets/js/filupload.js') }}"></script>
@livewireScripts


<script>
    $('#upload_img').on('change', function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>


<script>
    // Video Header
    $(document).ready(function() {
        HeaderVideo.init({
            container: $('.header-video'),
            header: $('.header-video--media'),
            videoTrigger: $("#video-trigger"),
            autoPlayVideo: true
        });

        $('.btn_play').unbind('click').click(null);


        $(document).on('click','.edit-button-tile', async function(event) {
            // var text_click = $(event.target).text();
            var text_click = $(this).parent(".edit-title").text().trim();

            var id = $(this).data("id")
            const {
                value: text
            } = await Swal.fire({
                input: "text",
                inputLabel: "Edit Title",
                inputValue: text_click,
                inputAttributes: {
                    "aria-label": "Type your message here"
                },
                showCancelButton: true
            });
            if (text) {
                Livewire.emit('editText', 'title', id, text);
                $(this).parent(".edit-title").text(text)
          
            }
        });


        $(document).on('click','.edit-button-text', async function(event) {
            // var text_click = $(event.target).text();
            var text_click = $(this).parent(".edit-text").find('p').html();

            var val = text_click.replace(/<br>/g, '\n');

            var id = $(this).data("id")
            const {
                value: text
            } = await Swal.fire({
                input: "textarea",
                inputLabel: "Edit text",
                inputValue:  val ,
                inputAttributes: {
                    "aria-label": "Type your message here"
                },
                showCancelButton: true
            });
            if (text) {
                val = text.replace(/\n/g, ' <br> ')
                Livewire.emit('editText', 'text', id, val);
                $(this).parent(".edit-text").find('p').html(val);
          
            }
        });


        $(document).on('click','.edit-button-url', async function(event) {
            // var text_click = $(event.target).text();
            var url = $(this).parent(".edit-url").attr('href')
            url = url.replace('#', '');

            var id = $(this).data("id")
            const {
                value: text
            } = await Swal.fire({
                input: "text",
                inputLabel: "Edit text",
                inputValue:  url ,
                inputAttributes: {
                    "aria-label": "Type your message here"
                },
                showCancelButton: true
            });
            if (text) {
                Livewire.emit('editText', 'url', id, text);
                $(this).attr("wire:click", '#'+text);
          
            }
        });




        $('.edit-btn').on('click', async function(event) {
            var text_click = $(event.target).text();
            var url = $(this).attr('href');
            url = url.replace('#', '');
            var id = $(this).data("id")

            const {
                value: formValues
            } = await Swal.fire({
                title: "Edit Button",
                html: `
                <input id="swal-input1" class="swal2-input" value='${text_click}'>
                <input id="swal-input2" class="swal2-input" value='${url}'>
            `,
                focusConfirm: false,
                preConfirm: () => {
                    return [
                        document.getElementById("swal-input1").value,
                        document.getElementById("swal-input2").value
                    ];
                }
            });
            if (formValues) {
                Livewire.emit('editBtn', id, formValues);
                $(event.target).text(formValues[0]);

            }
        });

        $('.edit-button-image').on('click', function() {

            var id = $(this).data("id")
            $("#saveImg").attr("wire:click", "editImg('" + id + "')");

            $('#editimgModal').modal('show');


        });

        window.addEventListener('closeModal', event => {
            $('#editimgModal').modal('hide');
        });


        window.addEventListener('refreshJs', event => {
            changeUrl()

        });

        ////////////////////////////////

        const editIconClass = 'fa fa-edit';
        const editIconClassurl = 'fa fa-link';
        var editButton 

        // Create an icon element and append it to the button
        let editIconurl = $('<i>').addClass(editIconClassurl);

        let editIcon = $('<i>').addClass(editIconClass);
        let clonedButton
        // Function to handle button creation and positioning
        function addEditButtonToDiv(div,type='title') {

            editButton = $('<button>');

            // Define styles for the button (you can add them separately in CSS)
            editButton.css({
                position: 'absolute',
                padding: '7px',
                background: 'transparent', // Remove background if using icon
                border: 'none',
                'background-color': '#0090ff',
                'font-size': 'min(1vw, 60%)',
                cursor: 'pointer',
                display: 'none',
                right: '0px',
                top:' 0px',
                color:'white',
            });


            if(type == 'url'){
                editButton.append(editIconurl);
            }else{
                editButton.append(editIcon);
            }
            clonedButton = editButton.clone();

            if(type == 'title'){
                clonedButton.addClass('edit-button-tile edit-button')
            }else if(type == 'text'){
                clonedButton.addClass('edit-button-text edit-button')
            }else if(type == 'url'){
                clonedButton.addClass('edit-button-url url-btn edit-button')
            }else{
                clonedButton.addClass('edit-button')
            }
            
            clonedButton.attr("data-id", div.data("id"));
            div.append(clonedButton);

        }

        // Select all divs on the page
        let divs = $('.edit-title');

        // Loop through all divs and add the edit button functionality
        divs.each(function() {
            $(this).css("position", "relative");
            addEditButtonToDiv($(this));
        });

        // Select all divs on the page
        let divs_text = $('.edit-text');

        // Loop through all divs and add the edit button functionality
        divs_text.each(function() {
            $(this).css("position", "relative");
            addEditButtonToDiv($(this),'text');
        });

        let divs_btn = $('.edit-btn');

        // Loop through all divs and add the edit button functionality
        divs_btn.each(function() {
            $(this).css("position", "relative");
            addEditButtonToDiv($(this),'btn');
        });

        let divs_url = $('.edit-url');

        // Loop through all divs and add the edit button functionality
        divs_url.each(function() {
            // $(this).css("position", "relative");
            addEditButtonToDiv($(this),'url');
        });


        function changeUrl() {
            $('a').each(function() {
            var currentHref = $(this).attr('href');
            if (currentHref && currentHref.indexOf('#') !== 0) {
                $(this).attr('href', '#' + currentHref);
            }
         });
        }

        changeUrl()

    });
</script>

<!-- SPECIFIC SCRIPTS (wizard form) -->
<script src="{{ URL::asset('index1/js/wizard/wizard_scripts.min.js') }}"></script>
<script src="{{ URL::asset('index1/js/wizard/wizard_func.js') }}"></script>
