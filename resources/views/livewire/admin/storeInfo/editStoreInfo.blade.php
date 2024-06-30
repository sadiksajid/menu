<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/css/intlTelInput.css">

    <div class="row flex-lg-nowrap">
        <div class="col-12 mb-3">
            <div class="row">

                <div class="col-md-7 col-12">
                    <div class="e-panel card">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $translations['store_info'] }} </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label class="col-md-12 form-label">{{ $translations['store_name'] }} <span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['store_name'] }}"
                                        type="text" wire:model.defer='title'>
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="col-md-12 form-label">{{ $translations['store_tag'] }} <span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['store_tag'] }}"
                                        type="text" wire:model.defer='store_meta'
                                        oninput="this.value = this.value.replace(/[^a-z0-9_]/g, '')">
                                    @error('store_meta')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="col-md-12 form-label">{{ $translations['sub_title'] }} <span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['sub_title'] }}"
                                        type="text" wire:model.defer='s_title'>
                                    @error('s_title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="col-md-12 form-label">{{ $translations['description'] }}<span
                                            class="text-red">*</span></label>
                                    <textarea class="form-control mb-4" placeholder="{{ $translations['description'] }}"
                                        wire:model.defer='description' style="height: 200px"></textarea>
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 col-12">
                    <div class="e-panel card">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $translations['store_logo'] }} </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12" wire:ignore>
                                    <!-- <div class="dropify-wrapper" style="height:auto;border: none;">
                                            @if (isset($edit_logo) and $edit_logo != null)
                                            <img src="{{ request()->getSchemeAndHttpHost() }}/livewire-tmp/{{ $edit_logo->getFileName() }}"
                                                style="height: 100%;width:100%">
                                            @elseif(isset($logo) and !empty($logo))
                                            <img src="{{ get_image($logo) }}"
                                                style="height: 100%;width:100%"
                                                >
                                            @else
                                            <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                style="height: 100%;width:100%">
                                            @endif

                                            <div class="dropify-loader">

                                            </div>

                                            <input type="file" class="dropify" wire:model.defer="edit_logo" data-height="210">
                                        </div> -->

                                    <input type="file" class="dropify" wire:model="edit_logo" data-height="370px">

                                </div>
                                @error('edit_logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>



                <div class='col-md-6 col-12'>
                    <div class='row'>
                        <div class="col-12">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title"> {{ $translations['contact_info'] }} </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div wire:ignore>
                                                <label class="col-md-12 form-label">{{ $translations['phone'] }} <span
                                                        class="text-red">*</span></label>
                                                <input class="form-control mb-4 " type="tel" required id='phone'
                                                    wire:model.defer='phone' />
                                            </div>

                                            @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div wire:ignore>
                                                <label class="col-md-12 form-label">{{ $translations['phone'] }} 2 <span
                                                        class="text-red">*</span></label>
                                                <input class="form-control mb-4 " type="tel" required id='phone2'
                                                    wire:model.defer='phone2' />
                                            </div>

                                            @error('phone2')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 mt-2">
                                            <label class="col-md-12 form-label">{{ $translations['email'] }} <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="{{ $translations['email'] }}"
                                                type="text" wire:model.defer='email'>
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title"> {{ $translations['social_media'] }} </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-6 col-12 mt-2">
                                            <label class="col-md-12 form-label">Facebook <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="Facebook" type="text"
                                                wire:model.defer='facebook'>
                                            @error('facebook')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 col-12 mt-2">
                                            <label class="col-md-12 form-label">Instagram <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="Instagram" type="text"
                                                wire:model.defer='instagram'>
                                            @error('instagram')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 col-12 mt-2">
                                            <label class="col-md-12 form-label">TikTok <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="TikTok" type="text"
                                                wire:model.defer='tiktok'>
                                            @error('tiktok')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $translations['store_colors'] }} </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label
                                                        class="col-md-12 form-label">{{ $translations['buttons_color'] }}
                                                    </label>
                                                    <input class="form-control mb-4"
                                                        placeholder="{{ $translations['buttons_color_test'] }}"
                                                        type="text" wire:model.defer='btn_color'>

                                                </div>
                                                <div class="col-4">
                                                    <label
                                                        class="col-md-12 form-label">{{ $translations['buttons_view'] }}</label>
                                                    <button class="btn btn-md btn-info"
                                                        style="background-color:{{$btn_color}}">
                                                        {{ $translations['button_test'] }}
                                                    </button>

                                                </div>
                                                <div class="col-12">
                                                    @error('btn_color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label class="col-md-12 form-label">
                                                        {{ $translations['text_color'] }}
                                                    </label>
                                                    <input class="form-control mb-4"
                                                        placeholder="{{ $translations['buttons_color_test'] }}"
                                                        type="text" wire:model.defer='text_color'>

                                                </div>
                                                <div class="col-4">
                                                    <label
                                                        class="col-md-12 form-label">{{ $translations['text_view'] }}</label>
                                                    <h3 class='mt-1' style="color:{{$text_color}}">
                                                        {{ $translations['text_test'] }}
                                                    </h3>

                                                </div>
                                                <div class="col-12">
                                                    @error('text_color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label class="col-md-12 form-label">
                                                        {{ $translations['background_color'] }} </label>
                                                    <input class="form-control mb-4"
                                                        placeholder="{{ $translations['buttons_color_test'] }}"
                                                        type="text" wire:model.defer='background_color'>

                                                </div>
                                                <div class="col-4">
                                                    <label
                                                        class="col-md-12 form-label">{{ $translations['background_view'] }}
                                                    </label>
                                                    <button class="btn btn-md btn-info"
                                                        style="background-color:{{$background_color}}">
                                                        {{ $translations['background_test'] }}
                                                    </button>
                                                </div>
                                                <div class="col-12">
                                                    @error('background_color')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-md-6 col-12">
                    <div class="col-12">
                        <div class="e-panel card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $translations['store_location'] }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if(!empty($regions))
                                    <div class="col-6">
                                        <div wire:ignore>
                                            <label class="col-md-12 form-label">{{ $translations['region'] }}<span
                                                    class="text-red">*</span></label>
                                            <select class="form-control" wire:model.defer="region_id"
                                                id="region_select2">
                                                @foreach ($regions as $region)
                                                <option value="{{ $region['id'] }}">{{ $region['region'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('region_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <div wire:ignore>
                                            <label class="col-md-12 form-label">{{ $translations['city'] }}<span
                                                    class="text-red">*</span></label>
                                            <select class="form-control" wire:model.defer="city_id" id="city_select2">
                                                @foreach ($cities as $city)
                                                <option value="{{ $city['id'] }}">{{ $city['city'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('city_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @else
                                    <div class="col-6">
                                        <label class="col-md-12 form-label">{{ $translations['city'] }} <span
                                                class="text-red">*</span></label>
                                        <input class="form-control mb-4" placeholder="{{ $translations['city'] }}"
                                            type="text" wire:model.defer='city_name'>
                                        @error('city_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @endif
                                    <div class="col-6">
                                        <label class="col-md-12 form-label">{{ $translations['quartier'] }} <span
                                                class="text-red">*</span></label>
                                        <input class="form-control mb-4" placeholder="{{ $translations['quartier'] }}"
                                            type="text" wire:model.defer='quartier'>
                                        @error('quartier')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label class="col-md-12 form-label">{{ $translations['post_code'] }}<span
                                                class="text-red">*</span></label>
                                        <input class="form-control mb-4" placeholder="{{ $translations['post_code'] }}"
                                            type="text" wire:model.defer='post_code'>
                                        @error('post_code')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="col-md-12 form-label">{{ $translations['full_address'] }} <span
                                                class="text-red">*</span></label>
                                        <input class="form-control mb-4"
                                            placeholder="{{ $translations['full_address'] }}" type="text"
                                            wire:model.defer='address'>
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">

                                        <button class="btn btn-info" wire:click="showMaps">
                                            {{ $translations['edit_location'] }} <i class="zmdi zmdi-pin"
                                                data-toggle="tooltip" title="" data-original-title="zmdi zmdi-pin"
                                                @if(!empty($edit_longitude)) style="color: #00ff08" @endif></i></button>

                                    </div>

                                    <div class="col-12  mt-3 mb-3">
                                        <!-- Modal -->
                                        <div class="modal fade" id="map_modal" tabindex="-1" role="dialog"
                                            aria-labelledby="map_modalTitle" aria-hidden="true" wire:ignore>
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header p-1">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">
                                                            {{ $translations['edit_location'] }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <div id="map-wrapper" class="divMap">

                                                            <div class="spinner-grow text-primary" role="status"
                                                                style="width: 158px;height: 150px;color: #bf1c3d !important;margin-left: 40%;margin-top: 15%;">
                                                                <span
                                                                    class="sr-only">{{ $translations['loading'] }}...</span>
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
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="e-panel card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $translations['store_status'] }} </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="custom-switch" style=" cursor:pointer ">
                                            <input type="checkbox" name="custom-switch-checkbox"
                                                wire:model.defer='status' class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">{{ $translations['status'] }}</span>
                                        </label>
                                        @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <label class="custom-switch" style=" cursor:pointer ">
                                            <input type="checkbox" name="custom-switch-checkbox"
                                                wire:model.defer='shipping' class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span
                                                class="custom-switch-description">{{ $translations['shipping'] }}</span>
                                        </label>
                                        @error('shipping')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <label class="custom-switch" style=" cursor:pointer ">
                                            <input type="checkbox" name="custom-switch-checkbox"
                                                wire:model.defer='preorder' class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">{{ $translations['pre_order'] }}
                                            </span>
                                        </label>
                                        @error('preorder')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-12">
                    <div class="col-12">
                        <button class="btn btn-success btn-lg" wire:click="updateInfo" style='width:30%'>
                            {{ $translations['save'] }}
                            <i wire:loading.class.add='d-none' class="zmdi zmdi-save" data-toggle="tooltip" title=""
                                data-original-title="zmdi zmdi-save"></i>
                            <span wire:loading style="height: 20px;width:20px;transition: 0.5s;margin-right: 10px;"
                                class="spinner-border spinner-border-sm ml-3"></span>
                        </button>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@section('js')
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>

<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}?v=3"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}?v=6"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}?v=3"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}?v=6"></script>
<script>
window.addEventListener('StoreInfoModal', event => {
    var status = event.detail.status;
    $('#map_modal').modal(status);
});
</script>

<script>
$(document).ready(function() {
    $('#region_select2').select2();
    $('#region_select2').on('change', function(e) {
        var data = $('#region_select2').select2("val");
        @this.set('region_id', data);
        Livewire.emit('getCity');
    });
    $('#city_select2').select2();
    $('#city_select2').on('change', function(e) {
        var data = $('#city_select2').select2("val");
        @this.set('city_id', data);
    });
});
window.addEventListener('cities_options', event => {
    cities = event.detail.cities
    $("#city_select2")
        .empty()
        .append($.map(cities, (v, k) => $("<option>").val(v['id']).text(v['city'])));
});
</script>

<script>
$(document).ready(function() {
    const phone = document.querySelector("#phone");
    const phone2 = document.querySelector("#phone2");


    var iti_phone = window.intlTelInput(phone, {
        initialCountry: "auto",
        geoIpLookup: callback => {
            fetch("https://ipapi.co/json")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("us"));
        },


        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/utils.js?1716383386062" // just for formatting/placeholders etc
    });


    // function updateInputValue() {
    //     // Ensure the input field has a value
    //     var phoneValue = phone.value.trim();
    //     if (phoneValue !== '') {
    //         if (iti_phone.isValidNumber()) {
    //             var fullPhoneNumber = iti_phone.getNumber();
    //             console.log("Full Phone Number:", fullPhoneNumber); // Log the full phone number for debugging
    //             phone.value = fullPhoneNumber; // Update the input field with the full phone number
    //         } else {
    //             console.log("Invalid phone number");
    //             phone.value = 'none';
    //         }

    //     } else {
    //         console.log("Phone input is empty");
    //     }
    // }
    /////////////////////////////////////////////////////////


    var iti_phone2 = window.intlTelInput(phone2, {
        initialCountry: "auto",
        geoIpLookup: callback => {
            fetch("https://ipapi.co/json")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("us"));
        },


        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/utils.js?1716383386062" // just for formatting/placeholders etc
    });


    function updateInputValue(iti, pho) {
        // Ensure the input field has a value
        var phoneValue = pho.value.trim();
        if (phoneValue !== '') {
            if (iti.isValidNumber()) {
                var fullPhoneNumber = iti.getNumber();
                console.log("Full Phone Number:", fullPhoneNumber); // Log the full phone number for debugging
                pho.value = fullPhoneNumber; // Update the input field with the full phone number
                return fullPhoneNumber;
            } else {
                console.log("Invalid phone number");
                pho.value = 'none';
            }

        } else {
            console.log("Phone input is empty");
        }
    }




    // $('#submit_login').on('click', function() {
    //     updateInputValue();
    //     getCountryName();
    //     document.getElementById('Login').submit();
    // });


    $('#phone').on('blur', function() {
        @this.phone = updateInputValue(iti_phone, phone);
    });
    $('#phone2').on('blur', function() {
        @this.phone2 = updateInputValue(iti_phone2, phone2);
    });
});
</script>


<script>
$(document).ready(
    function() {
        fileUpload();
        var logo = @json($logo);
        if (logo != "") {

            logo = @json(get_image($logo));
            console.log(logo)

            var dropifyInput = $('.dropify-render');

            $('.dropify-preview').addClass('d-block')
            $('.dropify-loader').addClass('d-none')
            $('.dropify-wrapper').addClass('has-preview')


            dropifyInput.html('<img src="' + logo +
                '" style="max-height: 150px;" onerror="this.onerror=null;this.src=\'https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg\';"  >'
            );

        }

    }
)


// window.addEventListener('edit_category', event => {


//     fileUpload();

//     var dropifyInput = $('.dropify-render');

//     $('.dropify-preview').addClass('d-block')
//     $('.dropify-loader').addClass('d-none')
//     $('.dropify-wrapper').addClass('has-preview')


//     dropifyInput.html('<img src="' + event.detail.cat_image +
//         '" style="max-height: 150px;" onerror="this.onerror=null;this.src=\'https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg\';"  >'
//     );

//     $('#cat_title').val(event.detail.cat_title);
//     $('#cat_sort').val(event.detail.cat_sort);
//     $('#cat_sub_title').val(event.detail.cat_sub_title);

//     $('#modalUpdateCategory').modal('show');

// })
</script>
@endsection