<div>

    <div class="container-fluid mb-3">
        <div class='row'>
            <div class="col-md-2 col-sm-2 col-8 mb-4 ">
                <button type="button" class="btn btn-primary " id='new_img_modal'
                    data-whatever="@mdo">New Image</button>
            </div>

            <div class="col-md-1 col-sm-2 col-4 ">

                <div class="spinner-border text-info" role="status" style='width:30px;height:30px;float:right' wire:loading >
                    <span class="sr-only">Loading...</span>
                </div>

            </div>
            <div class="col-md-9 col-sm-8 col-12 ">
                <div class="col-md-4 col-12 float-right">
                    <div class="input-group mb-3">
                        @if(!empty($search_image))
                        <button class="btn btn-danger" type="button" wire:click='clearSearch'><i
                                class="fa fa-close text-white-50"></i></button>
                        @endif
                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Search"
                            aria-describedby="button-addon2" wire:model.defer='search_image'>
                        <button class="btn btn-primary" type="button" id="button_saerch"><i
                                class="fa fa-search text-white-50"></i></button>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row">

            @foreach ($all_iamges as $image)
   
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card  mb-5">
                    <div class="card-body" style='padding: 0.5rem 1rem;'>
                        <div class="media mt-0">
                            <figure class="rounded-circle align-self-start mb-0">
                                <img src="{{ get_image('tmb/'.$image['image']  ) }}"
                                    onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';"
                                    class="avatar brround avatar-md mr-3" style='    width: 60px; height: 60px;'>
                            </figure>
                            <div class="media-body time-title1 ">
                            <p>{{\Carbon\Carbon::parse($image['updated_at'] ?? $image['created_at'])->format('d-m-Y');}}</p>
                            </div>
                            <button class="btn btn-primary  btn-sm mr-2" wire:click="editimage({{$image['id']}})"><i class="fa fa-edit"></i>
                            </button>
                            @if($image['products_count'] == 0)
                            <button class="btn btn-danger btn-sm" wire:click="deleteimage({{$image['id']}},'{{$image['title']}}')"><i class="fa fa-trash"></i> </button>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>


    </div>

    <div class="modal fade" id="modalimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore >
        <div class="modal-dialog" role="document"  >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pop-up-type">Create Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  
                    <div class='col-12'>
                            <div id='addImages'>
                            <div class="d-inline"><input type="file" class="dropify" accept=".jpg, .png, .webp, image/jpeg, image/png" name="attachment" data-height="150px" wire:model="img_image" /></div>
                            </div>
                    </div>

                 
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Sub Title:</label>
                        <textarea class="form-control" wire:model.defer="img_sub_title"  id="img_sub_title"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submit" id='submit'>Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore >
        <div class="modal-dialog" role="document"  >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pop-up-type">Update Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  
                    <div class='col-12'>
                            <div id='addImages'>
                            <div class="d-inline"><input type="file" class="dropify" accept=".jpg, .png, .webp, image/jpeg, image/png" name="attachment" data-height="150px" wire:model="img_image" /></div>
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Sub Title:</label>
                        <textarea class="form-control" wire:model.defer="img_sub_title"  id="img_sub_title"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id='update'>Save</button>
                </div>
            </div>
        </div>
    </div>
    


</div>
@section('js')

<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}?v=3"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}?v=6"></script>


<script>
$('#submit').on('click', function() {
    Livewire.emit('submitimage')
});
$('#update').on('click', function() {
    Livewire.emit('Updateimage')
});



$('#new_img_modal').on('click', function() {

        fileUpload();

        $('#modalimage').modal('show');
});


window.addEventListener('edit_image', event => {


    fileUpload();

    var dropifyInput = $('.dropify-render');

    $('.dropify-preview').addClass('d-block')
    $('.dropify-loader').addClass('d-none')
    $('.dropify-wrapper').addClass('has-preview')


    dropifyInput.html('<img src="'+event.detail.img_image+'" style="max-height: 150px;" onerror="this.onerror=null;this.src=\'https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg\';"  >');

    $('#img_title').val(event.detail.img_title);
    $('#img_sort').val(event.detail.img_sort);
    $('#img_sub_title').val(event.detail.img_sub_title);

    $('#modalUpdateimage').modal('show');

})




window.addEventListener('swal:finish', event => {
    $('#modalimage').modal('hide');
    $('#modalUpdateimage').modal('hide');
    Swal.fire({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
    });
})


window.addEventListener('swal:error', event => {

    var errors = event.detail.errors
    var html_error = ''

    for (const error in errors) {
        
        html_error = html_error + "<div class='alert alert-danger' role='alert'>"+errors[error]+"</div>"
    }

    Swal.fire({
            title: event.detail.title,
            icon: event.detail.type,
            html:html_error,
            customClass: {
                popup: 'swal2-custom-zindex' // Apply the custom z-index class
            }
    });
})


</script>
@endsection