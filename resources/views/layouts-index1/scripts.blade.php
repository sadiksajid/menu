@php
    $json = app('translations');
    $translations = $json['system'];
@endphp
<!-- COMMON SCRIPTS -->
<!-- Jquery js-->
<script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js') }}"></script>

<!-- Bootstrap4 js-->
<script src="{{ URL::asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<!--Othercharts js-->
<script src="{{ URL::asset('assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

<!-- Circle-progress js-->
<script src="{{ URL::asset('assets/js/circle-progress.min.js') }}"></script>


<link href="{{ URL::asset('index1/css/wizard.css') }}" rel="stylesheet">

<script src="{{ URL::asset('index1/js/common_scripts.min.js') }}"></script>
<script src="{{ URL::asset('index1/js/slider.js') }}"></script>
<script src="{{ URL::asset('index1/js/common_func.js') }}"></script>
<script src="{{ URL::asset('index1/phpmailer/validate.js') }}"></script>

<!-- Bootstrap4 js-->
<script src="{{ URL::asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- SPECIFIC SCRIPTS -->
<script src="{{ URL::asset('index1/js/modernizr.min.js') }}"></script>


<!-- SPECIFIC SCRIPTS (wizard form) -->
<script src="{{ URL::asset('index1/js/wizard/wizard_scripts.min.js') }}"></script>
<script src="{{ URL::asset('index1/js/wizard/wizard_func.js') }}"></script>


<!-- SPECIFIC SCRIPTS -->
<!-- <script src="{{ URL::asset('index1/js/video_header.min.js') }}"></script> -->
<script src="{{ URL::asset('assets3/js/main.js') }}"></script>
<script src="{{ URL::asset('js/header.js') }}"></script>


<script src="{{ URL::asset('assets2/js/category.js') }}"></script>
<script src="{{ URL::asset('assets2/js/owl.carousel.min.js') }}"></script>
<script src="{{ URL::asset('assets\js\bootstrap-notify.js') }}"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


<script>
    window.addEventListener('changeURL', event => {
        var data = {
            message: "History updated with replaceState()"
        };
        // New title for the updated history entry
        var currentPath = window.location.pathname;
        var pathSegments = currentPath.replace(/^\/|\/$/g, '').split('/');
        var title = event.detail.title;
        var limit = event.detail.limit;
        var url = event.detail.url;
        // New URL for the updated history entry
        if (pathSegments.length < limit) {
            // Ensure there is a leading slash in the subpath
            if (!url.startsWith("/")) {
                url = "/" + url;
            }
            // Construct the new path by appending the subpath
            var url = currentPath + url;
        }
        // Use replaceState to update the current history entry
        window.history.pushState(data, title, url);
    });
    window.addEventListener('changeTitle', event => {
        // New title for the updated history entry
        $("title").text(event.detail.title);
    });

    function changeTitle(title) {
        $("title").text(title);
    }



    $(document).ready(function() {

        Livewire.emit('updateComponent')

        $('#closeLogin').click(function() {
            $('#modalLoginForm').modal('hide')
        })
        window.addEventListener('login_success', event => {
            $('#modalLoginForm').modal('hide')
            Livewire.emit('renderFunc')
        });
        window.addEventListener('login_faild', event => {
            $.notify({
                message: event.detail.message ?? "{{$translations['login_error']}}",
            }, {
                showProgressbar: true,
                type: "danger"
            });
        });


        $('.quantity-right-plus').on('click', function () {
        var $qty = $('.qty-box .input-number');
        var currentVal = parseInt($qty.val(), 10);
        if (!isNaN(currentVal)) {
            $qty.val(currentVal + 1);
            Livewire.emit('changeQte', [currentVal + 1]);
        }
        });
        $('.quantity-left-minus').on('click', function () {
            var $qty = $('.qty-box .input-number');
            var currentVal = parseInt($qty.val(), 10);
            if (!isNaN(currentVal) && currentVal > 1) {
                $qty.val(currentVal - 1);
                Livewire.emit('changeQte', [currentVal - 1]);

            }
        });


    });

  

    useScrol()
   function useScrol(){
    $(document).find('.saas-brand').owlCarousel({

        autoHeight: true,
        autoWidth: true,
        nav: false,
        dots: false,
        autoplay: true,
        slideSpeed: 300,
        mouseDrag: true,
        responsiveClass: true,
        paginationSpeed: 400,
       
    });


   }

   window.addEventListener('swal:confirm_redirect', event => {
        Swal.fire({
                title: event.detail.title,
                text: event.detail.message ?? '',
                icon: event.detail.type,
                showCancelButton: event.detail.cancle ?? true,
                confirmButtonText: event.detail.confirmBtn ?? 'Back' ,
                cancelButtonText: 'Stay',
                allowOutsideClick: event.detail.outClick ?? true,

            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = event.detail.url;
                }
            });
    });

    $(document).on('click','.login_show',function(){
        $('#modalLoginForm').modal('show')

    })

    $(document).on('click','.show_modal_language',function(){
        $('#select_modal_language').modal('show')

    })


    window.addEventListener('swal:chamgeLanguage', event => {
        $('#select_modal_language').modal('show')

    });
    $(document).ready(function() {
        Livewire.emit('checkLanguage')

        // $('#select_modal_language').modal('show')
        
    
    });


    function changeFavicon() {

            var src = $('#site_icon').attr('href');

            let link = document.getElementById('favicon');
            if (link) {
                console.log(link)
                link.href = src;
            } else {
                link = document.createElement('link');
                console.log(link)

                link.id = 'favicon';
                link.rel = 'icon';
                link.href = src;
                document.head.appendChild(link);
            }
        }

        // Example usage
    changeFavicon();


</script>
@csrf
@livewireScripts

@yield('js')