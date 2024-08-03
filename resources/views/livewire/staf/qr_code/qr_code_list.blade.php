<div>
    <style>
        .qr-div:hover .edit-btn{
            opacity:1;
            top: 5px;

        }
        .edit-btn{
            position: absolute;
            z-index: 10;
            top: 8px;
            margin-left: 5px;
            opacity:0;
            transition:0.5s;
        }

        .preview-btn{
            margin-left: 45px!important;
        }

        .loading-div{
            width: 100%;
            height: 100%;
            position: absolute;
            background: rgb(255, 255, 255, 0.5);;
            display: flex;
            align-items: center;  /* Center vertically */
            justify-content: center; /* Center horizontally (optional) */
        }

    </style>
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

        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($all_qr as $image)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 qr-div">
                <button class='btn btn-dark text-light btn-sm edit-btn' wire:click='editQR({{$image["id"]}})'>
                    <i class="fa fa-edit" ></i>
                </button>
                <button class='btn btn-dark text-light btn-sm edit-btn preview-btn' wire:click='GeneratQR({{$image["id"]}})'>
                    <i class="fa fa-eye" ></i>
                </button>
                <button class='btn btn-orange text-light btn-sm edit-btn preview-btn' style='right: 20px!important;' wire:click='deleteQR({{$image["id"]}})'>
                    <i class="fa fa-trash" ></i>
                </button>

                <div class="card"> <img src="{{ get_image('tmb/'.$image['preview']) }}"
                        onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';"
                        class="card-img-top" alt="...">


                <div class='loading-div d-none' wire:loading.class.remove="d-none" wire:target='GeneratQR({{$image["id"]}})'>
                    <div class="spinner-border text-info" role="status" style='width:30px;height:30px;float:right' >
                            <span class="sr-only">Loading...</span>
                    </div>
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
                    <h5 class="modal-title" id="pop-up-type">Create Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class='row'>
                        <div class='col-md-4 col-12'>
                            <label class="col-md-12 form-label">{{ $translations['image'] }}
                            <span class="text-red">*</span></label>
                            <div id='UpdateImage'>
                                <div class="d-inline"><input type="file" class="dropify"
                                        accept=".jpg, .png, .webp, image/jpeg, image/png" name="attachment"
                                        data-height="150px" wire:model="qr_image" /></div>
                            </div>
                            <label class="col-md-12 form-label">{{ $translations['preview'] }}
                            <span class="text-red">*</span></label>
                            <div id='UpdatePreview'>
                                <div class="d-inline"><input type="file" class="dropify"
                                        accept=".jpg, .png, .webp, image/jpeg, image/png" name="attachment"
                                        data-height="150px" wire:model="qr_preview" /></div>
                            </div>
                        </div>


                        <div class="col-md-8 col-12">

                            <div class='row'>
                                <div class='col-2'>
                                    <label class="switch">
                                        <input type="checkbox" checked disabled>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class='col-10'>
                                    <h6 class='border-bottom'>{{ $translations['image_settings'] }}</h6>
                                    <div class='container  '>
                                        <div class='row '>

                                            <div class=' col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['width'] }} - px
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='image_width'>
                                            </div>
                                            <div class='col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['height'] }} - px
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='image_height'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- //////////////////////////////////////////////////////////////////////// -->
                            <div class='row'>
                                <div class='col-2'>
                                    <label class="switch">
                                        <input type="checkbox" checked disabled>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class='col-10'>
                                    <h6 class='border-bottom'>{{ $translations['qr_settings'] }}</h6>
                                    <div class='container '>
                                        <div class='row '>
                                            <div class='col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['left'] }} - px
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='qr_left'>
                                            </div>
                                            <div class='col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['top'] }} - px
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='qr_top'>
                                            </div>
                                            <div class='col-md-4  col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['width'] }} - px
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='qr_width'>
                                            </div>
                                            <div class='col-md-4 col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['height'] }} - px
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='qr_height'>
                                            </div>
                                            <div class='col-md-4 col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['color'] }}
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="hexa" type="text"
                                                    wire:model.defer='qr_color'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- //////////////////////////////////////////////////////////////////////// -->


                        </div>
                        <div class='col-12 mt-4'>
                            <div class='row'>
                                <div class='col-md-1 col-2'>
                                    <label class="switch">
                                        <input type="checkbox" class='collaps_checkbox' data-id='#logo_collapse'
                                            wire:model.defer='logo_check'>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class='col-md-11 col-10'>
                                    <h6 class='border-bottom'>{{ $translations['logo_settings'] }}</h6>
                                    <div class='container collapse ' id="logo_collapse">
                                        <div class='row '>
                                            <div class='col-md-3 col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['left'] }} - px
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='logo_left'>
                                            </div>
                                            <div class='col-md-3 col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['top'] }} - px
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='logo_top'>
                                            </div>
                                            <div class='col-md-3 col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['width'] }} - px
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='logo_width'>
                                            </div>
                                            <div class='col-md-3 col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['height'] }} - px
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='logo_height'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- //////////////////////////////////////////////////////////////////////////////////////////////// -->

                            @foreach($inputs_array as $input)
                            <div class='row'>
                                <div class='col-md-1 col-2'>
                                    <label class="switch ">
                                        <input type="checkbox" class='collaps_checkbox' data-id='#{{$input}}_collapse'
                                            wire:model.defer='{{$input}}_check'>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class='col-md-11 col-10'>
                                    <h6 class='border-bottom'>{{ $translations[$input.'_settings'] }}</h6>
                                    <div class='container collapse ' id="{{$input}}_collapse">
                                        <div class='row '>

                                            <div class='col-md-1 col-2'>

                                                <label class="col-md-12 form-label p-0">{{ $translations['center'] }}
                                                </label>
                                                <label class="switch switch-dark mt-2">
                                                    <input type="checkbox" class='center_checkbox' data-id='{{$input}}'
                                                        wire:model.defer='{{$input}}_center'>
                                                    <span class="slider round"></span>
                                                </label>

                                            </div>

                                            <div class='col-md-3 col-5'>
                                                <label class="col-md-12 form-label">{{ $translations['left'] }} - px
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4 {{$input}}-lt" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='{{$input}}_left'>
                                            </div>
                                            <div class='col-md-4 col-5'>
                                                <label class="col-md-12 form-label">{{ $translations['top'] }} - px
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='{{$input}}_top'>
                                            </div>
                                            <div class='col-md-4 col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['font_size'] }} -
                                                    pt
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="px" type="number"
                                                    pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                    wire:model.defer='{{$input}}_font_size'>
                                            </div>
                                            <div class='col-md-3 col-6'>
                                                <label class="col-md-12 form-label">{{ $translations['color'] }}
                                                    <span class="text-red">*</span></label>
                                                <input class="form-control mb-4" placeholder="hexa" type="text"
                                                    wire:model.defer='{{$input}}_color'>
                                            </div>
                                            <div class='col-md-3 col-4'>
                                                <label
                                                    class="col-md-12 form-label">{{ $translations['font_name'] }}</label>
                                                <input class="form-control mb-4"
                                                    placeholder="{{ $translations['font_name'] }}" type="text"
                                                    wire:model.defer='{{$input}}_font_name' accept=".ttf, .otf" >
                                            </div>
                                            <div class='col-md-6 col-8'>
                                                <label
                                                    class="col-md-12 form-label">{{ $translations['font_file'] }} ( .ttf or .otf )</label>
                                                <input class="form-control mb-4" type="file"
                                                    wire:model='{{$input}}_font_file' >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal" id='cancel'>Close</button>
                    <button type="button" class="btn btn-orange submit" id='submit' data-id='save'>Save</button>
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
    if ($(this).is(':checked')) {
        $($(this).data('id')).slideDown(); // Show the content with a slide-down effect
    } else {
        $($(this).data('id')).slideUp(); // Hide the content with a slide-up effect
    }
});

