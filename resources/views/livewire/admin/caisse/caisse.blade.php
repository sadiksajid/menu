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
        transition: 1s;
        overflow:auto;
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
        transition: 1s;
    }


    .collapse_div_hover_opacity{
        opacity: 0.5!important;
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
                        <a class="side-menu__item p-0" rol="button" wire:click='SelectCat({{$category['id']}})'>
                            <img src="{{ get_image('tmb/'.$category['image']) }}" alt="..."
                                style='    width: 70px;
                            height: 70px;object-fit: cover; @if($selected_cat == $category["id"] )  border: 3px solid black;  @endif' class='img-thumbnail rounded-pill'>

                            <h5> {{ $category['title'] }} </h5>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-7 col-12" style="max-height: 88vh;overflow:auto">
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-3 col-6" wire:click='SelectProd({{$product["id"]}})' style="cursor: pointer">
                        <div class="card overflow-hidden">
                            <div style="overflow: hidden;
                                            width: 100%;
                                            height: 150px;
                                            position:relative;
                                            @if(in_array($product['id'],$selected_products_ids)) border: 4px solid #343a40; @endif">
                                <span class="badge badge-dark" role="button"
                                    style="position: absolute; z-index:10;color:white;top:0px">
                                    <h5 class="mb-0"><strong>{{ $product['price']}} {{$currency}}</strong></h5>
                                </span>
                                <div
                                    style="background-color:rgb(0,0,0,0.6);position: absolute; z-index:10;color:white;bottom:0px;width:100%">
                                    <center>
                                        <h6 class="card-title ">{{$product->title }}</h6>
                                    </center>
                                </div>
                                <img src="{{ get_image('tmb/'.$product->media[0]->media) }}" lass="card-image1 "
                                    style='height: 100%;width: 100%;'>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="col-md-4 col-12">
                <!-- ///////////////////////////////////////////////////////// -->
                <div class='collapse_div'>
                    @foreach ( $new_orders as $order )

                    <div class="list-card pb-0" style="padding: 9px 11px;width: 410px!important ;border-top: 2px solid #524f4f;border-bottom: 2px solid #524f4f;border-right: 2px solid #524f4f;border-radius: 0px 20px 20px 0px;"> 
                        <span class="bg-info list-bar"></span>
                        <button class='btn btn-info' style='height: 100px;float: left;' wire:click='editOrder({{$order["id"]}})'>
                            <i  class="fe fe-edit me-1 d-inline-flex"></i>
                        </button>
                        <button class='btn btn-danger' style='height: 100px;float:right' wire:click='deleteOrder({{$order["id"]}})'>
                            <i  class="fe fe-trash-2 me-1 d-inline-flex"></i>
                        </button>
                        <div class="row align-items-center">
                            <div class="col-12 pr-0">
                                <div class="d-sm-flex mt-0">

                                    <div class="media-body ms-3 ">
                                        <span class="avatar avatar-rounded border border-info"
                                            style="width: 10rem;height: 2.3rem;border-radius:50px;    border-radius: 10px;background-color:#444444;font-size:20px">
                                            Order ID : {{$order['id']}}
                                        </span>
                                        <div class="p-0" style="float: right;margin-right: 20px; margin-top: 25px;">
                                            <div class="text-end"> <span class="fw-semibold  fs-16 number-font">
                                                    <center><h1>{{$order['total']  }} {{$currency}}</h1></center>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-md-flex align-items-center mt-1">
                                            <p class="ml-1 mt-1" style='font-size: 19px;'><strong>{{\Carbon\Carbon::parse($order['created_at'])->format('Y-m-d H:i') }}</strong></p>
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
                                                    style="    border-radius: 10px;">
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
                        <button class="btn btn-primary btn-lg" style="width:100%" wire:click="updateOrder()"
                            id='checkout'>{{$translations['update']}} <i
                                class="fe fe-edit-sign me-1 d-inline-flex"></i>

                        </button>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-danger btn-lg" style="width:100%" wire:click="cancelUpdate()">{{$translations['cancel']}}
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
    <a href="#" class="d-none " id='wait_print'></a>



</div>
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
<script>
$(document).ready(function() {

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
    window.addEventListener('pdfRendered', event => {


        var url = event.detail.url;

        $("#wait_print").attr("href", url);

        $('#wait_print').addClass("print_python");

        // var pdfData = event.detail.pdfData;
        // // Decode the base64 string to binary data
        // var binary = atob(pdfData);
        // var len = binary.length;
        // var buffer = new ArrayBuffer(len);
        // var view = new Uint8Array(buffer);

        // for (var i = 0; i < len; i++) {
        //     view[i] = binary.charCodeAt(i);
        // }

        // // Create a Blob object from the binary data
        // var blob = new Blob([view], { type: 'application/pdf' });
        // var url = URL.createObjectURL(blob);

        // console.log(blob,view,url)

        ////////////////////////////////////////////



        // // Open a new window and write an iframe to display the PDF
        // var win = window.open("", "_blank");
        // win.document.write("<iframe src='" + url + "' width='100%' height='100%'></iframe>");
        // win.focus();


        // var pdfData = event.detail.pdfData;
        // console.log(pdfData);

        // // Decode the base64 string to binary data
        // var binary = atob(pdfData);
        // var len = binary.length;
        // var buffer = new ArrayBuffer(len);
        // var view = new Uint8Array(buffer);

        // for (var i = 0; i < len; i++) {
        //     view[i] = binary.charCodeAt(i);
        // }

        // // Create a Blob object from the binary data
        // var blob = new Blob([view], { type: 'application/pdf' });
        // var url = URL.createObjectURL(blob);

        // // Create an iframe to embed the PDF
        // var iframe = document.createElement('iframe');
        // iframe.style.display = 'none';
        // iframe.src = url;
        // document.body.appendChild(iframe);

        // iframe.onload = function() {
        //     // Wait for the iframe to load, then trigger the print dialog
        //     iframe.contentWindow.print();
        // };

    });


    window.addEventListener('swip', event => {

        // $(".list-card").each(function() {
        //     var hammer = new Hammer(this);
        //     console.log(hammer)

        //     hammer.on("swipe", function(event) {
        //         if (event.direction === Hammer.DIRECTION_RIGHT) {
        //             $(this).addClass("swiped");
        //             console.log('swiperight')

        //         } else if (event.direction === Hammer.DIRECTION_LEFT) {
        //             $(this).removeClass("swiped");
        //             console.log('swipeleft')

        //         }
        //     });
        // });

        // $(".list-card").draggable({
        //     // axis: "x", // Allow dragging only along the horizontal axis
        //     containment: "parent", // Restrict movement within the parent container
        //     start: function(event, ui) {
        //         // Add a class to the card when dragging starts
        //         $(this).addClass("dragging");
        //     },
        //     stop: function(event, ui) {
        //         // Remove the dragging class when dragging stops
        //         $(this).removeClass("dragging");

        //         // If the card is swiped enough to the right, mark as swiped
        //         if (ui.position.left > $(this).width() / 2) {
        //             $(this).addClass("swiped");

        //             console.log('swipeleft')
        //         } else {
        //             $(this).removeClass("swiped");
        //             console.log('swiperight')
        //         }

        //         // Reset the card's position
        //         $(this).css({ left: 0 });
        //     }
        // });

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

            // if (deltaX > $(this).width() / 2) {
            //     $(this).addClass("swiped");

            // }
            //  else {
            //     $(this).removeClass("swiped");
            //     console.log("swiperight");
            // }

            $(this).css({
                transform: "translateX(0)"
            });

            initialX = null;
            initialY = null;
        });


    });

    // // Add click event to delete button
    // $(".delete-btn").click(function() {
    //     // Perform delete operation here
    //     $(this).closest(".list-card").remove();
    // });
});
</script>
@endsection