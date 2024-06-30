<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <div class="container-fluid mb-3">
        <div class='row'>
            <div class="col-md-2 col-sm-2 col-8 mb-4 ">
                <button type="button" class="btn btn-primary " id='new_img_modal' data-whatever="@mdo">New
                    Image</button>
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
                        <button class="btn btn-danger" type="button"  style='height: 100%;float:right' id='clear_saerch'><i
                                class="fa fa-close text-white-50"></i></button>
                        @endif
                    </div>
                    <div class="col-md-6 col-8" wire:ignore>
                        <input type="text" id="tags-input-search" class="js-choices" placeholder="Enter tags" />

                    </div>
                    <div class="col-md-1 col-2">
                            
                    <button class="btn btn-primary" type="button" id="button_saerch" style='height: 100%;'><i
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
                            @foreach ($image->tags as $tag)
                            <button type="button"
                                class="btn btn-sm btn-dark rounded-pill btn-wave text-white waves-effect waves-light">{{$tag->en_tags}}</button>
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
        <div class="modal-dialog" role="document">
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
                            <div class="d-inline"><input type="file" class="dropify"
                                    accept=".jpg, .png, .webp, image/jpeg, image/png" name="attachment"
                                    data-height="150px" wire:model="img_image" /></div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Tags :</label>
                        <input type="text" id="tags-input" class="js-choices" placeholder="Enter tags" />

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

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Tags :</label>
                        <input type="text" id="tags-input-update" class="js-choices" placeholder="Enter tags" />

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
document.addEventListener('DOMContentLoaded', () => {
    const tagsInput = new Choices('#tags-input', {
        delimiter: ',',
        editItems: true,
        removeItemButton: true,
        duplicateItemsAllowed: false,
    });

    $('#submit').on('click', function() {

        const tags = tagsInput.getValue(true);
        Livewire.emit('submitImage', {
            'tags': tags
        })
    });


});







$('#new_img_modal').on('click', function() {
    fileUpload();
    $('#modalimage').modal('show');
});

const tagsInputUpdate = new Choices('#tags-input-update', {
    delimiter: ',',
    editItems: true,
    removeItemButton: true,
    duplicateItemsAllowed: false,

});


window.addEventListener('edit_image', event => {

    var dropifyInput = $('#UpdateImage');
    dropifyInput.html('<img src="' + event.detail.img_image +
        '" style="width: 100%;" onerror="this.onerror=null;this.src=\'https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg\';"  >'
    );
    tagsInputUpdate.removeActiveItems();
    tagsInputUpdate.setValue(event.detail.tags);

    $('#modalUpdateimage').modal('show');

    $('#update').on('click', function() {
        var update_tags = tagsInputUpdate.getValue(true);
        Livewire.emit('UpdateImage', {
            'tags': update_tags
        })
    });


})


const tagsInputSearch = new Choices('#tags-input-search', {
    delimiter: ',',
    editItems: true,
    removeItemButton: true,
    duplicateItemsAllowed: false,

});



$('#button_saerch').on('click', function() {

    var search = tagsInputSearch.getValue(true);
    Livewire.emit('Search', {
        'tags': search
    })
});


$(document).on('click','#clear_saerch', function() {

    tagsInputUpdate.removeActiveItems();
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