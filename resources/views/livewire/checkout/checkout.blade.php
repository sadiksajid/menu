<div>

    <style>
    .comingSVG {

        position: absolute;
        width: 60px;
        margin-top: -20px;
        float: left;
        height: 60px;
        left:10px;

    }

    .motoSVG {

        position: absolute;
        width: 80px;
        top: -28px;
        float: left;
        height: 80px;
        left: 0px;

    }
    .btn-outline-dark:hover h4 {
        color:white!important
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
                                    <a href='/shop' class="btn btn-warning radius-2 " style='min-width:30%' >
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
                                        <center><span><h5>Do you have an account ?  <span class="badge badge-dark login_show" style='cursor:pointer'>Login</span></h5></span></center>
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
                                <div class="row" >
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
                            <div class="col-12">
                                <div class="field-label text-secondary">{{$translations['time']}}</div>
                                <input name="field-name" class="form-control" type="time"
                                    wire:model.defer='coming_time'>
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
                                    wire:click='Order'><strong>{{$translations['place_order']}}</strong>
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

</div>
@section('js')
<script>
$(document).ready(function() {
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
})
</script>
@endsection