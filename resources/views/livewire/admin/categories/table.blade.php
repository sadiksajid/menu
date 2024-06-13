<div>
    <div class="container-fluid mb-3">
        <div class='row'>
            <div class="col-md-2 col-sm-2 col-8 mb-4 ">
                <button type="button" class="btn btn-primary " id='new_cat_modal'
                    data-whatever="@mdo">{{ $translations['new_category'] }}</button>
            </div>

            <div class="col-md-1 col-sm-2 col-4 ">

                <div class="spinner-border text-info" role="status" style='width:30px;height:30px;float:right' wire:loading >
                    <span class="sr-only">Loading...</span>
                </div>

            </div>
            <div class="col-md-9 col-sm-8 col-12 ">
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
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
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

                            <p>{{\Carbon\Carbon::parse($category['updated_at'] ?? $category['created_at'])->format('d-m-Y');}}</p>
                            </div>
                            <button class="btn btn-primary  btn-sm mr-2"><i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </button>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>


    </div>

    <div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                  
                    <div class='col-12'>
                            <div id='addImages'>

                            </div>
                    </div>

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

<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}?v=3"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}?v=6"></script>


<script>
$('#button_saerch').on('click', function() {
    Livewire.emit('render')
});

$('#new_cat_modal').on('click', function() {

            // $('#oldImages').html('')
            $('#addImages').html(
                '<div class="d-inline"><input type="file" class="dropify" accept=".jpg, .png, .webp, image/jpeg, image/png" name="attachment" data-height="150px" wire:model="category_image" /></div>'
            )
            fileUpload();
            // for (var key in images) {
            //     $('#oldImages').append(
            //         '<div class="col-md-4 col-6 mt-3"><div class="d-inline"><img src="' + images[key] +
            //         '" alt="..." class="img-thumbnail"></div></div>'
            //     )
            // }
 
            $('#modalCategory').modal('show');
});

</script>
@endsection