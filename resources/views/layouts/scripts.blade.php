<script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<!-- popper js-->
<script src="{{ URL::asset('assets2/js/popper.min.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{ URL::asset('assets2/js/bootstrap.js') }}"></script>
<!--  costamizer option -->
<!-- script js-->
<script src="{{ URL::asset('assets2/js/category.js') }}"></script>
<script src="{{ URL::asset('assets2/js/owl.carousel.min.js') }}"></script>

<!--  costamizer option -->
<script src="{{ URL::asset('assets2/js/custamizer-option.js') }}"></script>
<!--slick js-->
<script src="{{ URL::asset('assets2/js/slick.js') }}"></script>
<!--sticky js-->
<script src="{{ URL::asset('assets2/js/sticky-kit.js') }}" type="text/javascript"></script>
<!-- script js-->
<script src="{{ URL::asset('assets2/js/product.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets2/js/sticky.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets2/js/main.js') }}"></script>
<script src="{{ URL::asset('assets3/js/main.js') }}"></script>
<script src="{{ URL::asset('assets\js\select2.js') }}"></script>
<script src="{{ URL::asset('assets\js\bootstrap-notify.js') }}"></script>
<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"  />
<script src="{{ URL::asset('js/header.js') }}"></script>

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
</script>
@csrf
@livewireScripts
@yield('js')