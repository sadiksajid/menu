<div>
    <div wire:ignore class="hero_single inner_pages background-image" style="height:260px"
    @if (isset($images_checkout))   data-background="url({{ get_image($images_checkout}})" @else data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif >

        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1  > {{ $titles_checkout ?? 'Cart' }}  </h1>
                        {{-- <p  >{{ $titles['title-2'] ?? 'Cooking delicious and tasty food since 2005' }} </p> --}}
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="frame white"></div>
    </div>
    <section class="checkout-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div>
                        <div class="checkout-form">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-12">
                                    <div class="checkout-title">
                                        <h3>Billing Details
                                            <div wire:loading.class.remove="d-none"
                                                class="spinner-border text-secondary d-none" role="status"
                                                style="    font-size: 11px;
                                            width: 25px;
                                            height: 25px;">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </h3>

                                    </div>
                                    <div class="row check-out">
                                        @if (Auth::guard('client')->check() == false and $step == 1)

                                            <div class="form-group col-sm-6 col-12">
                                                <div class="field-label text-secondary">First Name</div>
                                                <input name="field-name" placeholder="FirstName" type="text"
                                                    wire:model='client_firstname'>
                                                @error('client_firstname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6 col-12">
                                                <div class="field-label text-secondary">Last Name</div>
                                                <input name="field-name" placeholder="LastName" type="text"
                                                    wire:model='client_lastname'>
                                                @error('client_lastname')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6 col-12">
                                                <div class="field-label text-secondary">Phone</div>
                                                <input name="field-name" placeholder="Phone" type="text"
                                                    wire:model='client_phone'
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                                @error('client_phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-sm-6 col-12">
                                                <div class="field-label text-secondary">Email Address</div>
                                                <input name="field-name" placeholder="Email" type="text"
                                                    wire:model='client_email'>
                                                @error('client_email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            <div class="form-group col-sm-6 col-12">
                                                <div class="field-label text-secondary ">Password <span
                                                        style="color: gray ; font-size:10px">( To keep your data safe
                                                        )</span> </div>
                                                <input name="field-name" placeholder="Password" type="password"
                                                    wire:model='password'>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>

                                            <div class="form-group col-sm-6 col-12">
                                                <div class="field-label text-secondary">Repeat Password </div>
                                                <input name="field-name" placeholder="Repeat Password" type="password"
                                                    wire:model='password_confirmation'>
                                                @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>

                                            <div class="text-end"><a class="btn btn-default primary-btn radius-0"
                                                    Wire:click='Step1()'>Next</a>
                                            </div>
                                        @else
                                            <div class="row" style="color: rgb(60, 60, 60)">
                                                <div class="col-4">
                                                    <h3>{{ $client_firstname }} {{ $client_lastname }}
                                                    </h3>
                                                </div>
                                                <div class="col-8 mb-2">
                                                    <center>
                                                        <h3>{{ $client_phone }}</h3>
                                                    </center>
                                                </div>
                                            </div>
                                            <hr>
                                            @if ($shipping_type == 'shipping')
                                                @if ($new_address == true)
                                                    <div class="col-12">
                                                        <button class="btn btn-primary btn-sm mb-2" style="float: right"
                                                            wire:click='addAddress(0)'>Sellect Address</button>
                                                    </div>
                                                @else
                                                    <div class="col-12">
                                                        <button class="btn btn-primary btn-sm mb-2" style="float: right"
                                                            wire:click='addAddress(1)'>New Address</button>
                                                    </div>
                                                @endif
                                                @if ($new_address == true)

                                                    <div class="form-group col-md-6 col-sm-6 col-12">
                                                        <div class="field-label text-secondary">Town/City</div>
                                                        <input name="field-name" placeholder="Town/City" type="text"
                                                            wire:model='client_city' id="city_name">
                                                        <center>
                                                            <div class="dropdown-menu" aria-labelledby="citiesDrop"
                                                                id="citiesDrop"
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
                                                        <div class="field-label text-secondary">Quarter</div>
                                                        <input name="field-name" placeholder="Quartier" type="text"
                                                            wire:model='client_quarter' id="qaurter_name">
                                                        <center>
                                                            <div class="dropdown-menu" aria-labelledby="quartersDrop"
                                                                id="quartersDrop"
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
                                                        <div class="field-label text-secondary">Address</div>
                                                        <input name="field-name" placeholder="Street address"
                                                            type="text" wire:model='client_address'>
                                                        @error('client_address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>


                                                    @if (testMobile())
                                                        <div class="text-end">
                                                            <a class="btn btn-default primary-btn radius-0"
                                                                id='finishOrder'>Next</a>
                                                        </div>
                                                    @endif
                                                @else
                                                    <table class="table table-striped">

                                                        <tbody>
                                                            @foreach ($all_address as $address)
                                                                <tr>
                                                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                                                    <td>{{ $address->city->city }} ,
                                                                        {{ $address->quartier->quartier }} ,
                                                                        {{ $address->address }}</td>
                                                                    <td>
                                                                        <button
                                                                            class="btn @if ($address_id == $address->id) btn-success  @else btn-light @endif btn-sm border"
                                                                            wire:click="selectAddress({{ $address->id }})">
                                                                            Use
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>

                                                    @error('address_id')
                                                        <span class="text-danger">You have to select One address</span>
                                                    @enderror

                                                @endif
                                            @else
                                                <div class="col-12">
                                                    <div class="field-label text-secondary">Time</div>
                                                    <input name="field-name" class="form-control" type="time"
                                                        wire:model.defer='coming_time'>
                                                    @error('coming_time')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endif
                                            <div class=" col-12 mt-3">
                                                <div class="field-label text-secondary">Comment</div>
                                                <textarea wire:model='comment' class="form-control" cols="30" rows="10" style="min-height: 130px"></textarea>
                                                @error('comment')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>

                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-12">
                                    <div class="checkout-details">
                                        <div class="order-box">
                                            <div class="title-box">
                                                <div>Product <span>Total</span></div>
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
                                                                
                                                                <span>{{ $product['product']->price * $product['qte'] }}
                                                                    {{ $currency }}</span>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <ul class="sub-total">
                                                <li>Subtotal <span class="count">{{ $total }}
                                                        {{ $currency }}</span>
                                                </li>
                                                <li>Shipping
                                                    <div class="row mt-3">
                                                        <div class="col-6">
                                                            {{-- <input checked="checked" id="free-shipping"
                                                                name="shipping" type="radio"
                                                                wire:model='shipping_type' value='shipping'>
                                                            <label for="shipping">Ship it to me</label> --}}

                                                            <button
                                                                class="border btn @if ($shipping_type == 'shipping') btn-success @else  btn-light @endif "
                                                                style="width: 100%"
                                                                wire:click='changeDelivery("shipping")'>Ship it
                                                                to me</button>
                                                        </div>
                                                        <div class="col-6">

                                                            <button
                                                                class=" border btn @if ($shipping_type == 'coming') btn-success @else  btn-light @endif "
                                                                style="width: 100%"
                                                                wire:click='changeDelivery("coming")'>I'm
                                                                coming</button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul class="total">
                                                <li>Total <span class="count">{{ $total }}
                                                        {{ $currency }}</span></li>
                                            </ul>
                                        </div>
                                        <div class="payment-box">
                                            <div class="upper-box">
                                                <div class="payment-options">
                                                    <ul>

                                                        <li>
                                                            <div class="radio-option">
                                                                <input checked="checked" id="payment-2"
                                                                    name="payment-group" type="radio">
                                                                <label for="payment-2">Cash On Delivery<span
                                                                        class="small-text">Please send a check to
                                                                        Store Name, Store Street, Store Town, Store
                                                                        State / County, Store
                                                                        Postcode.</span></label>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>

                                            @if (Auth::guard('client')->check() == true and $step == 2)
                                                <div class="text-end"><a class="btn btn-default primary-btn radius-0"
                                                        Wire:click='Order()' id='submit'>Place
                                                        Order</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @if (!Auth::guard('client')->check())
            @livewire('client-login')
        @endif --}}
    </section>

</div>
@section('js')
    <script>
        $(document).ready(function() {
            Buttons();
            $('#modalLoginForm').modal('show')
            // $('#closeLogin').click(function() {
            //     $('#modalLoginForm').modal('hide')
            // })
            // window.addEventListener('login_success', event => {
            //     $('#modalLoginForm').modal('hide')
            //     Livewire.emit('renderFunc')
            // });
            // window.addEventListener('login_faild', event => {
            //     $.notify({
            //         message: event.detail.message ?? 'Phone Or Password Incorrect',
            //     }, {
            //         showProgressbar: true,
            //         type: "danger"
            //     });
            // });
        });

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
            $('#finishOrder').click(function() {
                var windowHeight = $(window).height();
                var position = $("#submit").offset().top - (windowHeight / 1.5);
                $("body, html").animate({
                    scrollTop: position
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
    </script>
@endsection
