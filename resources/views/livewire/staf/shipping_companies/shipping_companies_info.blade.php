<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/css/intlTelInput.css">
    <style>
    .form-checked-dark:checked {
        background-color: #343a40;
        border-color: #343a40;
    }
    </style>
    <div class="page-header">
        <div>
            <h4 class="page-title mb-0">{{$translations['shipping_companies']}}</h4>
        </div>
    </div>
    <div class="row flex-lg-nowrap">
        <div class="col-12 mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="e-panel card">
                        <div class="card-body">
                            <h4 style='float: left;margin: 0;'>{{ $translations['status'] }}</h4>
                            <div class="form-check form-switch">
                                <input class="form-check-input form-checked-dark "
                                    style='width: 100px;height: 30px;transition: 1s;right: 0; margin-top: -1px;'
                                    type="checkbox" role="switch" id="switch-warning" checked=""
                                    wire:model.defer='company_status'>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 col-12">
                    <div class="e-panel card" style='height: 93%;'>
                        <div class="card-header">
                            <h3 class="card-title"> {{ $translations['shipping_company_info'] }} </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label class="col-md-12 form-label">{{ $translations['company_name'] }} <span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['company_name'] }}"
                                        type="text" wire:model.defer='company_name'>
                                    @error('company_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="col-md-12 form-label">{{ $translations['company_tag'] }} <span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['company_tag'] }}"
                                        type="text" wire:model.defer='company_tag'
                                        oninput="this.value = this.value.replace(/[^a-z0-9_]/g, '')">
                                    @error('company_tag')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="col-md-12 form-label">{{ $translations['company_url'] }} <span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['company_url'] }}"
                                        type="text" wire:model.defer='company_url'>
                                    @error('company_url')
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
                            <h3 class="card-title"> {{ $translations['company_logo'] }} </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12" wire:ignore>

                                    <input type="file" class="dropify" wire:model="company_logo">

                                </div>
                                @error('company_logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="e-panel card">
                        <div class="card-header" style='display: flex;justify-content: space-between;'>
                            <h3 class="card-title"> {{ $translations['contact_info'] }} </h3>
                            <button class='btn btn-dark btn-sm' wire:click="addInfo">+</button>
                        </div>
                        <div class="card-body">
                            <div class="row" id='company_contact_info_list'>
                                @if($this->mode_type == 'add')
                                <div class='col-4 border-right company_contact_info_div'>
                                    <div class='row'>
                                        <div class="col-4 pr-0">
                                            <label class="col-md-12 form-label">{{ $translations['type'] }} <span
                                                    class="text-red">*</span></label>
                                            <select class="form-control" wire:model.defer="company_contact_type.0">
                                                @foreach($company_contact_types as $type)
                                                <option value="{{$type}}">{{$type}}</option>
                                                @endforeach
                                            </select>
                                            @error('company_contact_type[0]')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-8">
                                            <label class="col-md-12 form-label">{{ $translations['info'] }} <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="{{ $translations['info'] }}"
                                                type="text" wire:model.defer='company_contact_info.0'>
                                            @error('company_contact_info[0]')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class='col-4 border-right company_contact_info_div'>
                                    <div class='row'>
                                        <div class="col-4 pr-0">
                                            <label class="col-md-12 form-label">{{ $translations['type'] }} <span
                                                    class="text-red">*</span></label>
                                            <select class="form-control" wire:model.defer="company_contact_type.1">
                                                @foreach($company_contact_types as $type)
                                                <option value="{{$type}}">{{$type}}</option>
                                                @endforeach
                                            </select>
                                            @error('company_contact_type[1]')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-8">
                                            <label class="col-md-12 form-label">{{ $translations['info'] }} <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="{{ $translations['info'] }}"
                                                type="text" wire:model.defer='company_contact_info.1'>
                                            @error('company_contact_info[1]')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @foreach($company_contact_arr as $key)
                                <div class='col-4 border-right company_contact_info_div'>
                                    <div class='row'>
                                        <div class="col-4 pr-0">
                                            <label class="col-md-12 form-label">{{ $translations['type'] }} <span
                                                    class="text-red">*</span></label>
                                            <select class="form-control"
                                                wire:model.defer="company_contact_type.{{$key}}">
                                                @foreach($company_contact_types as $type)
                                                <option value="{{$type}}">{{$type}}</option>
                                                @endforeach
                                            </select>
                                            @error('company_contact_type[1]')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-8">
                                            <label class="col-md-12 form-label">{{ $translations['info'] }} <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="{{ $translations['info'] }}"
                                                type="text" wire:model.defer='company_contact_info.{{$key}}'>
                                            @error('company_contact_info.$key')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-12" wire:ignore>
                    <div class="e-panel card">
                        <div class="card-header" style='display: flex;justify-content: space-between;'>
                            <h3 class="card-title"> {{ $translations['company_location'] }} </h3>
                        </div>
                        <div class="card-body">
                            <div class="row" id='company_contact_info_list'>
                                <div class=" col-md-4 col-12">
                                    <label class="col-md-12 form-label">{{ $translations['country'] }} <span
                                            class="text-red">*</span></label>
                                    <select class="form-control" id='country_select2'
                                        wire:model="company_contact_country" wire:change='getCities'>
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('company_contact_country')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" id='company_contact_info_list'>
                                <div class="col-12">
                                    <label class="col-md-12 form-label">{{ $translations['cities'] }} <span
                                            class="text-red">*</span></label>
                                    <select class="form-control " id='city_select2' wire:model="company_contact_cities"
                                        multiple="multiple">
                                        @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->city}}</option>
                                        @endforeach
                                    </select>
                                    @error('company_contact_cities')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="e-panel card">
                        <div class="card-header" style='display: flex;justify-content: space-between;'>
                            <h3 class="card-title"> {{ $translations['company_location'] }} </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-md-12 form-label">{{ $translations['user_name'] }} <span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['user_name'] }}"
                                        type="text" wire:model.defer='company_user_name'>
                                    @error('company_user_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="col-md-12 form-label">{{ $translations['password'] }} <span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['password'] }}"
                                        type="text" wire:model.defer='company_user_password'>
                                    @error('company_user_password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="col-md-12 form-label">{{ $translations['token'] }} <span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['token'] }}"
                                        type="text" wire:model.defer='company_token'>
                                    @error('company_token')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <button class='btn btn-orange' wire:click='UpdateCompany'>{{ $translations['save'] }} 
                            <span wire:loading.class.remove="d-none" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>

                <div class="col-md-5 col-12">
                    <div class="e-panel card">
                        <div class="card-header" style='display: flex;justify-content: space-between;'>
                            <h3 class="card-title"> {{ $translations['company_working_time'] }} </h3>
                        </div>
                        <div class="card-body">
                            <div class="row" id='company_time_info_list'>
                                @foreach($translations['weekdays'] as $day )
                                <div class="col-12">
                                    <label class="col-md-12 form-label border-top mt-2">{{ $day }} </label>
                                    <div class="row">
                                        <div class='col-2'>
                                            <p style='margin-top: 8px;margin-bottom: 0;'>{{ $translations['from'] }}
                                            </p>
                                        </div>
                                        <div class='col-4'>
                                            <input class="form-control" placeholder="{{ $translations['from'] }}"
                                                type="time" wire:model.defer='company_working_from.{{$day}}'>
                                        </div>
                                        <div class='col-2'>
                                            <p style='margin-top: 8px;margin-bottom: 0;'>{{ $translations['to'] }}
                                            </p>
                                        </div>
                                        <div class='col-4'>
                                            <input class="form-control" placeholder="{{ $translations['to'] }}"
                                                type="time" wire:model.defer='company_working_to.{{$day}}'>
                                        </div>
                                    </div>
                                    @error('company_contact_country')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @endforeach
                            </div>
                        </div>
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
$(document).ready(function() {
    // $('#company_contact_info_add').on('click', function() {
    //     var count = $('.company_contact_info_div').length;

    //     const contact_input = `
    //         <div class='col-4  border-right company_contact_info_div'>
    //             <div class='row'>
    //                 <div class="col-4 pr-0">
    //                     <label class="col-md-12 form-label">{{ $translations['type'] }} <span
    //                             class="text-red">*</span></label>
    //                     <select class="form-control" wire:model="company_contact_type.${count}">
    //                         @foreach($company_contact_types as $type)
    //                         <option value="{{$type}}">{{$type}}</option>
    //                         @endforeach
    //                     </select>
    //                     @error('company_contact_type[${count}]')
    //                     <span class="text-danger">{{ $message }}</span>
    //                     @enderror
    //                 </div>
    //                 <div class="col-8">
    //                     <label class="col-md-12 form-label">{{ $translations['info'] }} <span
    //                             class="text-red">*</span></label>
    //                     <input class="form-control mb-4" placeholder="{{ $translations['info'] }}"
    //                         type="text" wire:model='company_contact_info.${count}'
    //                         oninput="this.value = this.value.replace(/[^a-z0-9_]/g, '')">
    //                     @error('company_contact_info[${count}]')
    //                     <span class="text-danger">{{ $message }}</span>
    //                     @enderror
    //                 </div>
    //             </div>
    //         </div>        
    //     `
    //     $('#company_contact_info_list').append(contact_input);
    //     @this.company_contact_infop[count] = '';
    // });


    $('#city_select2').select2();
    $('#country_select2').select2();


});


window.addEventListener('cities_options', event => {
    cities = event.detail.cities
    $("#city_select2")
        .empty()
        .append($.map(cities, (v, k) => $("<option>").val(v['id']).text(v['city'])));
});
</script>


<script>
$(document).ready(
    function() {
        fileUpload();
        var logo = @json($company_logo_url);
        if (logo != "") {

            logo = @json(get_image($company_logo_url));

            var dropifyInput = $('.dropify-render');

            $('.dropify-preview').addClass('d-block')
            $('.dropify-loader').addClass('d-none')
            $('.dropify-wrapper').addClass('has-preview')


            dropifyInput.html('<img src="' + logo +
                '" style="max-height: 150px;" onerror="this.onerror=null;this.src=\'https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg\';"  >'
            );

        }

        
        $('#city_select2').on('change', function() {
            @this.company_contact_cities = $(this).val()
        });

    }
)


</script>
@endsection