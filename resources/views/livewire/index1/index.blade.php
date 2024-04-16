<div>
    @php
        $offer = $this->offers->random();
    @endphp
    <div class="header-video">
        <div id="hero_video" @if (isset($images['img_1']))
            style='background-image:url({{ get_image($images["img_1"]) }})' @endif>
            <div wire:ignore class="opacity-mask d-flex align-items-center  img_1"
                data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-xl-8 col-lg-10 col-md-8 mt-2">
                            <h1 class='' data-id='title-1'>
                                {{ $titles['title-1'] ??  $translations_resto['taste_unique_food']['en']  }}</h1>
                            <p class='' data-id='title-2'>
                                {{ $titles['title-2'] ?? '' }}</p>
                            <a data-id='btn-1' class="btn_1 "
                                href="{{ $buttons['btn-1']['url'] ?? '#menu-1.html' }}" style='background-color:{{$store_info->btn_color}}'>{{ $buttons['btn-1']['title'] ?? $translations['read_more']['en'] }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ get_image($images['img_1']) }}"
            data-video-src="{{ URL::asset('index1/video/intro') }}" class="header-video--media"
            data-teaser-source="{{ URL::asset('index1/video/intro') }}" data-provider="" data-video-width="1920"
            data-video-height="960">
    </div>
    <!-- /header-video -->

    <ul id="banners_grid" class="clearfix">
        <li class="">
            <a @if (isset($urls['url_1'])) href="{{$urls['url_1']}}" @else href="menu-1.html" @endif
                class="img_container  " data-id='url_1'>

                <img @if (isset($images['img_2'])) src="{{ get_image($images['img_2']) }}"
                    data-src="{{ get_image($images['img_2']) }}" @else
                    src="{{ URL::asset('index1/img/banners_cat_placeholder.jpg') }}"
                    data-src="{{ URL::asset('index1/img/banner_1.jpg') }}" @endif alt="" class="lazy">

                <div wire:ignore class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                    <h3 class='' data-id='title-3'> {{ $titles['title-3'] ?? $translations_resto['our_menu']['en'] }} </h3>
                    <p class='' data-id='title-4'>
                        {{ $titles['title-4'] ?? $translations_resto['view_our_specialites']['en'] }} </p>
                </div>
            </a>
        </li>
        <li class="">
            <a @if (isset($urls['url_2'])) href="{{$urls['url_2']}}" @else href="menu-1.html" @endif
                class="img_container  " data-id='url_2'>
                <img @if (isset($images['img_3'])) src="{{ get_image($images['img_3']) }}"
                    data-src="{{ get_image($images['img_3'])}}" @else
                    src="{{ URL::asset('index1/img/banners_cat_placeholder.jpg') }}"
                    data-src="{{ URL::asset('index1/img/banner_1.jpg') }}" @endif alt="" class="lazy">

                <div wire:ignore class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">

                    <h3 class='' data-id='title-5'> {{ $titles['title-5'] ?? $translations_resto['delivery']['en'] }} </h3>
                    <p class='' data-id='title-6'>
                        {{ $titles['title-6'] ??  $translations_resto['home_delivery_or_take_away_food']['en'] }}
                    </p>

                </div>
            </a>
        </li>
        <li class="">
            <a @if (isset($urls['url_3'])) href="{{$urls['url_3']}}" @else href="menu-1.html" @endif
                class="img_container  " data-id='url_3'>
                <img @if (isset($images['img_4'])) src="{{ get_image($images['img_4']) }}"
                    data-src="{{ get_image($images['img_4'])}}" @else
                    src="{{ URL::asset('index1/img/banners_cat_placeholder.jpg') }}"
                    data-src="{{ URL::asset('index1/img/banner_1.jpg') }}" @endif alt="" class="lazy">

                <div wire:ignore class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">

                    <h3 class='' data-id='title-7'> {{ $titles['title-7'] ??  $translations_resto['inside_foores']['en'] }} </h3>
                    <p class='' data-id='title-8'>
                        {{ $titles['title-8'] ??  $translations_resto['view_the_gallery']['en'] }}
                    </p>
                </div>
            </a>
        </li>
    </ul>

    <div class="pattern_2">
        <div class="container margin_120_100 home_intro">
            <div class="row justify-content-center d-flex align-items-center">
                <div class="col-lg-5 text-lg-center d-none d-lg-block " data-cue="slideInUp">
                    <figure class="">
                        <img @if (isset($images['img_5'])) src="{{ get_image($images['img_5'])}}"
                            data-src="{{ get_image($images['img_5']) }}" @else
                            src="{{ URL::asset('index1/img/home_1_placeholder.png') }}"
                            data-src="{{ URL::asset('index1/img/home_1.jpg') }}" @endif width="354" height="440" alt=""
                            class="img-fluid lazy">

                        <a @if (isset($urls['url_4'])) href="{{$urls['url_4']}}" @else
                            href="https://www.youtube.com/watch?v=MO7Hi_kBBBg" @endif data-id='url_4' class="btn_play  "
                            data-cue="zoomIn" data-delay="500"><span class="pulse_bt"><i
                                    class="arrow_triangle-right"></i></span></a>
                    </figure>
                </div>
                <div class="col-lg-5 pt-lg-4" data-cue="slideInUp" data-delay="500">
                    <div class="main_title">
                        <span><em></em></span>
                        <h2 class='' data-id='title-9'>{{ $titles['title-9'] ??  $translations_resto['some_words_about_us']['en'] }}</h2>
                        <p class='' data-id='title-16'>
                            {{ $titles['title-16'] ??  $translations_resto['some_words_about_us_meta']['en']  }}</p>
                    </div>
                    <div class='' data-id='text-1'>
                        <p>
                            {!! $texts['text-1'] ?? $translations_resto['some_words_about_us_text']['en'] !!}
                        </p>
                    </div>

                    <p><img src="{{ URL::asset('index1/img/signature.png') }}" width="140" height="50" alt=""
                            class="mt-3"></p>
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
                <h2 class='' data-id='title-10'>{{ $titles['title-10'] ??  $translations_resto['our_daily_menu']['en'] }}</h2>

            </div>
            <!-- /main_title -->

        


            @if (isset($offer->image))
            <a href="/shop/offer/{{ $offer->offer_meta}}">
                <div class="banner lazy " @if (isset($offer->image))
                    data-bg="{{ get_image($offer->image) }}" @else
                    data-bg="url({{ URL::asset('index1/img/banner_bg.jpg') }})" @endif>
    
                    {{-- <div wire:ignore class="wrapper d-flex align-items-center justify-content-between opacity-mask"
                        data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div>
                            <small class='' data-id='title-11'>{{ $offer->title ?? ' Special Offer' }}</small>
                            <h3 class='' data-id='title-12'>{{ $offer->offer_meta ?? ' Burgher Menu $18 only' }}</h3>
                            <p class='' data-id='title-13'>
                                {{ $offer->description ?? ' Hamburgher, Chips, Mix Sausages, Beer, Muffin' }}</p>
    
                            <a data-id='btn-2' class="btn_1 " style=' background-color:{{$store_info->btn_color}}'
                                href="{{ $buttons['btn-2']['url'] ?? '#reservations.html' }}">{{ $buttons['btn-2']['title'] ?? 'Reserve now' }}</a>
    
                        </div>
                        <figure class="d-none d-lg-block"><img src="{{ URL::asset('index1/img/banner.svg') }}" alt=""
                                width="200" height="200" class="img-fluid"></figure>
                    </div> --}}
                    <!-- /wrapper -->
                </div>
            </a>
            @endif
            <!-- /banner -->
            <div class="row magnific-gallery homepage add_bottom_25">
                @foreach ( $products as $product)
                <div class="col-lg-6" data-cue="slideInUp">
                    <div class="menu_item">
                        <figure style="border:1px solid black" >
                            <a href="{{ get_image('moyen/'.$product->media[0]->media) }}"
                                title="Summer Berry" data-effect="mfp-zoom-in">

                                <img src="{{ URL::asset('index1/img/menu_items/menu_items_placeholder.png') }}"
                                    data-src="{{ get_image('moyen/'.$product->media[0]->media) }}"
                                    class="lazy " alt="">
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
            <p class="text-center"><a href="/menu" class="btn_1 outline" data-cue="zoomIn">{{$translations['see_more']['en']}}</a></p>
        </div>
        <!-- /container -->
    </div>
    <!-- /bg_gray -->

    <div class="call_section lazy" @if (isset($images['img_7']))
        style="position: relative; background-image:get_image($images['img_7'])"
        data-bg="get_image($images['img_7'])" @else style="position: relative"
        data-bg="url({{ URL::asset('index1/img/bg_call_section.jpg') }})" @endif>

        <div class="container clearfix">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6 text-center">

                    <div class="box_1" data-cue="slideInUp">

                        <h2 class='' data-id='title-14'> {{ $titles['title-14'] ?? $translations_resto['our_location']['en'] }}</h2>
                        <h2 class='' data-id='title-15'><span>
                                {{ $titles['title-15'] ?? '' }}</span></h2>

                        <p class='' data-id='text-2'>{!! $texts['text-2'] ?? $translations_resto['our_location_text']['en'] !!}.</p>
                        <a data-id='btn-3' class="btn_1  mt-3 " style=' background-color:{{$store_info->btn_color}}'
                            href="{{ $buttons['btn-3']['url'] ?? '#contacts.html' }}">{{ $buttons['btn-3']['title'] ?? 'Contact us' }}</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/call_section-->
{{--     
    <div class="pattern_2">
        <div class="container margin_120_100 pb-0">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center d-none d-lg-block" data-cue="slideInUp">

                    @if (isset($images['img_8']))
                    <img src="{{ get_image($images['img_8'])}}" width="420" height="770" alt=""
                        class="img-fluid">
                    @else
                    <img src="{{ URL::asset('index1/img/chef.png') }}" width="420" height="770" alt=""
                        class="img-fluid">
                    @endif

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
                                                    <input type="radio" id="time_1" name="time" value="12.00am"
                                                        class="required">
                                                    <label for="time_1">12.00</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_2" name="time" value="12.30pm"
                                                        class="required">
                                                    <label for="time_2">12.30</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_3" name="time" value="1.00pm"
                                                        class="required">
                                                    <label for="time_3">1.00</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_4" name="time" value="1.30pm"
                                                        class="required">
                                                    <label for="time_4">1.30</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_5" name="time" value="08.00pm"
                                                        class="required">
                                                    <label for="time_5">8.00</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_6" name="time" value="08.30pm"
                                                        class="required">
                                                    <label for="time_6">8.30</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_7" name="time" value="09.00pm"
                                                        class="required">
                                                    <label for="time_7">9.00</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="time_8" name="time" value="09.30pm"
                                                        class="required">
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
                                                    <input type="radio" id="people_1" name="people" value="1"
                                                        class="required">
                                                    <label for="people_1">1</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="people_2" name="people" value="2"
                                                        class="required">
                                                    <label for="people_2">2</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="people_3" name="people" value="3"
                                                        class="required">
                                                    <label for="people_3">3</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="people_4" name="people" value="4"
                                                        class="required">
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
                                                <input type="email" name="email_reserve" class="form-control required"
                                                    placeholder="Your Email">
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
                                        <textarea class="form-control" name="opt_message_reserve"
                                            placeholder="Please provide any additional info"></textarea>
                                    </div>
                                    <div class="form-group terms">
                                        <label class="container_check">Please accept our <a href="#"
                                                data-bs-toggle="modal" data-bs-target="#terms-txt">Terms and
                                                conditions</a>
                                            <input type="checkbox" name="terms" value="Yes" class="required">
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
    <!-- /pattern_2 --> --}}
    <div class="pattern_2">
        <div class="container margin_120_100 pb-0">
            <div class="row justify-content-center" style="margin-bottom: 100px">
                <div class="col-md-3 col-6 " >
                    <a href="/shop">
                        <Button class="btn btn-lg " style="background-color:{{$store_info->btn_color}} ;color:white!important;width:100%">
                            <h4 class="mb-0" style='color:white!important'>{{$translations['visit_our_shop']['en']}}</h4>
                        </Button>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div id="toTop"></div><!-- Back to top button -->

   

</div>

@section('js')
<script>
    // Video Header
    $(document).ready(function() {
        HeaderVideo.init({
            container: $('.header-video'),
            header: $('.header-video--media'),
            videoTrigger: $("#video-trigger"),
            autoPlayVideo: true
        });
    });
</script>
@endsection