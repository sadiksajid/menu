<div>

    <style>
    .delete_bg_color {
        background-color: #eb6a6a;
        /* Optional: to reset default margin */
    }

    .collapse_div {
        background-color: white;
        width: 0px;
        height: 100vh;
        position: fixed;
        z-index: 99999;
        right: 0px;
        top: 0px;
        transition: 0.5s;
        overflow: auto;
    }

    .collapse_div_show {
        width: 450px !important;
        padding: 20px;

    }

    .collapse_div_hover {
        background-color: #000000;
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 9999;
        top: 0;
        left: 0;
        opacity: 0;
        transition: 0.5s;
    }


    .collapse_div_hover_opacity {
        opacity: 0.5 !important;
    }



    h3 {
        font: 25px sans-serif;
        text-align: center;
        text-transform: uppercase;
    }




    h3.no-background {
        position: relative;
        overflow: hidden;
    }

    .h2-span {
        display: inline-block;
        vertical-align: baseline;
        zoom: 1;
        *display: inline;
        *vertical-align: auto;
        position: relative;
        padding: 0 20px;

        &:before,
        &:after {
            content: '';
            display: block;
            width: 1000px;
            position: absolute;
            top: 0.73em;
            border-top: 1px solid black;
        }

        &:before {
            right: 100%;
        }

        &:after {
            left: 100%;
        }
    }
    </style>
    

    <div class="container-fluid">
        <div class='collapse_div_hover d-none' id='collapse_div_close'>

        </div>

        <div class="row">
            <div class="col-md-1 col-12 p-0" style="max-height: 88vh;overflow:auto">
                <ul class="side-menu app-sidebar3">
                    <li class="slide">
                        <a class="side-menu__item p-0" href="#" wire:click='SelectCat(0)'>
                            <img src="{{ URL::asset('assets/images/all.png') }}" alt="..." style='    width: 70px;
                            height: 70px;object-fit: cover; @if($selected_cat ==0 )  border: 3px solid black;  @endif'
                                class='img-thumbnail rounded-pill'>

                            <h5> {{$translations['all']}}</h5>
                        </a>
                    </li>

                    @foreach ( $categories as $category)
                    <li class="slide" style="cursor: pointer">
                        <a class="side-menu__item p-0" rol="button" wire:click='SelectCat({{$category["id"]}})'>
                            <img src="{{ get_image('tmb/'.$category['image']) }}" alt="..."
                                style='    width: 70px;
                            height: 70px;object-fit: cover; @if($selected_cat == $category["id"] )  border: 3px solid black;  @endif' class='img-thumbnail rounded-pill'
                                onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';">

                            <h5> {{ $category['title_tr'] }} </h5>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-7 col-12" style="max-height: 88vh;overflow:auto">
                <div class="row">
                    @if(count($offers) != 0)
                    <div class="col-12">
                        <h3 class="no-background"><span class='h2-span'>offers</span></h3>
                    </div>
                    @endif
                    @foreach ( $offers as $offer)
                    <div class="col-xl-2  col-md-3 col-6" wire:click='SelectProd({{$offer->id}},1)'
                        style="cursor: pointer">
                        <div class="card overflow-hidden">
                            <div
                                style="overflow: hidden;
                                                width: 100%;
                                                height: 150px;
                                                position:relative;
                                                @if(in_array('o_'.$offer->id,$selected_products_ids)) border: 4px solid #343a40; @endif">
                                <span class="badge badge-dark" role="button"
                                    style="position: absolute; z-index:10;color:white;top:0px">
                                    <h5 class="mb-0"><strong>{{ $offer->price}} {{$currency}}</strong></h5>
                                </span>
                                <div
                                    style="background-color:rgb(0,0,0,0.5);position: absolute; z-index:10;color:white;bottom:0px;width:100%;height:30%;display: flex;justify-content: center;align-items: center;padding: 5px 5px 5px 5px;">
                                    <center>
                                        <h6 class="card-title " style='font-size: 101%;'>{{$offer->title}}</h6>
                                    </center>
                                </div>
                                <img src="{{ get_image('tmb/'.$offer->image) }}" lass="card-image1 "
                                    style='height: 100%;width: 100%;'
                                    onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';">
                            </div>
                        </div>
                    </div>

                    @endforeach


                    @foreach ( $categories as $category)
                    @php
                    $products_cat = $products->where('product_category_id', $category["id"]) ;
                    @endphp
                    @if(count($products_cat) != 0)
                    <div class="col-12">
                        <h3 class="no-background"><span class='h2-span'>{{ $category['title_tr'] }} </span></h3>
                    </div>
                    @endif
                    @foreach ( $products_cat as $product)

                    <div class="col-xl-2  col-md-3 col-6 caise_prod" style="cursor: pointer" data-id="{{$product->id}}">
                        <div class="card overflow-hidden">
                            <div
                                style="overflow: hidden;
                                                width: 100%;
                                                height: 150px;
                                                position:relative;
                                                @if(in_array($product->id,$selected_products_ids)) border: 4px solid #343a40; @endif">
                                <span class="badge badge-dark" role="button"
                                    style="position: absolute; z-index:10;color:white;top:0px">
                                    <h5 class="mb-0"><strong>{{ $product->price}} {{$currency}}</strong></h5>
                                </span>
                                <div
                                    style="background-color:rgb(0,0,0,0.5);position: absolute; z-index:10;color:white;bottom:0px;width:100%;height:30%;display: flex;justify-content: center;align-items: center;padding: 5px 5px 5px 5px;">
                                    <center>
                                        <h6 class="card-title " style='font-size: 101%;'>{{$product->title }}</h6>
                                    </center>
                                </div>
                                <img src="{{ get_image('tmb/'.$product->media[0]->media) }}" lass="card-image1 "
                                    style='height: 100%;width: 100%;'
                                    onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';">
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @endforeach

                </div>
            </div>
            <div class="col-md-4 col-12">
                <!-- ///////////////////////////////////////////////////////// -->
                <div class='collapse_div'>




                    @php
                    krsort($new_orders);
                    @endphp
                    @foreach ( $new_orders as $order )
                    @php
                    if(isset($order["offers"])){
                    if($order["offers"] == null){
                    $is_offer = 0 ;
                    }else{
                    $is_offer = 1 ;
                    }
                    }else{
                    $is_offer = 0 ;
                    }

                    @endphp
                    <div class="list-card pb-0"
                        style="padding: 7px 11px;width: 410px!important;border-top: 2px solid #524f4f;border-bottom: 2px solid #524f4f;border-right: 2px solid #524f4f;border-radius: 0px 20px 20px 0px;">
                        <span class="bg-info list-bar"></span>
                        <button class='btn btn-info' style='height: 70px;float: left;'
                            wire:click='editOrder({{$order["id"]}},{{$is_offer}})'>
                            <i class="fe fe-edit me-1 d-inline-flex"></i>
                        </button>
                        <button class='btn btn-danger' style='height: 70px;float:right'
                            wire:click='deleteOrder({{$order["id"]}})'>
                            <i class="fe fe-trash-2 me-1 d-inline-flex"></i>
                        </button>
                        <div class="row align-items-center">
                            <div class="col-12 pr-0">
                                <div class="d-sm-flex mt-0">

                                    <div class="media-body ms-3 ">
                                        <span class="avatar avatar-rounded border border-info"
                                            style="width: 92%;height: auto;border-radius:50px;border-radius: 10px;background-color:#444444;font-size: 17px;">
                                            Order ID : {{$order['id']}}
                                        </span>
                                        <div class="p-0" style="float: right;margin-right: 20px; margin-top: 3px;">
                                            <div class="text-end"> <span class="fw-semibold  fs-16 number-font">
                                                    <center>
                                                        <h3 style=" margin: 0;">{{$order['total']  }} {{$currency}}</h3>
                                                    </center>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-md-flex align-items-center mt-1">
                                            <p class="ml-1 mt-1" style='font-size: 14px;'>
                                                <strong>{{\Carbon\Carbon::parse($order['created_at'])->format('Y-m-d H:i') }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    @endforeach
                </div>
                <!-- ///////////////////////////////////////////////////////// -->

                <div class="card pb-2 ">
                    <div class="card-header">
                        <h5 class="card-title">{{$translations['selected_products']}} - {{count($selected_products)}}
                        </h5>
                        <button class="btn btn-warning label-btn rounded-pill"
                            style="float: right;right: 13px; position: absolute;" wire:click='ResetAll()'> <i
                                class="fa fa-refresh label-btn-icon me-2 rounded-pill" style='color:black'></i>
                        </button>
                    </div>
                    <div class="card-body p-2" style="height: 50vh;overflow:auto">
                        @foreach ( $selected_products as $product )

                        <div class="list-card pb-0" style="padding: 9px 11px;!important" data-id='{{$product["id"]}}'>
                            <span class="bg-warning list-bar"></span>
                            <div class="row align-items-center">
                                <div class="col-7 pr-0">
                                    <div class="d-sm-flex mt-0">

                                        <div class="media-body ms-3 ">
                                            <span class="avatar avatar-rounded border border-warning"
                                                style="width: 2.3rem;height: 2.3rem;border-radius:50px;    border-radius: 10px">
                                                <img src="{{ get_image('tmb/'.$product['image']) }}" alt="img"
                                                    style="    border-radius: 10px;"
                                                    onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';">
                                            </span>
                                            <div class="p-0" style="float: right;margin-right: 50px; margin-top: 10px;">
                                                <div class="text-end"> <span class="fw-semibold  fs-16 number-font">
                                                        <center>
                                                            {{$product['price'] * $selected_products_qty[$product['id']] }}
                                                            {{$currency}}</center>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="d-md-flex align-items-center mt-1">
                                                <p class="ml-1 mt-1"><strong>{{$product['title'] }}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 p-0 pr-2">
                                    <div class="input-group mb-3">
                                        <button class="btn btn-dark" type="button" class="button-addon1"
                                            wire:click='changeQte({{$product["id"] }},"plus")'>+</button>
                                        <input type="text" class="form-control" placeholder=""
                                            aria-label="Example text with button addon" aria-describedby="button-addon1"
                                            wire:model="selected_products_qty.{{$product['id'] }}"
                                            style=" text-align: center;">
                                        <button class="btn btn-dark" type="button" class="button-addon1"
                                            wire:click='changeQte({{$product["id"] }},"minus")'>-</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

                <div class="card bg-warning">
                    <div class="card-body p-2">
                        <div class="no-block ">
                            <div>
                                <h2 class="text-fixed-white m-0 fw-bold"
                                    style="float: left;    margin-top: 5px !important;">{{$translations['total']}} :
                                    {{$total}}</h2>
                            </div>
                            <div class="ms-auto" style="float: right"> <span
                                    class="text-fixed-white display-6">{{$currency}}</span> </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if($update_order == false)
                    <div class="col-12">
                        <button class="btn btn-dark btn-lg" style="width:100%" wire:click="ValidCheckout()"
                            id='checkout'>{{$translations['checkout']}} <i
                                class="fe fe-dollar-sign me-1 d-inline-flex"></i>

                        </button>
                    </div>
                    @else
                    <div class="col-8">
                        <button class="btn btn-primary btn-lg" style="width:100%"
                            wire:click="confirmPassword('updateOrder')" id='checkout'>{{$translations['update']}} <i
                                class="fe fe-edit-sign me-1 d-inline-flex"></i>

                        </button>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-danger btn-lg" style="width:100%"
                            wire:click="cancelUpdate()">{{$translations['cancel']}}
                            <i class="fe fe-close-sign me-1 d-inline-flex"></i>

                        </button>
                    </div>
                    @endif
                    <div class="col-6 mt-5">
                        <button class="btn btn-info btn-lg " style="width:100%" id='collapse_div_show'>Orders <i
                                class="fe fe-clock me-1 d-inline-flex"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style='background-color:#705ec8'>
                <div class="modal-body">
                    <input type="text" id='functionName' class='d-none'>
                    <input type="text" id='functionId' class='d-none'>
                    <center>
                        <lottie-player src="{{ URL::asset('assets/SVG/code_bar.json') }}" background="transparent"
                            speed="0.2" style="width:250px;margin-top:-30px" loop autoplay></lottie-player>
                        <h4 style='color:white ; margin-top: -39px;'>Please Scan your Cart!</h4>
                    </center>
                </div>
                <div class="modal-footer border-0" style='    justify-content: center;'>

                    <button type="button" tabindex="-1" class="btn btn-light mr-6" id='scanToPassword'>Use
                        Password</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>


    <!-- @if( $show_pdf )
    <a href="#" class="d-none " id='wait_print'></a>
    <div id='print_show'></div>
    @endif -->

    <div id="print_show" class='d-none'>
        <iframe id="pdf_iframe"  style="width: 100%; height: 500px;"></iframe>
    </div>



</div>
@section('js')



<script src="{{ URL::asset('dist/ScannerScript.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
$(document).ready(function() {


    $(document).on("click", '.caise_prod', function(event) {
        Livewire.emit('SelectProd', $(this).data('id'));
    });


    $("#collapse_div_show").on("click", function(event) {
        $('.collapse_div').addClass("collapse_div_show");
        $('.collapse_div_hover').removeClass("d-none");

        setTimeout(() => {
            $('.collapse_div_hover').addClass("collapse_div_hover_opacity");
        }, 100);


    });

    $("#collapse_div_close").on("click", function(event) {
        $('.collapse_div').removeClass("collapse_div_show");
        $('.collapse_div_hover').removeClass("collapse_div_hover_opacity");

        setTimeout(() => {
            $('.collapse_div_hover').addClass("d-none");
        }, 1000);


    });


    /////////////////////////////////////////////////// show pdf print
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
    var blob = new Blob([view], { type: 'application/pdf' });
    var url = URL.createObjectURL(blob);

    // Set the source of the existing iframe to the Blob URL
    var iframe = document.getElementById('pdf_iframe');
    // $('#print_show').removeClass("d-none");

    iframe.src = url;

    // Add an event listener for when the iframe has loaded
    iframe.onload = function() {
        // Trigger the print dialog

        iframe.contentWindow.print();

        // Add an event listener for after printing
        window.addEventListener('afterprint', () => {
            // Clear the div when the print modal is closed
            iframe.src = '';
        });
    };
});


    window.addEventListener('pdfRenderedPrint', event => {


        var url = event.detail.url;

        $("#wait_print").attr("href", url);

        $('#wait_print').addClass("print_python");


    });



    window.addEventListener('swip', event => {

        // Variables to store the initial touch position
        let initialX = null;
        let initialY = null;

        // Add touch event listeners to the draggable elements
        $(".list-card").on("touchstart", function(event) {
            const touch = event.touches[0];
            initialX = touch.clientX;
            initialY = touch.clientY;
            $(this).addClass("dragging");
        });

        $(".list-card").on("touchmove", function(event) {
            if (initialX === null || initialY === null) {
                return;
            }
            const touch = event.touches[0];
            const currentX = touch.clientX;
            const deltaX = currentX - initialX;
            if (deltaX > $(this).width() / 2) {
                $(this).addClass("delete_bg_color");
            } else {
                $(this).removeClass("delete_bg_color");

            }
            if (deltaX > $(this).width() / 10) {
                $(this).css({
                    transform: `translateX(${deltaX}px)`
                });
                event.preventDefault();
            }

        });

        $(".list-card").on("touchend", function(event) {
            if (initialX === null || initialY === null) {
                return;
            }
            const touch = event.changedTouches[0];
            const currentX = touch.clientX;
            const deltaX = currentX - initialX;
            $(this).removeClass("dragging");

            if ($(this).hasClass("delete_bg_color")) {
                var id = $(this).data('id');
                $(this).remove();
                Livewire.emit('RemoveProd', id);
            }

            $(this).css({
                transform: "translateX(0)"
            });

            initialX = null;
            initialY = null;
        });


    });




    window.addEventListener('confirmPassword', event => {

        // Get the modal

        //////////////////////////////////// password 
        function password() {
            Swal.fire({
                title: "Submit your password",

                html: `
                    <center> <lottie-player src="{{ URL::asset('assets/SVG/password.json') }}"  background="transparent"  speed="0.2"  style="width:250px;margin-top:-30px"  loop  autoplay></lottie-player> </center>
                `,

                input: "password",
                showCancelButton: true,
                confirmButtonText: "Next",
                confirmButtonColor: '#7066e0',
                customClass: {
                    popup: 'swal2-custom-zindex' // Apply the custom z-index class
                },
            }).then((result) => {
                if (result.isConfirmed) {

                    try {
                        $.ajax({
                            url: '{{ route("check_admin_password") }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // CSRF token
                                password: result.value,

                            },
                            success: function(response) {
                                if (response.data == -1) {
                                    Swal.fire({
                                        title: "Incorrect Password!",
                                        text: "Please Try Again",
                                        icon: "error"
                                    });
                                } else {
                                    data = {
                                        val: event.detail.id,
                                        id: response.data,
                                        name: response.name
                                    }
                                    Livewire.emit(event.detail.function, data);

                                }
                            },
                            error: function(err) {
                                Swal.fire({
                                    title: "Incorrect Password!",
                                    text: "Please Try Again",
                                    icon: "error"
                                });
                            }
                        });


                    } catch (error) {
                        Swal.fire({
                            title: "Incorrect Password!",
                            text: "Please Try Again",
                            icon: "error"
                        });
                    }


                }
            });
        }

        //////////////////////////////////////////////////// scamner

        function scanner() {


            $('#functionName').val(event.detail.function);
            $('#functionId').val(event.detail.id);

            $('#scanModal').modal("show");

            $("#scanToPassword").on("click", function(event) {
                $('#scanModal').modal("hide");

                password()
            });

        }

        scanner()
    });


    window.addEventListener('close_modal', event => {
        $('#scanModal').modal("hide");
    });

    var modalScan = document.getElementById('scanModal');


    document.body.addEventListener('keydown', function(event) {
        if (modalScan.style.display === 'block') { // Check if modal is shown
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent the default action
            }
            getkey(event); // Call getkey function
        }
    });


});
</script>
@endsection