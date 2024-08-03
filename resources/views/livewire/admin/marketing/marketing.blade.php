<div>
    @section('css')
    <!-- INTERNAL Gallery css -->
    <link href="{{URL::asset('assets/plugins/gallery/gallery.css')}}" rel="stylesheet">
    @endsection

    <style>
    .qr-div:hover .edit-btn {
        opacity: 1;
        top: 5px;

    }

    .qr-div:hover .card {
        opacity: 0.8;
    }

    .edit-btn {
        position: absolute;
        z-index: 10;
        top: 8px;
        margin-left: 5px;
        opacity: 0;
        transition: 0.5s;
    }

    .preview-btn {
        margin-left: 65px !important;
    }

    .modal-btn {
        margin-left: 125px !important;
    }

    .loading-div {
        width: 100%;
        height: 100%;
        position: absolute;
        background: rgb(255, 255, 255, 0.5);
        ;
        display: flex;
        align-items: center;
        /* Center vertically */
        justify-content: center;
        border-radius: 15px;
    }
    .hero-image {
        background-color: #cccccc;
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        padding: 0;
        height:220px;
        border-radius: 15px;
    }

    .color_input{
        padding: 0;
        border: 1px solid black;
        width: 20%;
        float:left;
    }
    .color_input_text{
        width: 76%;
        float: right;
    }
    </style>
    <div class='container'>
        <div class='row'>
            <div class='col-md-6 col-12'>
                <div class="input-group mb-3 ">
                    <label class="col-md-12 form-label">{{ $translations['your_link'] }} : </label>
                    <input type="text" class="form-control text-dark" placeholder="your Link" value='{{$store_url}}'
                        id='input_link'>
                    <div class="input-group-append">
                        <span class="input-group-text bg-dark text-white" style='cursor:pointer'
                            id="copy_link">{{ $translations['copy_link'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">


            <div class='col-12'>
                <ul id="lightgallery" class="list-unstyled row">

                    @foreach ($fixed_templates  as $key=>$template)
                        @php 
                            $preview = URL::asset($template['preview']) ;
                        @endphp
                        <li class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 qr-div hero-image mr-3"
                            data-responsive="{{ $preview}}"
                            data-src="{{ $preview }} " style="background-image:url('{{ $preview }}')">
                            <button class='btn btn-dark text-light btn-md edit-btn' wire:click='GeneratFixQR("{{$key}}")'
                                onclick="event.stopPropagation()">
                                <i class="fa fa-download"></i>
                            </button>
                            <button class='btn btn-dark text-light btn-md edit-btn preview-btn' >
                                <i class="fa fa-eye"></i>
                            </button>

                            <button class='btn btn-orange text-light btn-md edit-btn modal-btn config_modal' onclick="event.stopPropagation()" data-id='{{$key}}' data-background="{{$template['page']['color']}}" data-content="{{$template['text']['color']}}" data-qr="{{$template['QR_code']['color']}}">
                                <i class="fa fa-paint-brush"></i>
                            </button>

                            
                            <div class='loading-div d-none' wire:loading.class.remove="d-none"
                                wire:target='GeneratFixQR("{{$key}}")'>
                                <div class="spinner-border text-info" role="status"
                                    style='width:30px;height:30px;float:right'>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    @foreach ($all_qr as $image)
                        <li class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 qr-div hero-image  mr-3"
                            data-responsive="{{ get_image('tmb/'.$image['preview']) }}"
                            data-src="{{ get_image('tmb/'.$image['preview']) }} " style='background-image:url("{{ get_image("tmb/".$image["preview"]) }}")'>
                            <button class='btn btn-dark text-light btn-md edit-btn' wire:click='GeneratQR({{$image["id"]}})'
                                onclick="event.stopPropagation()">
                                <i class="fa fa-download"></i>
                            </button>
                            <button class='btn btn-dark text-light btn-md edit-btn preview-btn'>
                                <i class="fa fa-eye"></i>
                            </button>
                            
                            <div class='loading-div d-none' wire:loading.class.remove="d-none"
                                wire:target='GeneratQR({{$image["id"]}})'>
                                <div class="spinner-border text-info" role="status"
                                    style='width:30px;height:30px;float:right'>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
        

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


    
    <div class="modal fade" id="modalimage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pop-up-type">Create Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class='row'>
                       <div class='col-md-6 col-12'>
                            <label  class="col-md-12 form-label">{{ $translations['background_color'] }}</label>
                            <input class="form-control color_input background_color" type="color" value="#000">    
                            <input class="form-control color_input_text background_color" placeholder="hexa" type="text"   wire:model='background_color'>                         
                        </div>
                        <div class='col-md-6 col-12'>
                            <label  class="col-md-12 form-label">{{ $translations['content_color'] }}</label>
                            <input class="form-control color_input content_color" type="color"  value="#000">    
                            <input class="form-control color_input_text content_color" placeholder="hexa" type="text"   wire:model='content_color'>                         
                         
                        </div>
                        <div class='col-md-6 col-12'>
                            <label  class="col-md-12 form-label">{{ $translations['qr_color'] }}</label>
                            <input class="form-control color_input qr_color" type="color" value="#000">     
                            <input class="form-control color_input_text qr_color" placeholder="hexa" type="text"   wire:model='qr_color'>                         
                        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal" id='cancel'>{{ $translations['close'] }}</button>
                    <button type="button" class="btn btn-orange submit"  id='download' data-id='' >{{ $translations['download'] }}</button>
                </div>
            </div>
        </div>
    </div>




</div>

@section('js')


<script src="{{URL::asset('assets/plugins/gallery/picturefill.js')}}"></script>
<script src="{{URL::asset('assets/plugins/gallery/lightgallery.js')}}"></script>
<script src="{{URL::asset('assets/plugins/gallery/lg-pager.js')}}"></script>
<script src="{{URL::asset('assets/plugins/gallery/lg-autoplay.js')}}"></script>
<script src="{{URL::asset('assets/plugins/gallery/lg-fullscreen.js')}}"></script>
<script src="{{URL::asset('assets/plugins/gallery/lg-zoom.js')}}"></script>
<script src="{{URL::asset('assets/plugins/gallery/lg-hash.js')}}"></script>
<script src="{{URL::asset('assets/plugins/gallery/lg-share.js')}}"></script>
<script src="{{URL::asset('assets/js/gallery.js')}}"></script>

<script>
$(document).ready(function() {
    $('#copy_link').click(function() {
        // Select the input field
        var input = $('#input_link');
        // Copy the text inside the input field to the clipboard
        navigator.clipboard.writeText(input.val()).then(function() {
            swalTimer('success', "{{ $translations['link_copied'] }}")
        }).catch(function(err) {
            console.error('Could not copy text: ', err);
        });
    });
});


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


$('.config_modal').on('click', function() {

    var key = $(this).data('id');
    var background_color = $(this).data('background');
    var content_color = $(this).data('content');
    var qr_color = $(this).data('qr');

    $('.background_color').val(background_color);
    $('.content_color').val(content_color);
    $('.qr_color').val(qr_color);
    $('#download').attr('data-id',key);

    $('#modalimage').modal({
        show: true
    });
    
});


$('#download').on('click', function() {
    var key = $(this).data('id');
    Livewire.emit('GeneratFixQR',key)
});

$('.background_color').on('change', function() {
    var color = $(this).val();
    $('.background_color').val(color)
    @this.background_color = color ;

});

$('.content_color').on('change', function() {
    var color = $(this).val();
    $('.content_color').val(color)
    @this.content_color = color ;

});

$('.qr_color').on('change', function() {
    var color = $(this).val();
    $('.qr_color').val(color)
    @this.qr_color = color ;
});

</script>
@endsection