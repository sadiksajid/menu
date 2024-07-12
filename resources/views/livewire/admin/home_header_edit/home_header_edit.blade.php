<div>
    <div class="row flex-lg-nowrap">
        <div class="col-12 mb-3">
            <div class="row">
                <div class='col-12 mb-4'>
                    <button class='btn btn-md btn-info' wire:click='addHeader'>
                    {{ $translations['add_slide'] }}
                    </button>
                </div>
                @foreach($keys as $key => $value )
                {{-- ///////////////////////////////////////////////////////////////////////////// --}}
                <div class="col-md-6 col-12">
                    <div class="e-panel card">
                        <div class="card-header">
                            <div class='col-4'>
                            <h3 class="card-title">{{ $translations['slide_n'] }}  {{ $loop->index + 1 }}</h3>
                            </div>

                            <div class='col-8'>
                                    <button class='btn btn-danger ' style='float:right'  wire:click="deleteSlide('{{$key}}')"> Delete</button>
                                </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @isset ($upload_image[$key])
                                <div class="col-12">

                                    <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                        @if ($to_delete_image_tm == $key)
                                        <button style="position: absolute;margin-left: 10px;"
                                            class="btn-sm btn-success mt-2"
                                            wire:click.prevent="delete_image_tm('{{ $key }}')"><i class="fa fa-check"
                                                data-toggle="tooltip"></i></button>
                                        <button style="position: absolute;margin-left: 50px;"
                                            class="btn-sm btn-danger mt-2"
                                            wire:click.prevent="no_delete_image_tm('{{ $key }}')"><i class="fa fa-times"
                                                data-toggle="tooltip" title=""
                                                data-original-title="fa fa-times"></i></button>
                                        @else

                                        <button style="position: absolute;margin-left: 10px;"
                                            class="btn-sm btn-danger mt-2"
                                            wire:click.prevent="to_delete_image_tm('{{ $key }}')">
                                            <i class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                data-original-title="fa fa-trash-o"></i></button>

                                        @endif

                                        <img src="{{ request()->getSchemeAndHttpHost() }}/livewire-tmp/{{ $upload_image[$key]->getFileName() }}"
                                            style="height: 100%;width:100%">

                                    </div>
                                </div>
                                @elseif (isset($image[$key]) and $image[$key] != '')
                                <div class="col-12">

                                    <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                        @if ($to_delete_image_edit == $key)
                                        <button style="position: absolute;margin-left: 10px;"
                                            class="btn-sm btn-success mt-2"
                                            wire:click.prevent="delete_image_edit('{{ $key }}')"><i class="fa fa-check"
                                                data-toggle="tooltip"></i></button>
                                        <button style="position: absolute;margin-left: 50px;"
                                            class="btn-sm btn-danger mt-2"
                                            wire:click.prevent="no_delete_image_edit('{{ $key }}')"><i class="fa fa-times"
                                                data-toggle="tooltip" title=""
                                                data-original-title="fa fa-times"></i></button>
                                        @else
                                        <button style="position: absolute;margin-left: 10px;"
                                            class="btn-sm btn-danger mt-2"
                                            wire:click.prevent="to_delete_image_edit('{{ $key }}')"><i class="fa fa-trash-o"
                                                data-toggle="tooltip" title=""
                                                data-original-title="fa fa-trash-o"></i></button>

                                        @endif
                                        <img src="{{ get_image($image[$key]) }}" style="height: 100%;width:100%">

                                    </div>
                                </div>
                                @else
                                <div class="col-12">

                                    <div class="dropify-wrapper" style="height: 210px">

                                        <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                            style="height: 100%;width:100%">
                                        <div class="dropify-loader">

                                        </div>

                                        <input type="file" class="dropify" wire:model.defer="upload_image.{{$key}}"
                                            data-height="210px">
                                        <div wire:loading wire:target="upload_image.{{$key}}">{{ $translations['uploading'] }}...
                                        </div>

                                    </div>
                                </div>
                                @endif

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-md-12 form-label">{{ $translations['title'] }} <span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['title'] }}"
                                        type="text" wire:model.defer='title.{{$key}}'>
                                    @error('title.'.$key)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="col-md-12 form-label">{{ $translations['meta'] }} <span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['meta'] }}"
                                        type="text" wire:model.defer='text.{{$key}}'>
                                    @error('text.'.$key)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <label class="col-md-12 form-label">{{ $translations['btn_text'] }}<span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['btn_text'] }}"
                                        type="text" wire:model.defer='btn_text.{{$key}}'>
                                    @error('btn_text.'.$key)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-8">
                                    <label class="col-md-12 form-label">{{ $translations['btn_link'] }}<span
                                            class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="{{ $translations['btn_link'] }}"
                                        type="text" wire:model.defer='btn_url.{{$key}}'>
                                    @error('btn_url.'.$key)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                         

                            </div>
                        </div>
                    </div>
                </div>
                {{-- ///////////////////////////////////////////////////////////////////////////// --}}
                @endforeach

                <div class="col-12">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>OMG!!! {{ $error }} Fix that!!!</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="col-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <button type="button" class="btn btn-primary"
                                    wire:click.prevent="Update()">{{ $translations['update'] }}
                                    <div wire:loading class="spinner-border text-light" role="status"
                                        style="width: 20px;height: 20px;">
                                        <span class="sr-only">{{ $translations['loading'] }} ...</span>
                                    </div>
                                </button>

                                <button type="button" class="btn btn-danger"
                                    wire:click.prevent="cancel()">{{ $translations['cancel'] }}</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>