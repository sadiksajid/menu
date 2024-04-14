<div class="row flex-lg-nowrap">
    <div class="col-12 mb-3">
        <div class="row">
            <div class="col-md-7 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="e-panel card">
                            <div class="card-header">
                                <h3 class="card-title">Store info </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="col-md-12 form-label">Store Name <span
                                                class="text-red">*</span></label>
                                        <input class="form-control mb-4" placeholder="Title" type="text"
                                            wire:model='title'>
                                        @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="col-md-12 form-label">Sub Title <span
                                                class="text-red">*</span></label>
                                        <input class="form-control mb-4" placeholder="Sub Title" type="text"
                                            wire:model='s_title'>
                                        @error('s_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="col-md-12 form-label">Description<span
                                                class="text-red">*</span></label>
                                        <textarea class="form-control mb-4" placeholder="Description"
                                            wire:model='description' style="height: 200px"></textarea>
                                        @error('description')
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
                                <h3 class="card-title">Store Colors </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-8">
                                                <label class="col-md-12 form-label">Button Color </label>
                                                <input class="form-control mb-4" placeholder="Color hex or Name" type="text"
                                                    wire:model='btn_color'>

                                            </div>
                                            <div class="col-4">
                                                <label class="col-md-12 form-label">Button View </label>
                                                <button class="btn btn-md btn-info" style="background-color:{{$btn_color}}">
                                                    Button Test
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
                                                <label class="col-md-12 form-label">Text Color </label>
                                                <input class="form-control mb-4" placeholder="Color hex or Name" type="text"
                                                    wire:model='text_color'>

                                            </div>
                                            <div class="col-4">
                                                <label class="col-md-12 form-label">text View</label>
                                                <h3 class='mt-1' style="color:{{$text_color}}">
                                                    Text Test
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
                                                <label class="col-md-12 form-label">Background Color </label>
                                                <input class="form-control mb-4" placeholder="Color hex or Name" type="text"
                                                    wire:model='background_color'>

                                            </div>
                                            <div class="col-4">
                                                <label class="col-md-12 form-label">Background View </label>
                                                <button class="btn btn-md btn-info" style="background-color:{{$background_color}}">
                                                    background Test
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
                    <div class="col-12">
                        <div class="e-panel card">
                            <div class="card-header">
                                <h3 class="card-title">Store Status </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="custom-switch" style=" cursor:pointer ">
                                            <input type="checkbox" name="custom-switch-checkbox" wire:model='status'
                                                class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Status</span>
                                        </label>
                                        @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <label class="custom-switch" style=" cursor:pointer ">
                                            <input type="checkbox" name="custom-switch-checkbox" wire:model='shipping'
                                                class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Shipping</span>
                                        </label>
                                        @error('shipping')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-4">
                                        <label class="custom-switch" style=" cursor:pointer ">
                                            <input type="checkbox" name="custom-switch-checkbox" wire:model='preorder'
                                                class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Pre Order</span>
                                        </label>
                                        @error('preorder')
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
                                <h3 class="card-title">Store Location</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-6" wire:ignore>
                                        <label class="col-md-12 form-label">Region<span
                                                class="text-red">*</span></label>
                                        <select class="form-control" wire:model="region_id" id="region_select2">
                                            @foreach ($regions as $region)
                                            <option value="{{ $region['id'] }}">{{ $region['region'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('region_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-6" wire:ignore>
                                        <label class="col-md-12 form-label">City<span class="text-red">*</span></label>
                                        <select class="form-control" wire:model="city_id" id="city_select2">
                                            @foreach ($cities as $city)
                                            <option value="{{ $city['id'] }}">{{ $city['city'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="col-md-12 form-label">Quartier<span
                                                class="text-red">*</span></label>
                                        <input class="form-control mb-4" placeholder="Quartier" type="text"
                                            wire:model='quartier'>
                                        @error('quartier')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="col-md-12 form-label">Post Code<span
                                                class="text-red">*</span></label>
                                        <input class="form-control mb-4" placeholder="Post Code" type="text"
                                            wire:model='post_code'>
                                        @error('post_code')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="col-md-12 form-label">Full Address<span
                                                class="text-red">*</span></label>
                                        <input class="form-control mb-4" placeholder="Address" type="text"
                                            wire:model='address'>
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">

                                        <button class="btn btn-info" wire:click="showMaps">Edit Location <i
                                                class="zmdi zmdi-pin" data-toggle="tooltip" title=""
                                                data-original-title="zmdi zmdi-pin" @if (!empty($edit_longitude))
                                                style="color: #00ff08" @endif></i></button>

                                    </div>

                                    <div class="col-12  mt-3 mb-3">
                                        <!-- Modal -->
                                        <div class="modal fade" id="map_modal" tabindex="-1" role="dialog"
                                            aria-labelledby="map_modalTitle" aria-hidden="true" wire:ignore>
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header p-1">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title
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
                                                                <span class="sr-only">Loading...</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer p-1">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary"
                                                            wire:click="saveLocation">Save
                                                            changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="e-panel card">
                            <div class="card-header">
                                <h3 class="card-title">Store Logo </h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="dropify-wrapper" style="height:auto;border: none;">
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

                                            <input type="file" class="dropify" wire:model="edit_logo" data-height="210">
                                        </div>
                                        @error('edit_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="col-12">
                    <button class="btn btn-success" wire:click="updateInfo">Save Changes <i class="zmdi zmdi-save"
                            data-toggle="tooltip" title="" data-original-title="zmdi zmdi-save"></i></button>
                </div>
            </div>

        </div>

    </div>

</div>

<script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js') }}"></script>

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