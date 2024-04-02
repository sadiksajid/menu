<div>
    <div class="row flex-lg-nowrap">
        <div class="col-12 mb-3">
            <div class="e-panel card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-md-12 form-label">Web Name <span class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="Web Name" type="text"
                                        wire:model='name'>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="col-md-12 form-label">Email<span class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="Email" type="text"
                                        wire:model='email'>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="col-md-12 form-label">Phone<span class="text-red">*</span></label>
                                    <input class="form-control mb-4" placeholder="+212" type="text"
                                        wire:model='phone'>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-md-12 form-label">Site Logo (100 × 450 px)<span
                                            class="text-red">*</span></label>

                                    <div class="dropify-wrapper" style="height:auto;border: none;">
                                        @if (isset($logo_edit) and $logo_edit != null)
                                            <img src="{{ $logo_edit->temporaryUrl() ?? null }}"
                                                style="height: 100%;width:100%">
                                        @elseif($logo != null)
                                            <img src="{{ url('storage/appino_images') }}/{{ $logo }}"
                                                style="height: 100%;width:100%">
                                        @else
                                            <img src="{{ URL::asset('assets/images/site_logo.png') }}"
                                                style="height: 100%;width:100%">
                                        @endif

                                        <div class="dropify-loader">

                                        </div>

                                        <input type="file"  class="dropify" wire:model="logo_edit"
                                            data-height="210">
                                    </div>
                                    @error('logo_edit')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label class="col-md-12 form-label">Site Icon (32 × 32 px)<span
                                            class="text-red">*</span></label>

                                    <div class="dropify-wrapper" style="height:auto;border: none;">
                                        @if (isset($small_logo_edit) and $small_logo_edit != null)
                                            <img src="{{ $small_logo_edit->temporaryUrl() ?? null }}"
                                                style="height: 100%;width:100%">
                                        @elseif($small_logo != null)
                                            <img src="{{ url('storage/appino_images') }}/{{ $small_logo }}"
                                                style="height: 100%;width:100%">
                                        @else
                                            <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                                                style="height: 100%;width:100%">
                                        @endif

                                        <div class="dropify-loader">

                                        </div>

                                        <input type="file"  class="dropify"
                                            wire:model="small_logo_edit" data-height="210">
                                    </div>
                                    @error('small_logo_edit')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="col-md-12 form-label">About<span class="text-red">*</span></label>
                            <textarea class="form-control mb-4" placeholder="Site Description" wire:model='about' style="height: 200px"></textarea>
                            @error('about')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="col-md-12 form-label">Facts Text</label>
                            <textarea class="form-control mb-4" placeholder="Facts Text" wire:model='facts' style="height: 200px"></textarea>
                            @error('facts')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="col-md-12 form-label">Products Text</label>
                            <textarea class="form-control mb-4" placeholder="Products Text" wire:model='products' style="height: 200px"></textarea>
                            @error('products')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <button type="button" class="btn btn-primary" wire:click.prevent="Submit()">Save</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
