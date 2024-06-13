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
{{-- <script src="{{ URL::asset('assets/plugins/sidemenu/main.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/sidemenu/defaultmenu.min.js') }}"></script> --}}

<!-- P-scroll js-->
<script src="{{ URL::asset('assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/p-scrollbar/p-scroll1.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/p-scrollbar/p-scroll.js') }}"></script>



<!--INTERNAL ECharts js-->
<!--INTERNAL Apexchart js-->
<script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/echarts/echarts.js') }}"></script>

<!--INTERNAL Index js-->

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
                }else if(result.isConfirmed && event.detail.function != undefined){
                    Livewire.emit(event.detail.function);
                }
            });
    });
</script>
