<div>
    <div class="row flex-lg-nowrap">
        <div class="col-12 mb-3">

            {{-- //////////////////////////////////////////////////////////////////////////// --}}
            <div class="row">
                @if($editProduct)
                <div class="col-12">
                    <button class="btn btn-danger float-right mb-3" wire:click='DeleteProduct()'>
                        {{ $translations['delete_product'] }}
                    </button>
                </div>
                @endif
                <div class="col-md-7 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $translations['product_info'] }} </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="col-md-12 form-label">{{ $translations['product_title'] }}
                                                <span class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="Title" type="text"
                                                wire:model='title'>
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            @error('product_meta')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label class="col-md-12 form-label">{{ $translations['description'] }}<span
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
                                <div class="card-body">
                                    @if (!$newCategory)

                                    <div class="row">
                                        <div class="col-10">
                                            <label class="col-md-12 form-label">{{ $translations['category'] }}<span
                                                    class="text-red">*</span></label>
                                            @if (count($categories) == 0)
                                            <input class="form-control mb-4" type="text"
                                                value="{{ $translations['no_category_found'] }}" readonly>
                                            @else
                                            <select class="form-control" wire:model="category_id">
                                                @foreach ($categories as $category)
                                                <option value="{{ $category['id'] }}">{{ $category['title'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('form-control')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            @endif
                                        </div>
                                        <div class="col-2">
                                            <label class="col-md-12 form-label">.</label>
                                            <button type="button" class="btn btn-icon btn-info mb-4 float-right"
                                                wire:click="newCategory()">
                                                <span wire:loading wire:target="newCategory"
                                                    style="height: 20px;width:20px;transition: 0.5s;margin-right: 10px;"
                                                    class="spinner-border spinner-border-sm ml-3"></span>
                                                <i class="fe fe-plus" wire:loading.remove wire:target="newCategory"></i>
                                            </button>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <label class="col-md-12 form-label">{{ $translations['price'] }}<span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="Price" type="number"
                                                pattern="[0-9]+([\.,][0-9]+)?" step="0.01" wire:model='price'>
                                            @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <label class="col-md-12 form-label">{{ $translations['status'] }} <span
                                                    class="text-red">*</span></label>
                                            <label class="custom-switch" style=" cursor:pointer ;padding: 8px; ">
                                                <input type="checkbox" name="custom-switch-checkbox" wire:model='status'
                                                    class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                            @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-6">
                                            <label class="col-md-12 form-label">{{ $translations['add_to_menu'] }} <span
                                                    class="text-red">*</span></label>
                                            <label class="custom-switch" style=" cursor:pointer ;padding: 8px;">
                                                <input type="checkbox" name="custom-switch-checkbox"
                                                    wire:model='to_menu' class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                            @error('to_menu')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="row">

                                    <div class="col-md-7 col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label
                                                    class="col-md-12 form-label">{{ $translations['category_title'] }}
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="Category" type="text"
                                                    wire:model='cat_title'>
                                                @error('cat_title')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label class="col-md-12 form-label">{{ $translations['sub_title'] }}
                                                </label>

                                                <textarea class="form-control mb-4" rows="3"
                                                    wire:model='cat_s_title'></textarea>
                                                @error('cat_s_title')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-12">
                                        <label
                                            class="col-md-12 form-label">{{ $translations['category_image'] }}</label>

                                        <div class="dropify-wrapper" style="height:auto;border: none;">
                                            @if (isset($cat_image) and $cat_image != null)
                                            <img src="{{ request()->getSchemeAndHttpHost() }}/livewire-tmp/{{ $cat_image->getFileName()  ?? null  }}"
                                                style="height: 100%;width:100%">
                                            @else
                                            <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                style="height: 100%;width:100%">
                                            @endif

                                            <div class="dropify-loader">

                                            </div>

                                            <input type="file" class="dropify" wire:model="cat_image" data-height="210">
                                        </div>
                                        @error('cat_image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-icon btn-primary mb-4 "
                                            wire:click="submitCategory()">
                                            <span wire:loading wire:target="submitCategory"
                                                style="height: 20px;width:20px;transition: 0.5s;margin-right: 10px;"
                                                class="spinner-border spinner-border-sm ml-3"></span>
                                            <span wire:loading.remove
                                                wire:target="submitCategory">{{ $translations['save'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-icon btn-danger mb-4 "
                                            wire:click="cancelCategory()">
                                            <span wire:loading wire:target="cancelCategory"
                                                style="height: 20px;width:20px;transition: 0.5s;margin-right: 10px;"
                                                class="spinner-border spinner-border-sm ml-3"></span>
                                            <span wire:loading.remove
                                                wire:target="cancelCategory">{{ $translations['cancel'] }}</span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="e-panel card">
                                <div class="card-body">
                                    <div class="row">
                                        @if ($edit_product_images)
                                        @foreach ($edit_product_images as $image)
                                        <div class="col-6">

                                            <div class="dropify-wrapper" style="height: auto">
                                                @if ($to_delete_image_edit != $loop->index)
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_edit({{ $loop->index }})"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_edit()"><i class="fa fa-check"
                                                        data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_edit()"><i class="fa fa-times"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @endif
                                                <img src="{{ get_image('moyen/'.$image->media) }}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @endforeach
                                        @endif


                                        @if ($product_images)
                                        @foreach ($product_images as $image)
                                        <div class="col-6">

                                            <div class="dropify-wrapper" style="height: auto">
                                                @if ($to_delete_image_tm != $loop->index)
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_tm({{ $loop->index }})"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_tm({{ $loop->index }})"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_tm()"><i class="fa fa-times"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @endif

                                                <img src="{{ request()->getSchemeAndHttpHost() }}/livewire-tmp/{{ $image->getFileName()  ?? null  }}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                        <div class="col-6">

                                            <div class="dropify-wrapper" style="height: auto">

                                                <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                    style="height: 100%;width:100%">
                                                <div class="dropify-loader">

                                                </div>

                                                <input type="file" class="dropify" wire:model="product_images"
                                                    data-height="210">
                                                <div wire:loading wire:target="product_images">
                                                    {{ $translations['uploading'] }}...</div>

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
                                <h3 class="card-title">{{ $translations['receipt'] }}</h3>
                                <button type="button" class="btn btn-icon btn-info float-right ml-auto"
                                    wire:click="addReceipt()">
                                    <span wire:loading wire:target="addReceipt"
                                        style="height: 20px;width:20px;transition: 0.5s;margin-right: 10px;"
                                        class="spinner-border spinner-border-sm ml-3"></span>
                                    <i class="fe fe-plus" wire:loading.remove wire:target="addReceipt"></i>
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    @foreach ($receipts as $key => $receipt)
                                    {{-- @dd($receipt) --}}
                                    <div class="col-10">
                                        <input class="form-control mb-4" placeholder="{{ $translations['receipt'] }}"
                                            type="text" wire:model='receipts.{{ $key }}'>
                                        @error('receipts.{{ $key }}')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-2">
                                        <button type="button" class="btn btn-icon btn-danger mb-4 float-right"
                                            wire:click='removeReceipt({{ $key }})'>
                                            <span wire:loading wire:target="removeReceipt({{ $key }})"
                                                style="height: 20px;width:20px;transition: 0.5s;margin-right: 10px;"
                                                class="spinner-border spinner-border-sm ml-3"></span>
                                            <i class="fe fe-x" wire:loading.remove
                                                wire:target="removeReceipt({{ $key }})"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 ">

                        <div class="e-panel card mb-1">
                            <div class="card-header">
                                <h3 class="card-title">{{ $translations['extra_products'] }}</h3>
                                <button type="button" class="btn btn-icon btn-info float-right ml-auto"
                                    wire:click="addExtra()">
                                    <span wire:loading wire:target="addExtra"
                                        style="height: 20px;width:20px;transition: 0.5s;margin-right: 10px;"
                                        class="spinner-border spinner-border-sm ml-3"></span>
                                    <span wire:loading.remove
                                        wire:target="addExtra">{{ $translations['add_extra'] }}</span>
                                </button>
                            </div>
                        </div>

                    </div>
                    <div class="col-12">

                        @foreach ($extras as $key => $extra)
                        <div class="e-panel card">

                            <div class="card-body p-3">

                                <div class="row">
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-12">
                                                <input class="form-control mb-4 mt-1"
                                                    placeholder="{{ $translations['title'] }}" type="text"
                                                    wire:model='extras.{{ $key }}.title'>
                                                @error('extras.{{ $key }}.title')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-8">
                                                <input class="form-control mb-4"
                                                    placeholder="{{ $translations['price'] }}" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model='extras.{{ $key }}.price'>
                                                @error('extras.{{ $key }}.price')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 p-0">
                                        <div class="dropify-wrapper" style="height:auto;border: none;">
                                            @if (isset($extras[$key]['image']) and $extras[$key]['image'] != null)
                                            @if (is_string($extras[$key]['image']))
                                            <img src="{{ get_image('tmb/'.$extras[$key]['image'])}}"
                                                style="height: 100%;width:100%">

                                            @else
                                            <img src="{{ request()->getSchemeAndHttpHost() }}/livewire-tmp/{{ $extras[$key]['image']->getFileName()  ?? null  }}"
                                                style="height: 100%;width:100%">
                                            @endif
                                            @else
                                            <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                style="height: 100%;width:100%">
                                            @endif

                                            <div class="dropify-loader">

                                            </div>

                                            <input type="file" class="dropify" wire:model="extras.{{ $key }}.image"
                                                data-height="210">
                                        </div>
                                        @error('extras.{{ $key }}.image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-icon btn-danger float-right"
                                            wire:click='removeExtra({{ $key }})'>
                                            <span wire:loading wire:target="removeExtra({{ $key }})"
                                                style="height: 20px;width:20px;transition: 0.5s;margin-right: 10px;"
                                                class="spinner-border spinner-border-sm ml-3"></span>
                                            <span wire:loading.remove
                                                wire:target="removeExtra({{ $key }})">{{ $translations['remove'] }}</span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

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
                            @if($editProduct)
                            <button type="button" class="btn btn-primary"
                                wire:click.prevent="updateProduct()">{{ $translations['update'] }}
                                <div class="spinner-border text-light" role="status" style='width:20px;height:20px' wire:loading>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </button>
                            @else
                            <button type="button" class="btn btn-primary"
                                wire:click.prevent="submitProduct()">{{ $translations['save'] }}
                                <div class="spinner-border text-light" role="status" style='width:20px;height:20px' wire:loading>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </button>
                            @endif
                            <button type="button" class="btn btn-danger"
                                wire:click.prevent="cancel()">{{ $translations['cancel'] }}</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>




    </div>
</div>
@section('js')
<script>
$('#title').on('blur', function() {
    Livewire.emit('checkUniqueTitle')
});
</script>
@endsection