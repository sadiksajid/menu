<!-- Jquery js-->
<script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js') }}"></script>

<!-- Bootstrap4 js-->
<script src="{{ URL::asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!--Othercharts js-->
<script src="{{ URL::asset('assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

<!-- Circle-progress js-->
<script src="{{ URL::asset('assets/js/circle-progress.min.js') }}"></script>

<!-- Jquery-rating js-->
<script src="{{ URL::asset('assets/plugins/rating/jquery.rating-stars.js') }}"></script>

<!--Sidemenu js-->
<script src="{{ URL::asset('assets/plugins/sidemenu/sidemenu.js') }}"></script>

<!-- P-scroll js-->
<!-- <script src="{{ URL::asset('assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/p-scrollbar/p-scroll1.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/p-scrollbar/p-scroll.js') }}"></script> -->



<!--INTERNAL ECharts js-->
<!--INTERNAL Apexchart js-->
<script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/echarts/echarts.js') }}"></script>
<script src="{{ URL::asset('assets2/js/owl.carousel.min.js') }}"></script>

@yield('js')
<!-- Simplebar JS -->
<script src="{{ URL::asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<!-- Custom js-->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>
<script src="{{ URL::asset('js/config.js') }}"></script>
<script src="{{ URL::asset('js/leaflet.js') }}"></script>
<script src="{{ URL::asset('js/esri-leaflet.js') }}"></script>

<script src="{{ URL::asset('js/Control.Geocoder.js') }}"></script>
<script src="{{ URL::asset('js/esri-leaflet-geocoder.js') }}"></script>
<script src="{{ URL::asset('dist/easy-button.js') }}"></script>
<script src="{{ URL::asset('dist/leaflet-rotate-src.js') }}"></script>
<script src="{{ URL::asset('js/leaflet.icon-material.js') }}"></script>
<script src="{{ URL::asset('js/MarkerIcons.js') }}"></script>
<script src="{{ URL::asset('js\custom\mapScript.js') }}"></script>
<script src="{{ URL::asset('js/maps_call_functions.js') }}"></script>
<script src="{{ URL::asset('js\custom\maps_call_functions.js') }}"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


@livewireScripts



<script>

    window.addEventListener('swal:modal', event => {
        Swal.fire({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
        });
    });



    window.addEventListener('swal:modal_back', event => {
        Swal.fire({
                title: event.detail.title,
                text: event.detail.message,
                icon: event.detail.type,

            })
            .then((result) => {
                window.location.href = event.detail.url;

            });
    });




    window.addEventListener('swal:confirm_redirect', event => {
        Swal.fire({
                title: event.detail.title,
                text: event.detail.message,
                icon: event.detail.type,
                showCancelButton: event.detail.cancle ?? true,
                confirmButtonText: event.detail.confirmBtn ?? 'Back',
                cancelButtonText: 'Stay',

            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = event.detail.url;
                }
            });
    });

    window.addEventListener('swal:confirm', event => {
        Swal.fire({
                title: event.detail.title,
                text: event.detail.message,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: `No`,

            })
            .then((result) => {
                if (result.isConfirmed && event.detail.function == undefined) {
                    Livewire.emit('confirmed');
                }else if(result.isConfirmed && event.detail.function != undefined && event.detail.id == undefined){
                    Livewire.emit(event.detail.function);
                }else if(result.isConfirmed && event.detail.function != undefined && event.detail.id != undefined){
                    console.log(event.detail.id)
                    Livewire.emit(event.detail.function,event.detail.id);
                }
            });
    });


//     useScrol()
//    function useScrol(){
//         $(document).find('.saas-brand').owlCarousel({

//             autoHeight: true,
//             autoWidth: true,
//             nav: false,
//             dots: false,
//             autoplay: true,
//             slideSpeed: 300,
//             mouseDrag: true,
//             responsiveClass: true,
//             paginationSpeed: 400,
        
//         });


  
//         function changeFavicon() {
           
//            var src =  @json(get_image(\Auth::user()->store->logo)) ;
//            let link = document.getElementById('favicon');
//            if (link) {
//                link.href = src;
//            } else {
//                link = document.createElement('link');

//                link.id = 'favicon';
//                link.rel = 'icon';
//                link.href = src;
//                document.head.appendChild(link);
//            }
//        }

//        $(document).ready(function() {
//            changeFavicon();
//        });

//    }

</script>

