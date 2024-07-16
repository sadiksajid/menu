<div>
    <div class="container-fluid mb-3">
        <div class='row'>
            <div class="col-md-2 col-sm-2 col-8 mb-4 ">
                <button type="button" class="btn btn-orange " id='new_img_modal' data-whatever="@mdo">New
                    QR Code</button>
            </div>

            <div class="col-md-1 col-sm-2 col-4 ">

                <div class="spinner-border text-info" role="status" style='width:30px;height:30px;float:right'
                    wire:loading>
                    <span class="sr-only">Loading...</span>
                </div>

            </div>
            <div class="col-md-9 col-sm-8 col-12 ">

                <div class='row'>
                    <div class="col-md-3 col-2">
                        @if(!empty($search_image))
                        <button class="btn btn-danger" type="button" style='height: 100%;float:right'
                            id='clear_saerch'><i class="fa fa-close text-white-50"></i></button>
                        @endif
                    </div>
                    <div class="col-md-6 col-8" wire:ignore>
                        <input type="text" id="qr-input-search" class="form-control" placeholder="Enter title" />

                    </div>
                    <div class="col-md-1 col-2">

                        <button class="btn btn-orange" type="button" id="button_saerch" style='height: 100%;'><i
                                class="fa fa-search text-white-50"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row">
            @foreach ($all_iamges as $image)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card"> <img src="{{ get_image('tmb/'.$image['image']) }}"
                        onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <div>
                            @foreach ($image->qr as $tag)
                            <button type="button"
                                class="btn btn-sm btn-dark rounded-pill btn-wave text-white waves-effect waves-light">{{$tag->en_qr}}</button>
                            @endforeach


                        </div>
                        <br>
                        <a href="javascript:void(0);" class="card-link text-primary"
                            wire:click="editImage({{$image['id']}})">Edit</a>
                        @if( $image->usage == 0)
                        <a href="javascript:void(0);" class="card-link text-secondary d-inline-block"
                            wire:click="deleteImage({{$image['id']}})">Delete</a>
                        @endif
                        <h6 class="card-title fw-semibold" style='float: right;'>
                            {{\Carbon\Carbon::parse($image['updated_at'] ?? $image['created_at'])->format('d-m-Y')}}
                        </h6>
                    </div>
                </div>
            </div>


            @endforeach
        </div>


    </div>

    <div class="modal fade" id="modalimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pop-up-type">Create Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class='row'>
                        <div class='col-md-6 col-12'>
                            <div id='addImages'>
                                <div class="d-inline"><input type="file" class="dropify"
                                        accept=".jpg, .png, .webp, image/jpeg, image/png" name="attachment"
                                        data-height="150px" wire:model="img_image" /></div>
                            </div>
                        </div>


                        <div class="col-md-6 col-12">
                            <div class='row'>
                                <div class='col-2'>
                                    <label class="switch">
                                        <input type="checkbox" class='collaps_checkbox' data-id='#qr_collapse' checked >
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class='col-10'>
                                    <div class='row collapse' id="qr_collapse">
                                        <div class='col-6'>
                                            <label class="col-md-12 form-label">{{ $translations['left'] }} - px
                                                <span class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="px" type="number"
                                                pattern="[0-9]+([\.,][0-9]+)?" step="0.01" wire:model.defer='qr_left'>
                                        </div>
                                        <div class='col-6'>
                                            <label class="col-md-12 form-label">{{ $translations['top'] }} - px
                                                <span class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="px" type="number"
                                                pattern="[0-9]+([\.,][0-9]+)?" step="0.01" wire:model.defer='qr_top'>
                                        </div>
                                        <div class='col-6'>
                                            <label class="col-md-12 form-label">{{ $translations['color'] }}
                                                <span class="text-red">*</span></label>
                                            <input class="form-control mb-4" placeholder="hexa" type="text"
                                                wire:model.defer='qr_color'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-orange submit" id='submit'>Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pop-up-type">Update Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class='col-12'>
                        <div id='UpdateImage'>

                        </div>
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

$('.collaps_checkbox').change(function() {
    console.log($(this).is(':checked'));
    if ($(this).is(':checked')) {
      $($(this).data('id')).slideDown(); // Show the content with a slide-down effect
    } else {
      $($(this).data('id')).slideUp(); // Hide the content with a slide-up effect
    }
  });
//////////////////////////////////////
document.addEventListener('DOMContentLoaded', () => {


    $('#submit').on('click', function() {

        const qr = qrInput.getValue(true);
        Livewire.emit('submitImage', {
            'qr': qr
        })
    });


});


$('#new_img_modal').on('click', function() {
    fileUpload();
    $('#modalimage').modal('show');
});



window.addEventListener('edit_image', event => {

    var dropifyInput = $('#UpdateImage');
    dropifyInput.html('<img src="' + event.detail.img_image +
        '" style="width: 100%;" onerror="this.onerror=null;this.src=\'https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg\';"  >'
    );
    qrInputUpdate.removeActiveItems();
    qrInputUpdate.setValue(event.detail.qr);

    $('#modalUpdateimage').modal('show');

    $('#update').on('click', function() {
        var update_qr = qrInputUpdate.getValue(true);
        Livewire.emit('UpdateImage', {
            'qr': update_qr
        })
    });


})





$('#button_saerch').on('click', function() {

    var search = qrInputSearch.getValue(true);
    Livewire.emit('Search', {
        'qr': search
    })
});


$(document).on('click', '#clear_saerch', function() {

    qrInputSearch.removeActiveItems();
    Livewire.emit('clearSearch')
});




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

        html_error = html_error + "<div class='alert alert-danger' role='alert'>" + errors[error] + "</div>"
    }

    Swal.fire({
        title: event.detail.title,
        icon: event.detail.type,
        html: html_error,
        customClass: {
            popup: 'swal2-custom-zindex' // Apply the custom z-index class
        }
    });
})
</script>
@endsection