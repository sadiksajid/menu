<div>
    <div class="container-fluid mb-3">
        <div class='row'>
            <div class="col-md-2 col-1 ">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                    data-whatever="@mdo">{{ $translations['new_category'] }}</button>

            </div>

            <div class="col-1 ">

                <div class="spinner-border text-info" role="status" style='width:30px;height:30px' wire:loading>
                    <span class="sr-only">Loading...</span>
                </div>

            </div>
            <div class="col-md-9 col-6 ">
                <div class="col-md-4 col-12 float-right">
                    <div class="input-group mb-3">
                        @if(!empty($search_category))
                        <button class="btn btn-danger" type="button" wire:click='clearSearch'><i
                                class="fa fa-close text-white-50"></i></button>
                        @endif
                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Search"
                            aria-describedby="button-addon2" wire:model.defer='search_category'>
                        <button class="btn btn-primary" type="button" id="button_saerch"><i
                                class="fa fa-search text-white-50"></i></button>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row">



            @foreach ($categories as $category)
            @php
            if($category['image'] != null){
            $img = $category['image'] ;
            }else{
            $img = $category['image_origin'] ;
            }
            @endphp
            <div class="col-md-3 col-12">
                <div class="card  mb-5">
                    <div class="card-body" style='padding: 0.5rem 1rem;'>
                        <div class="media mt-0">
                            <figure class="rounded-circle align-self-start mb-0">
                                <img src="{{ get_image('tmb/'.$img ) }}"
                                    onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';"
                                    class="avatar brround avatar-md mr-3" style='    width: 60px; height: 60px;'>
                            </figure>
                            <div class="media-body time-title1 ">
                                <h5 class="time-title p-0 mb-0 font-weight-semibold leading-normal">
                                    {{substr($category['title'] , 0, 40) }}</h5>

                                {{\Carbon\Carbon::parse($category['updated_at'] ?? $category['created_at'])->format('d-m-Y');}}
                            </div>
                            <button class="btn btn-primary d-none d-sm-block mr-2"><i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger d-none d-sm-block"><i class="fa fa-trash"></i> </button>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>


    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                  <center>
                  <div class="dropify-wrapper" style="height:auto;border: none;width:50%">
                        @if (isset($cat_image) and $cat_image != null)
                        <img src="{{ request()->getSchemeAndHttpHost() }}/livewire-tmp/{{ $cat_image->getFileName() ?? null }}"
                            style="height: 100%;width:100%">
                        @else
                        <img src="{{ URL::asset('assets/images/small_site_logo.png') }}"
                            style="height: 100%;width:100%">
                        @endif

                        <div class="dropify-loader">

                        </div>

                        <input type="file" class="dropify" wire:model="cat_image" data-height="210">
                    </div>

                  </center>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>


</div>
@section('js')
<script>
$('#button_saerch').on('click', function() {
    Livewire.emit('render')
});
</script>
@endsection