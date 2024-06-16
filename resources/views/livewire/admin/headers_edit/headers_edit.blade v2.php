<div>
    <div class="row flex-lg-nowrap">
        <div class="col-12 mb-3">
            <div class="row">

                <div class="col-12">
                    <div class="row">

                        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
                        <div class="col-6">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $translations['shop_header'] }}  </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                       
                                        <div class="col-12" wire:ignore>
                                    
                                                <div class="d-inline"><input type="file" class="dropify" accept=".jpg, .png, .webp, image/jpeg, image/png" name="attachment" data-height="20vw" wire:model="upload_image.shop" /></div>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="col-md-12 form-label">{{ $translations['title'] }} <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="{{ $translations['title'] }}" type="text"
                                                wire:model='titles_shop'>
                                            @error('titles_shop')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label class="col-md-12 form-label">{{ $translations['meta'] }} <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="{{ $translations['meta'] }}" type="text"
                                                wire:model='texts_shop'>
                                            @error('texts_shop')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
                        <div class="col-6">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $translations['offer_header'] }}  </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @isset ($upload_image['offers'])
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                                @if ($to_delete_image_tm == 'offers')
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_tm('offers')"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_tm('offers')"><i
                                                        class="fa fa-times" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @else

                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_tm('offers')"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>

                                                @endif

                                                <img src="{{ request()->getSchemeAndHttpHost() }}/livewire-tmp/{{ $upload_image['offers']->getFileName() }}" 
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @elseif ($images_offers)
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                                @if ($to_delete_image_edit == 'offers')
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_edit('offers')"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_edit('offers')"><i
                                                        class="fa fa-times" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @else

                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_edit('offers')"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>

                                                @endif
                                                <img src="{{ get_image($images_offers) }}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @else
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: 210px">

                                                <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                    style="height: 100%;width:100%">
                                                <div class="dropify-loader">

                                                </div>

                                                <input type="file" class="dropify" wire:model="upload_image.offers"
                                                    data-height="210px">
                                                <div wire:loading wire:target="upload_image">{{ $translations['uploading'] }}...</div>

                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="col-md-12 form-label">{{ $translations['title'] }} <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="{{ $translations['title'] }}" type="text"
                                                wire:model='titles_offers'>
                                            @error('titles_offers')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label class="col-md-12 form-label">{{ $translations['meta'] }} <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="{{ $translations['meta'] }}" type="text"
                                                wire:model='texts_offers'>
                                            @error('texts_offers')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
                        <div class="col-6">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $translations['order_header'] }} </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @isset ($upload_image['orders'])
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                                @if ($to_delete_image_tm == 'orders')
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_tm('orders')"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_tm('orders')"><i
                                                        class="fa fa-times" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_tm('orders')"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>

                                                @endif

                                                <img src="{{ request()->getSchemeAndHttpHost() }}/livewire-tmp/{{ $upload_image['orders']->getFileName() }}" 
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @elseif ($images_orders)
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                                @if ($to_delete_image_edit == 'orders')
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_edit('orders')"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_edit('orders')"><i
                                                        class="fa fa-times" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_edit('orders')"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>

                                                @endif
                                                <img src="{{ get_image($images_orders)}}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @else
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: 210px">

                                                <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                    style="height: 100%;width:100%">
                                                <div class="dropify-loader">

                                                </div>

                                                <input type="file" class="dropify" wire:model="upload_image.orders"
                                                    data-height="210px">
                                                <div wire:loading wire:target="upload_image">{{ $translations['uploading'] }}...</div>

                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="col-md-12 form-label">{{ $translations['title'] }} <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="{{ $translations['title'] }}" type="text"
                                                wire:model='titles_orders'>
                                            @error('titles_orders')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
                        <div class="col-6">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $translations['cart_header'] }} </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @isset ($upload_image['cart'])
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                                @if ($to_delete_image_tm == 'cart')
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_tm('cart')"><i class="fa fa-check"
                                                        data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_tm('cart')"><i
                                                        class="fa fa-times" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @else

                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_tm('cart')"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>

                                                @endif

                                                <img src="{{ request()->getSchemeAndHttpHost() }}/livewire-tmp/{{ $upload_image['cart']->getFileName() }}" 
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @elseif ($images_cart)
                                        <div class="col-12">
                                            <div >
                                                @if ($to_delete_image_edit == 'cart')
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_edit('cart')"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_edit('cart')"><i
                                                        class="fa fa-times" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_edit('cart')"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>

                                                @endif
                                                <img src="{{ get_image($images_cart) }}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @else
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: 210px">

                                                <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                    style="height: 100%;width:100%">
                                                <div class="dropify-loader">

                                                </div>

                                                <input type="file" class="dropify" wire:model="upload_image.cart"
                                                    data-height="210px">
                                                <div wire:loading wire:target="upload_image">{{ $translations['uploading'] }}...</div>

                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="col-md-12 form-label">{{ $translations['title'] }} <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="{{ $translations['title'] }}" type="text"
                                                wire:model='titles_cart'>
                                            @error('titles_cart')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
                        <div class="col-6">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $translations['checkout_header'] }} </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @isset ($upload_image['checkout'])
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                                @if ($to_delete_image_tm == 'checkout')
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_tm('checkout')"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_tm('checkout')"><i
                                                        class="fa fa-times" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_tm('checkout')"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>

                                                @endif

                                                <img src="{{ request()->getSchemeAndHttpHost() }}/livewire-tmp/{{ $upload_image['checkout']->getFileName() }}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @elseif ($images_checkout)
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                                @if ($to_delete_image_edit == 'checkout')
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_edit('checkout')"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_edit('checkout')"><i
                                                        class="fa fa-times" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_edit('checkout')"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>

                                                @endif
                                                <img src="{{ get_image($images_checkout) }}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @else
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: 210px">

                                                <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                    style="height: 100%;width:100%">
                                                <div class="dropify-loader">

                                                </div>

                                                <input type="file" class="dropify" wire:model="upload_image.checkout"
                                                    data-height="210px">
                                                <div wire:loading wire:target="upload_image">{{ $translations['uploading'] }}...</div>

                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="col-md-12 form-label">{{ $translations['title'] }} <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="{{ $translations['title'] }}" type="text"
                                                wire:model='titles_checkout'>
                                            @error('titles_checkout')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ///////////////////////////////////////////////////////////////////////////// --}}

                        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
                        <div class="col-6">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $translations['competition_header'] }} </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @isset ($upload_image['competition_header'])
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                                @if ($to_delete_image_tm == 'competition_header')
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_tm('competition_header')"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_tm('competition_header')"><i
                                                        class="fa fa-times" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_tm('competition_header')"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>

                                                @endif

                                                <img src="{{ request()->getSchemeAndHttpHost() }}/livewire-tmp/{{ $upload_image['competition_header']->getFileName() }}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @elseif ($images_competition_header)
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                                @if ($to_delete_image_edit == 'competition_header')
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_edit('competition_header')"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_edit('competition_header')"><i
                                                        class="fa fa-times" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_edit('competition_header')"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>

                                                @endif
                                                <img src="{{ get_image($images_competition_header) }}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @else
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: 210px">

                                                <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                    style="height: 100%;width:100%">
                                                <div class="dropify-loader">

                                                </div>

                                                <input type="file" class="dropify" wire:model="upload_image.competition_header"
                                                    data-height="210px">
                                                <div wire:loading wire:target="upload_image">{{ $translations['uploading'] }}...</div>

                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
                         {{-- ///////////////////////////////////////////////////////////////////////////// --}}
                         <div class="col-6">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ $translations['competition_home'] }} </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @isset ($upload_image['competition_home'])
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                                @if ($to_delete_image_tm == 'competition_home')
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_tm('competition_home')"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_tm('competition_home')"><i
                                                        class="fa fa-times" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_tm('competition_home')"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>

                                                @endif

                                                <img src="{{ request()->getSchemeAndHttpHost() }}/livewire-tmp/{{ $upload_image['competition_home']->getFileName() }}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @elseif ($images_competition_home)
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto ; height: 20vw;">
                                                @if ($to_delete_image_edit == 'competition_home')
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_edit('competition_home')"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_edit('competition_home')"><i
                                                        class="fa fa-times" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_edit('competition_home')"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>

                                                @endif
                                                <img src="{{ get_image($images_competition_home) }}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @else
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: 210px">

                                                <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                    style="height: 100%;width:100%">
                                                <div class="dropify-loader">

                                                </div>

                                                <input type="file" class="dropify" wire:model="upload_image.competition_home"
                                                    data-height="210px">
                                                <div wire:loading wire:target="upload_image">{{ $translations['uploading'] }}...</div>

                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- ///////////////////////////////////////////////////////////////////////////// --}}
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
                                <button type="button" class="btn btn-primary"
                                    wire:click.prevent="Update()">{{ $translations['update'] }} 
                                <div wire:loading class="spinner-border text-light" role="status" style="width: 20px;height: 20px;">
                                    <span class="sr-only">Loading...</span>
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


@section('js')

<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}?v=3"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}?v=6"></script>


<script>

$( document ).ready(
    function () {
        console.log('asdasd');
        fileUpload();
    }
)


window.addEventListener('edit_category', event => {


    fileUpload();

    var dropifyInput = $('.dropify-render');

    $('.dropify-preview').addClass('d-block')
    $('.dropify-loader').addClass('d-none')
    $('.dropify-wrapper').addClass('has-preview')


    dropifyInput.html('<img src="'+event.detail.cat_image+'" style="max-height: 150px;" onerror="this.onerror=null;this.src=\'https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg\';"  >');

    $('#cat_title').val(event.detail.cat_title);
    $('#cat_sort').val(event.detail.cat_sort);
    $('#cat_sub_title').val(event.detail.cat_sub_title);

    $('#modalUpdateCategory').modal('show');

})






</script>
@endsection