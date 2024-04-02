<div>
    <div class="row flex-lg-nowrap">
        <div class="col-12 mb-3">
            <div class="row">
                @if($editOffer)
                <div class="col-12">
                    <button class="btn btn-danger float-right mb-3" wire:click='DeleteOffer()'>
                        Delete Offer
                    </button>
                </div>
                @endif
                <div class="col-md-8 col-12">
                    <div class="row">
                        @if(!empty($selected_products))
                        <div class="col-12">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title">Offer Products </h3>
                                    <span class="badge badge-warning" role="button" style="right: 10px;position: absolute;color: black;" >
                                       <h4 class="mb-0"><strong>TOTAL : {{array_sum(array_column($selected_products_info, 'total'));}} {{$currency}}</strong></h4>
                                    </span>
                                </div>
                                <div class="card-body p-2">
                                    <div class="row">
                                        @foreach ( $selected_products_info as $product)
                                        <div class="col-sm-3 col-6">
                                            <span class="badge badge-danger" role="button"  wire:click='removeProduct({{$product["id"]}})'  style="position: absolute; z-index:10"><i class="fa fa-trash-o" style="font-size:15px"></i>
                                            </span>

                                            <div class="card overflow-hidden mb-3">
                                                <div style="overflow: hidden;width: 100%;height: 100px;position:relative">
                                                    <span class="badge badge-warning" role="button"   style="position: absolute; z-index:10;color:black;bottom:0px">
                                                        <h7 class="mb-0"><strong>{{ $product['price']}} {{$currency}}</strong></h7>
                                                    </span>


                                                    <img src="{{ url(env('PATH_PRODUCTS_TMB')) }}/{{ $product['media'][0]['media'] }}"
                                                        class="card-image1 ">
                                                </div>
                                                <div class="card-body p-2">
                                  
                                                    <div class="row">
                                                  
                                                        <div class="col-12">

                                                            <input class="form-control " placeholder="Quantity"
                                                                type="number"  oninput="this.value = this.value.replace(/[^1-9.,]/g, ''); this.setCustomValidity(this.value <= 0 ? 'Please enter a positive number greater than 0.' : '');" step="1"
                                                                wire:model='qty.{{$product["id"]}}'
                                                                wire:change="quantityProduct({{$product["id"]}})">
                                                            @error('qty.{{$product["id"]}}')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                              
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-12">
                            <div class="e-panel card">
                                <div class="card-header">
                                    <h3 class="card-title">Offer info </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="col-md-12 form-label">Offer Title <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="Title" type="text"
                                                wire:model='title'>
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label class="col-md-12 form-label">Offer Meta <span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="Meta" type="text"
                                                wire:model='meta'>
                                            @error('meta')
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
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                            <label class="col-md-12 form-label">Old Price<span
                                                class="text-red">*</span></label>
                                             <button class="btn btn-warning brn-md" >
                                                <h4 class="mb-0"  style="color: black;!important"><strong>TOTAL : {{array_sum(array_column($selected_products_info, 'total'));}} {{$currency}}</strong></h4>
                                             </button>
                                        </div>
                                        <div class="col-md-4 col-7">
                                            <label class="col-md-12 form-label">New Price<span
                                                    class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="Price" type="number"
                                                pattern="[0-9]+([\.,][0-9]+)?" step="0.01" wire:model='price'>
                                            @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <label class="col-md-12 form-label">status <span
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

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="e-panel card">
                                <div class="card-body">
                                    <div class="row">

                                        

                                        @if ($offer_image)
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto">
                                                @if ($to_delete_image_tm != 1)
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_tm(1)"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_tm(1)"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_tm()"><i class="fa fa-times"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @endif

                                                <img src="{{ $offer_image->temporaryUrl() }}" style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @elseif ($edit_offer_image)
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto">
                                                @if ($to_delete_image_edit != 1)
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_edit(1)"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_edit(1)"><i class="fa fa-check"
                                                        data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_edit()"><i class="fa fa-times"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @endif
                                                <img src="{{ url(env('PATH_OFFERS')) }}/{{ $edit_offer_image }}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @else
                                            <div class="col-12">

                                                <div class="dropify-wrapper" style="height: 30vw">

                                                    <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                        style="height: 100%;width:100%">
                                                    <div class="dropify-loader">

                                                    </div>

                                                    <input type="file" class="dropify" wire:model="offer_image"
                                                        data-height="210">
                                                    <div wire:loading wire:target="offer_image">Uploading...</div>

                                                </div>
                                            </div>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="e-panel card">
                                <div class="card-body">
                                    <div class="row">

                                        

                                        @if ($offer_image_squad)
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto">
                                                @if ($to_delete_image_tm != 1)
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_tm(1)"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_tm(2)"><i
                                                        class="fa fa-check" data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_tm()"><i class="fa fa-times"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @endif

                                                <img src="{{ $offer_image_squad->temporaryUrl() }}" style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @elseif ($edit_offer_image_squad)
                                        <div class="col-12">

                                            <div class="dropify-wrapper" style="height: auto">
                                                @if ($to_delete_image_edit != 2)
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="to_delete_image_edit(2)"><i
                                                        class="fa fa-trash-o" data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-trash-o"></i></button>
                                                @else
                                                <button style="position: absolute;margin-left: 10px;"
                                                    class="btn-sm btn-success mt-2"
                                                    wire:click.prevent="delete_image_edit(2)"><i class="fa fa-check"
                                                        data-toggle="tooltip"></i></button>
                                                <button style="position: absolute;margin-left: 50px;"
                                                    class="btn-sm btn-danger mt-2"
                                                    wire:click.prevent="no_delete_image_edit()"><i class="fa fa-times"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="fa fa-times"></i></button>
                                                @endif
                                                <img src="{{ url(env('PATH_OFFERS')) }}/{{ $edit_offer_image_squad }}"
                                                    style="height: 100%;width:100%">

                                            </div>
                                        </div>
                                        @else
                                            <div class="col-12">

                                                <div class="dropify-wrapper" style="height: 30vw">

                                                    <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                        style="height: 100%;width:100%">
                                                    <div class="dropify-loader">

                                                    </div>

                                                    <input type="file" class="dropify" wire:model="offer_image_squad"
                                                        data-height="210">
                                                    <div wire:loading wire:target="offer_image">Uploading...</div>

                                                </div>
                                            </div>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-sm-4 col-12">

                    <div class="e-panel card ">
                        <div class="card-header">
                            <h3 class="card-title">Products List</h3>
                        </div>
                        <div class="card-body p-1 pb-3" style="box-shadow: inset 0 -4px 9px rgba(0, 0, 0, 0.1);">

                            <div class="row">
                                <div class="col-9">
                                    <input class="form-control mb-4" placeholder="Search by title or ID " type="text"
                                        wire:model='search'>
                                    @error('searh')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-md btn-info" style="width: 100%" wire:click='Search'>
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row p1-3" style="overflow: auto;max-height: 129vh">

                                @foreach ( $products as $product)
                                @if(!in_array($product->id,$selected_products))

                                <div class="col-sm-12 col-6">
                                    <span class="badge badge-warning" role="button"   style="position: absolute; z-index:10;color:black">
                                        <h6 class="mb-0"><strong>{{ $product->price}} {{$currency}}</strong></h6>
                                    </span>
                                    <div class="card overflow-hidden">
                                        <div style="overflow: hidden;
                                        width: 100%;
                                        height: 200px;">
                                            <img src="{{ url(env('PATH_PRODUCTS_TMB')) }}/{{ $product->media[0]->media }}"
                                                class="card-image1 ">
                                        </div>
                                        <div class="card-body p-2">

                                            <h5 class="card-title mb-3">{{substr($product->title , 0, 40) }}</h5>

                                            <button class="btn btn-info btn-sm "
                                                wire:click='selectProduct({{$product->id}})'>
                                                Add
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
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
                                @if($editOffer)
                                <button type="button" class="btn btn-primary"
                                    wire:click.prevent="updateOffer()">Update</button>
                                @else
                                <button type="button" class="btn btn-primary"
                                    wire:click.prevent="submitOffer()">Save</button>
                                @endif
                                <button type="button" class="btn btn-danger"
                                    wire:click.prevent="cancel()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>