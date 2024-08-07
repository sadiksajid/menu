<div>
    <div class='row mt-2' style=' justify-content: space-evenly;'>
        
        @if($map_mode == false)
        <div class='col-md-6 col-12'>
            <div class="card">
                <div class="card-body">
                    <div class='row'>
                        <div class='col-12' style='text-align: center;'>
                            <img class="mb-4" src="{{get_image($company_info->logo)}}" alt="" height="72">
                            <h1 class="h3 mb-3 font-weight-normal">{{$translations['your_business_information']}}</h1>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($integration_info['config']['inputs'] as $key => $input)
                        @if($input['label'] != 'hidden')
                        <div class="{{$input['col']}} mt-2">
                            <label>{{ $translations[$input['label']]}}</label>
                            <input type="{{$input['type']}}" class="form-control"
                                placeholder="{{ $translations[$input['label']]}}"
                                @if($input_value[$key] != null )
                                    value="{{$input_value[$key]}}"
                                    disabled="disabled"
                                @else
                                    wire:model.defer="input_value.{{$key}}" 
                                @endif
                                >
                            @error("input_value.".$key)
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @endif
                        @endforeach
                        <div class="col-12 mt-6">
                            <button class="btn btn-lg btn-dark btn-block" wire:click="Step1">
                                @isset($integration_info['config']['inputs_2'])
                                {{$translations['next']}}
                                @else
                                {{$translations['start']}}
                                @endisset

                                <div class='loading-div d-none' wire:loading.class.remove="d-none" style='position: absolute;top: 10px;right: 30px;'>
                                    <div class="spinner-border text-light" role="status"
                                        style='width:30px;height:30px;float:right'>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class='col-12' wire:ignore>
            <div id="map-wrapper" class="divMap h-100" style='text-align: center;'>

                <div class="spinner-border text-dark" role="status"
                    style="width: 60px;height: 60px;margin-top: 10%;margin-bottom: 10%;">
                    <span class="sr-only">{{ $translations['loading'] }}...</span>
                </div>

            </div>
        </div>
        <div class="col-12 mt-4">
            <button class="btn btn-lg btn-dark btn-block" wire:click="MapStep()">
                @if($this->input_value['longitude'] != null)
                    {{$translations['start']}}
                @else
                    {{$translations['order_detail_message_1']}}
                @endif

                <div class='loading-div d-none' wire:loading.class.remove="d-none" style='position: absolute;top: 10px;right: 30px;'>
                    <div class="spinner-border text-light" role="status"
                        style='width:30px;height:30px;float:right'>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </button>

        </div>
        @endif
    </div>
</div>

@section('js')
@if($map_mode)
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
@endif


@endsection