$('.center_checkbox').change(function() {
    console.log($(this).is(':checked'));
    if ($(this).is(':checked')) {
        $('.' + $(this).data('id') + '-lt').attr('disabled', 'disabled');
    } else {
        $('.' + $(this).data('id') + '-lt').removeAttr('disabled');
    }
});

//////////////////////////////////////
document.addEventListener('DOMContentLoaded', () => {


    $('#submit').on('click', function() {
        if($(this).data('id') == 'save'){
            Livewire.emit('submitImage')
        }else{
            Livewire.emit('UpdateImage')
        }

    });

    

});


$('#new_img_modal').on('click', function() {
    fileUpload();
    $('#submit').attr('data-id','save');
    $('#submit').text('Save');

    $('#modalimage').modal({
        backdrop: 'static',
        keyboard: true,
        show: true
    });
    
});
$('.center_btn').on('click', function() {
    $('#center_title').val(1)
});



window.addEventListener('edit_image', event => {
    fileUpload();

    var dropifyInput = $('#UpdateImage').find('.dropify-render');

    $('#UpdateImage').find('.dropify-preview').addClass('d-block');
    $('#UpdateImage').find('.dropify-loader').addClass('d-none');
    $('#UpdateImage').find('.dropify-wrapper').addClass('has-preview')


    dropifyInput.html('<img src="'+event.detail.qr_image+'" style="max-height: 150px;" onerror="this.onerror=null;this.src=\'https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg\';"  >');



    var dropifyPreview = $('#UpdatePreview').find('.dropify-render');

    $('#UpdatePreview').find('.dropify-preview').addClass('d-block');
    $('#UpdatePreview').find('.dropify-loader').addClass('d-none');
    $('#UpdatePreview').find('.dropify-wrapper').addClass('has-preview')


    dropifyPreview.html('<img src="'+event.detail.qr_preview+'" style="max-height: 150px;" onerror="this.onerror=null;this.src=\'https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg\';"  >');


        

    $('#modalimage').modal('show');

    $( ".collaps_checkbox" ).each(function( index ) {
        if ($(this).is(':checked')) {
            $($(this).data('id')).slideDown(); 
        } 
    });

    $( ".center_checkbox" ).each(function( index ) {
        if ($(this).is(':checked')) {
            $('.' + $(this).data('id') + '-lt').attr('disabled', 'disabled');
        } 
    });

    $('#submit').attr('data-id','update');
    $('#submit').text('Update');


    $('#cancel').on('click', function() {
        Livewire.emit('cancelUpdate')
    });
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


window.addEventListener('pdfRendered', event => {
    var pdfData = event.detail.pdfData;

    // Decode the base64 string to binary data
    var binary = atob(pdfData);
    var len = binary.length;
    var buffer = new ArrayBuffer(len);
    var view = new Uint8Array(buffer);

    for (var i = 0; i < len; i++) {
        view[i] = binary.charCodeAt(i);
    }

    // Create a Blob object from the binary data
    var blob = new Blob([view], {
        type: 'application/pdf'
    });
    var url = URL.createObjectURL(blob);

    // Open the Blob URL in a new tab
    window.open(url, '_blank');
});


</script>
@endsection