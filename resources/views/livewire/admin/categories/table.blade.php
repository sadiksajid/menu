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
                                    {{substr($category['title'] , 0, 40) }} - <span class='text-primary'>N{{$category['sort']}}</span></h5>

                            <p>{{\Carbon\Carbon::parse($category['updated_at'] ?? $category['created_at'])->format('d-m-Y');}}</p>
                            </div>
                            <button class="btn btn-primary  btn-sm mr-2" wire:click="editCategory({{$category['id']}})"><i class="fa fa-edit"></i>
                            </button>
                            @if($category['products_count'] == 0)
                            <button class="btn btn-danger btn-sm" wire:click="deleteCategory({{$category['id']}},'{{$category['title']}}')"><i class="fa fa-trash"></i> </button>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>


    </div>

    <div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore >
        <div class="modal-dialog" role="document"  >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pop-up-type">Create Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  
                    <div class='col-12'>
                            <div id='addImages'>
                            <div class="d-inline"><input type="file" class="dropify" accept=".jpg, .png, .webp, image/jpeg, image/png" name="attachment" data-height="150px" wire:model="cat_image" /></div>
                            </div>
                    </div>

                    <div class='row'>
                        <div class='col-10'>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" wire:model.defer="cat_title" id="cat_title">
                            </div>
                        </div>
                        <div class='col-2 pl-0' >
                        <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Sort:</label>
                                <input type="number" class="form-control" wire:model.defer="cat_sort"  id="cat_sort">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Sub Title:</label>
                        <textarea class="form-control" wire:model.defer="cat_sub_title"  id="cat_sub_title"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submit" id='submit'>Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore >
        <div class="modal-dialog" role="document"  >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pop-up-type">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  
                    <div class='col-12'>
                            <div id='addImages'>
                            <div class="d-inline"><input type="file" class="dropify" accept=".jpg, .png, .webp, image/jpeg, image/png" name="attachment" data-height="150px" wire:model="cat_image" /></div>
                            </div>
                    </div>

                    <div class='row'>
                        <div class='col-10'>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" wire:model.defer="cat_title" id="cat_title">
                            </div>
                        </div>
                        <div class='col-2 pl-0' >
                        <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Sort:</label>
                                <input type="number" class="form-control" wire:model.defer="cat_sort"  id="cat_sort">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Sub Title:</label>
                        <textarea class="form-control" wire:model.defer="cat_sub_title"  id="cat_sub_title"></textarea>
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


// function getCachedData(key) {
//     const cachedData = localStorage.getItem(key);
//     return cachedData ? JSON.parse(cachedData) : null;
// }


// const interval = setInterval(function() {
//     console.log(getCachedData('date'))
//  }, 1000);



$('#submit').on('click', function() {
    Livewire.emit('submitCategory')
});
$('#update').on('click', function() {
    Livewire.emit('UpdateCategory')
});



$('#new_cat_modal').on('click', function() {

        fileUpload();

        $('#modalCategory').modal('show');
});


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




window.addEventListener('swal:finish', event => {
    $('#modalCategory').modal('hide');
    $('#modalUpdateCategory').modal('hide');
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