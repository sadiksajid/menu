<div>
    <link rel="stylesheet" href="{{ URL::asset('dist/easy-button.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('dist/leaflet.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('dist/leaflet-routing-machine.css') }}" />
  
    <link rel="stylesheet" href="{{ URL::asset('dist/Control.Geocoder.css') }}" />
    <link href="{{ URL::asset('css/leaflet.icon-material.css') }}" rel="stylesheet" />

    <style>
    .comingSVG {

        position: absolute;
        width: 60px;
        margin-top: -20px;
        float: left;
        height: 60px;
        left: 10px;

    }

    .motoSVG {

        position: absolute;
        width: 80px;
        height: 80px;
        top: -28px;
        float: left;
        left: 0px;

    }

    .btn-outline-dark:hover h4 {
        color: white !important
    }

    .time_input {
        width: 100px !important;
        height: 100px !important;
        border-radius: 20px;
        font-size: 60px;
        padding-left: 16px !important;
        padding-right: 10px !important;

    }

    body.noscroll {
        overflow: hidden;
    }

    /* Chrome, Safari, Edge, Opera */
    .time_input::-webkit-outer-spin-button,
    .time_input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    .time_input[type=number] {
        -moz-appearance: textfield;
    }
    </style>

    <div wire:ignore class="hero_single inner_pages background-image" style="height:260px" @if (isset($images_checkout))
        data-background="url({{ get_image($images_checkout)}})" @else
        data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif>

        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1> {{ $titles_checkout ?? $translations['checkout'] }} </h1>
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="frame white"></div>
    </div>
    <section class="checkout-page pt-2">
        <div class="container">
            <div class="row d-flex justify-content-center">


                @if($order_steps == 0 )


                <div class="col-md-6 col-12 checkout-form">
                    <div class="checkout-details">
                        <div class="order-box mb-3">


                            <div class="title-box pb-0">
                                <h4>
                                    {{$translations['products']}}
                                    <span class='text-right'>{{$translations['subtotal']}}</span>
                                </h4>
                            </div>


                            <ul class="qty">
                                @foreach ($my_cart as $store_meta => $store)
                                @if (Cache::get('store_info')[$store_meta]['selected'] == true)
                                <li>
                                    <h4>Store :
                                        {{ Cache::get('store_info')[$store_meta]['title'] }}
                                    </h4>
                                </li>
                                @foreach ($store as $key => $product)
                                <li> {{ $product['qte'] }} × {{ $product['product']->title }}

                                    <strong><span class='text-right'>{{ $product['product']->price * $product['qte'] }}
                                            {{ $currency }}</span></strong>
                                </li>
                                @endforeach
                                @endif
                                @endforeach
                            </ul>
                            <!-- <ul class="sub-total">
                                <li>{{$translations['subtotal']}} <span class="count">{{ $total }}
                                        {{ $currency }}</span>
                                </li>

                            </ul> -->
                            <button class='btn btn-md btn-warning w-100'>
                                <h3 class='mb-0'><strong> {{$translations['total']}} : {{ $total }}
                                        {{ $currency }}</strong></h3>
                            </button>
                        </div>
                        <div class="payment-box">
                            <hr>


                            <div class="title-box ">
                                <h4>
                                    {{$translations['shipping_method']}}
                                </h4>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6 col-12">


                                    <button
                                        class="border btn @if ($shipping_type == 'shipping') btn-dark @else  btn-light @endif "
                                        style="width: 100%" wire:click='changeDelivery("shipping")'>
                                        <lottie-player class='motoSVG'
                                            src="{{ URL::asset('assets/SVG/moto_orange.json') }}"
                                            background="transparent" speed="1" loop autoplay></lottie-player>

                                        {{$translations['ship_it_to_me']}}
                                    </button>
                                </div>
                                <div class="col-md-6 col-12 mt-3 mt-md-0">

                                    <button
                                        class="  border btn @if ($shipping_type == 'coming') btn-dark @else  btn-light @endif "
                                        style="width: 100%" wire:click='changeDelivery("coming")'>
                                        <lottie-player class='comingSVG'
                                            src="{{ URL::asset('assets/SVG/coming_icon_orange.json') }}"
                                            background="transparent" speed="1" loop autoplay></lottie-player>
                                        {{$translations['im_coming']}}
                                    </button>
                                </div>
                            </div>

                            <hr class='m-3'>
                            <div>

                                <div class="title-box ">
                                    <h4>
                                        {{$translations['payment_method']}}
                                    </h4>
                                </div>

                                <div class="row mt-2">
                                    <div class="cil-md-6 col-12">
                                        <button class="border btn  btn-dark  " style="width: 100%">
                                            <i class="fa fa-money"
                                                style="font-size: 24px;left: 30px;position: absolute;color: #ff6f00;"></i>
                                            {{$translations['cod']}}
                                        </button>
                                    </div>

                                </div>
                            </div>

                            @if ($total > 0)
                            <div class="text-center mt-5"><a class="btn btn-warning radius-2 " style='min-width:30%'
                                    wire:click='NextStep(1)' id='submit'><strong>{{$translations['next']}}</strong>
                                </a>
                            </div>
                            @else
                            <div class="text-center mt-5">
                                <a href='/shop' class="btn btn-warning radius-2 " style='min-width:30%'>
                                    <strong>{{$translations['cart_empty']}}</strong>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>


                @else
                <div class="col-md-6 col-12 checkout-form">
                    <div class="checkout-details pt-1">

                        <div class="checkout-title mb-3">
                            <div class="row mt-2">

                                <div class="col-md-6 col-12 mb-4 mb-md-0">

                                    <button class='btn btn-md btn-warning w-100'>
                                        <h3 class='mb-0'><strong> {{$translations['total']}} : {{ $total }}
                                                {{ $currency }}</strong></h3>
                                    </button>
                                </div>


                                <div class="col-md-6 col-12">
                                    @if ($shipping_type == 'coming')
                                    <button class=" border btn btn-dark h-100" style="width: 100%">
                                        <lottie-player class='comingSVG'
                                            src="{{ URL::asset('assets/SVG/coming_icon_orange.json') }}"
                                            background="transparent" speed="1" loop autoplay></lottie-player>
                                        {{$translations['im_coming']}}
                                    </button>
                                    @else
                                    <button class="border btn btn-dark h-100 " style="width: 100%">
                                        <lottie-player class='motoSVG'
                                            src="{{ URL::asset('assets/SVG/moto_orange.json') }}"
                                            background="transparent" speed="1" loop autoplay></lottie-player>

                                        {{$translations['ship_it_to_me']}}
                                    </button>
                                    @endif

                                </div>

                            </div>

                            <hr class='m-2'>

                            <div class="title-box ">
                                <h4>
                                    {{$translations['client_info']}}
                                    <div wire:loading class="spinner-border text-secondary" role="status" style="    font-size: 11px;
                                            width: 25px;
                                            height: 25px;">
                                        <span class="sr-only">{{$translations['loading']}}...</span>
                                    </div>
                                </h4>
                            </div>
                        </div>
                        <!-- /////////////////////////////////////////////////////////////////// register -->
                        <div class="row check-out">
                            @if (Auth::guard('client')->check() == false and $step == 1)

                            <div class="form-group col-sm-6 col-12">
                                <div class="field-label text-secondary">{{$translations['first_name']}}
                                </div>
                                <input name="field-name" placeholder="FirstName" type="text"
                                    wire:model='client_firstname'>
                                @error('client_firstname')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6 col-12">
                                <div class="field-label text-secondary">{{$translations['last_name']}}</div>
                                <input name="field-name" placeholder="LastName" type="text"
                                    wire:model='client_lastname'>
                                @error('client_lastname')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6 col-12">
                                <div class="field-label text-secondary">{{$translations['phone']}}</div>
                                <input name="field-name" placeholder="Phone" type="text" wire:model='client_phone'
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                @error('client_phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-6 col-12">
                                <div class="field-label text-secondary">{{$translations['email']}}</div>
                                <input name="field-name" placeholder="Email" type="text" wire:model='client_email'>
                                @error('client_email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div class="form-group col-sm-6 col-12">
                                <div class="field-label text-secondary ">{{$translations['password']}}
                                    <span style="color: gray ; font-size:10px">(
                                        {{$translations['password_meta']}} )</span>
                                </div>
                                <input name="field-name" placeholder="Password" type="password" wire:model='password'>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="form-group col-sm-6 col-12">
                                <div class="field-label text-secondary">{{$translations['repeat_password']}}
                                </div>
                                <input name="field-name" placeholder="Repeat Password" type="password"
                                    wire:model='password_confirmation'>
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="col-12 mb-3">
                                <center><span>
                                        <h5>Do you have an account ? <span class="badge badge-dark login_show"
                                                style='cursor:pointer'>Login</span></h5>
                                    </span></center>
                            </div>


                            <div style='display: flex;justify-content: space-between;'>
                                <a class="btn btn-dark radius-2 text-light" style='width:30%'
                                    wire:click='NextStep(0)'><strong>{{$translations['back']}}</strong>
                                </a>
                                <a class="btn btn-warning radius-2 " style='min-width:30%'
                                    Wire:click='Step1()'><strong>{{$translations['next']}}</strong>
                                </a>
                            </div>
                            @else

                            <!-- //////////////////////////////////////////////////////////////////// after login -->
                            <div class='col-12'>
                                <div class="row">
                                    <div class="col-6">
                                        <button class='btn btn-outline-dark w-100'>
                                            <h4 class='m-0'>
                                                <i class="fa fa-user" style="font-size:24px"></i>
                                                {{ $client_firstname }} {{ $client_lastname }}
                                            </h4>
                                        </button>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <button class='btn btn-outline-dark w-100'>
                                            <h4 class='m-0'>
                                                <i class="fa fa-phone" style="font-size:24px"></i>
                                                {{ $client_phone }}
                                            </h4>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <hr class='m-2'>
                            @if ($shipping_type == 'shipping')

                            <div class="col-12 mb-3">
                                <button class="btn btn-dark btn-sm mb-2" wire:click="showMaps"
                                    style="float: right">{{$translations['map_pick']}}</button>
                            </div>
                            @if ($new_address == true)
                            <div class="col-12 mb-3">
                                <button class="btn btn-dark btn-sm mb-2" style="float: right"
                                    wire:click='addAddress(0)'>{{$translations['sellect_address']}}</button>
                            </div>
                            @else
                            <div class="col-12 mb-3">
                                <span>{{$translations['select_address_msg']}}</span>
                                <button class="btn btn-dark btn-sm mb-2" style="float: right"
                                    wire:click='addAddress(1)'>{{$translations['new_address']}}</button>
                            </div>
                            @endif
                            @if ($new_address == true)

                            <div class="form-group col-md-6 col-sm-6 col-12">
                                <div class="field-label text-secondary">{{$translations['town_city']}}</div>
                                <input name="field-name" placeholder="{{$translations['town_city']}}" type="text"
                                    wire:model='client_city' id="city_name">
                                <center>
                                    <div class="dropdown-menu" aria-labelledby="citiesDrop" id="citiesDrop"
                                        style=" width: 100%; position: relative;">
                                        @foreach ($cities as $city)
                                        <a class="dropdown-item"
                                            wire:click="changeCity('{{ $city->city }}',{{ $city->id }})">{{ $city->city }}</a>
                                        @endforeach

                                    </div>
                                </center>

                                @error('client_city')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-12">
                                <div class="field-label text-secondary">{{$translations['quarter']}}</div>
                                <input name="field-name" placeholder="{{$translations['quarter']}}" type="text"
                                    wire:model='client_quarter' id="qaurter_name">
                                <center>
                                    <div class="dropdown-menu" aria-labelledby="quartersDrop" id="quartersDrop"
                                        style=" width: 100%; position: relative;">
                                        @foreach ($quarters as $quarter)
                                        <a class="dropdown-item"
                                            wire:click="changeQuarter('{{ $quarter->quartier }}',{{ $quarter->id }},{{ $quarter->city_id }})">{{ $quarter->quartier }}</a>
                                        @endforeach
                                    </div>
                                </center>
                                @error('client_quarter')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12 col-sm-12 col-12">
                                <div class="field-label text-secondary">{{$translations['address']}}</div>
                                <input name="field-name" placeholder="{{$translations['address']}}" type="text"
                                    wire:model='client_address'>
                                @error('client_address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @else
                            <table class="table table-striped">
                                <tbody>
                                    @foreach ($all_address as $address)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }} -</th>
                                        <td>{{ $address->city->city }} ,
                                            {{ $address->quartier->quartier }} ,
                                            {{ $address->address }}</td>
                                        <td>
                                            <button
                                                class="btn @if ($address_id == $address->id) btn-warning  @else btn-light @endif btn-sm border"
                                                wire:click="selectAddress({{ $address->id }})">
                                                @if ($address_id == $address->id)
                                                {{$translations['used']}}
                                                @else
                                                {{$translations['use']}}
                                                @endif

                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            @error('address_id')
                            <span class="text-danger">{{$translations['you_have_to_select_one_address']}}</span>
                            @enderror

                            @endif
                            @else
                            <div class="col-12 text-center">
                                <h5>{{$translations['visit_us_time']}}</h5>
                            </div>

                            <div class="col-12"
                                style='display: flex;flex-direction: row;flex-wrap: nowrap;align-items: center;justify-content: center;'>
                                <!-- <input name="field-name" class="form-control" type="time"
                                    wire:model.defer='coming_time'> -->


                                <input type="number" class='time_input' id='hourInput' value='01'>
                                <input type="number" class='time_input' id='minuteInput' value='59'>
                                <input type="text" class='d-none' id='timeInput'>
                                <div class='ml-2'
                                    style='display: flex;flex-direction: column;justify-content: space-between;height: 90px;'>
                                    <button class='btn btn-warning h-50' id='btn-time-am'>AM</button>
                                    <button class='btn btn-light h-50 border' id='btn-time-pm'>PM</button>
                                </div>
                                @error('coming_time')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif
                            <div class=" col-12 mt-3">
                                <div class="field-label text-secondary">{{$translations['comment']}}</div>
                                <textarea wire:model='comment' class="form-control" cols="30" rows="10"
                                    style="min-height: 130px"></textarea>
                                @error('comment')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class='mt-4' style='display: flex;justify-content: space-between;'>
                                <a class="btn btn-dark radius-2 text-light" style='width:30%'
                                    wire:click='NextStep(0)'><strong>{{$translations['back']}}</strong>
                                </a>
                                <a class="btn btn-warning radius-2 " style='min-width:30%'
                                    id='submit_order'><strong>{{$translations['place_order']}}</strong>
                                </a>
                            </div>


                            @endif

                        </div>
                    </div>
                </div>

                @endif


            </div>
        </div>

    </section>

    <div class="col-12  mt-3 mb-3">
        <!-- Modal -->
        <div class="modal fade" id="map_modal" tabindex="-1" role="dialog" aria-labelledby="map_modalTitle"
            aria-hidden="true" wire:ignore>
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header p-1">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            {{ $translations['edit_location'] }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div id="map-wrapper" class="divMap">

                            <div class="spinner-grow text-primary" role="status"
                                style="width: 158px;height: 150px;color: #bf1c3d !important;margin-left: 40%;margin-top: 15%;">
                                <span class="sr-only">{{ $translations['loading'] }}...</span>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer p-1">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ $translations['close'] }}</button>
                        <button type="button" class="btn btn-primary"
                            wire:click="saveLocation">{{ $translations['save'] }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
@section('js')

<script src="{{ URL::asset('js/leaflet.js') }}"></script>
<script src="{{ URL::asset('js/esri-leaflet.js') }}"></script>

<script src="{{ URL::asset('js/Control.Geocoder.js') }}"></script>
<script src="{{ URL::asset('js/esri-leaflet-geocoder.js') }}"></script>
<script src="{{ URL::asset('dist/easy-button.js') }}"></script>
<script src="{{ URL::asset('dist/leaflet-rotate-src.js') }}"></script>
<script src="{{ URL::asset('js/leaflet.icon-material.js') }}"></script>
<script src="{{ URL::asset('js/MarkerIcons.js') }}"></script>
<script src="{{ URL::asset('js\custom\mapScript.js') }}"></script>
<script src="{{ URL::asset('js/maps_call_functions.js') }}"></script>
<script src="{{ URL::asset('js\custom\maps_call_functions.js') }}"></script>



<script>
$(document).ready(function() {

    window.addEventListener('StoreInfoModal', event => {
        var status = event.detail.status;
        $('#map_modal').modal(status);
    });


    $('html, body').animate({
        scrollTop: $('.checkout-form').offset().top - 70
    }, 1000); // 1000 milliseconds for smooth scroll


    Buttons();
    $('#modalLoginForm').modal('show')


    function Buttons() {
        let typingTimer;
        $('#city_name').keyup(function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function() {
                Livewire.emit('getCity')
            }, 500);
        })
        $('#qaurter_name').keyup(function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function() {
                Livewire.emit('getQuarter')
            }, 500);
        })

    }
    window.addEventListener('reload', event => {
        Buttons()
    });
    window.addEventListener('runDropCity', event => {
        $('#citiesDrop').addClass('show');
    });
    window.addEventListener('runDropQuartier', event => {
        $('#quartersDrop').addClass('show');
    });

    /////////////////////////////////////////////////////

    function clampValue(input, value) {
        if (input === 'hourInput') {
            return Math.max(1, Math.min(12, value));
        } else {
            return Math.max(0, Math.min(59, value));
        }
    }

    function formatValue(value) {
        return value < 10 ? '0' + value : value.toString();
    }

    function changeValue(input, increment) {
        let currentValue = parseInt($(input).val(), 10) || 0;
        var newValue = currentValue + increment;
        if ($(input).attr('id') == 'minuteInput' && newValue >= 60) {
            changeValue($('#hourInput')[0], 1); // Increment hour by 1
            newValue = 0; // Reset minutes to 0
        } else if ($(input).attr('id') == 'minuteInput' && newValue < 0) {
            changeValue($('#hourInput')[0], -1); // Decrement hour by 1
            newValue = 59; // Reset minutes to 59
        } else {
            newValue = clampValue($(input).attr('id'), newValue);

        }
        $(input).val(formatValue(newValue));
    }

    $(document).on('input', '.time_input', function() {
        let value = $(this).val().replace(/[^0-9]/g, '');
        value = clampValue($(this).attr('id'), parseInt(value, 10) || 0);
        $(this).val(formatValue(value));
    });

    $(document).on('keydown', '.time_input', function(e) {
        if (e.key === "ArrowUp") {
            e.preventDefault();
            changeValue(this, 1);
        } else if (e.key === "ArrowDown") {
            e.preventDefault();
            changeValue(this, -1);
        }
    });

    $(document).on('wheel', '.time_input', function(e) {
        e.preventDefault();
        e.stopPropagation();
        let delta = (e.originalEvent.wheelDelta || -e.originalEvent.detail);
        if (delta > 0) {
            changeValue(this, 1);
        } else {
            changeValue(this, -1);
        }
    });

    $(document).on('mouseenter', '.time_input', function() {
        $('body').addClass('noscroll');
    });

    $(document).on('mouseleave', '.time_input', function() {
        $('body').removeClass('noscroll');
    });



    $(document).on('click', '#btn-time-pm', function(e) {
        $('#btn-time-pm').addClass('btn-warning');
        $('#btn-time-pm').removeClass('btn-light');
        $('#btn-time-am').removeClass('btn-warning');
        $('#btn-time-am').addClass('btn-light');
        $('#timeInput').val('pm');

    });

    $(document).on('click', '#btn-time-am', function(e) {
        $('#btn-time-am').addClass('btn-warning');
        $('#btn-time-am').removeClass('btn-light');
        $('#btn-time-pm').removeClass('btn-warning');
        $('#btn-time-pm').addClass('btn-light');
        $('#timeInput').val('am');

    });


    function updateTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        if (hours >= 12) {
            ampm = 'pm'
            $('#btn-time-pm').addClass('btn-warning');
            $('#btn-time-pm').removeClass('btn-light');
            $('#btn-time-am').removeClass('btn-warning');
            $('#btn-time-am').addClass('btn-light');
        } else {
            ampm = 'am'
            $('#btn-time-am').addClass('btn-warning');
            $('#btn-time-am').removeClass('btn-light');
            $('#btn-time-pm').removeClass('btn-warning');
            $('#btn-time-pm').addClass('btn-light');

        }
        // Convert hours from 24-hour format to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // The hour '0' should be '12'

        // Add a leading zero to minutes if they are less than 10
        if (minutes < 10) {
            minutes = '0' + minutes;
        }
        $('#hourInput').val(hours);
        $('#minuteInput').val(minutes);
        $('#timeInput').val(ampm);
    }



    window.addEventListener('update_time', event => {
        updateTime()
    });



    $(document).on('click', '#submit_order', function(e) {
        var hours = $('#hourInput').val();
        var minutes = $('#minuteInput').val();
        var ampm = $('#timeInput').val();
        var timeString = hours + ':' + minutes + ' ' + ampm;

        Livewire.emit('Order', {
            'time': timeString
        })

    });




})
</script>
@endsection