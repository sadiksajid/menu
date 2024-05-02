<script src="{{URL::asset('assets/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{ URL::asset('assets/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ URL::asset('assets/aos/aos.js') }}"></script>
<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('assets/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('assets/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('assets/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ URL::asset('assets/typed.js/typed.min.js') }}"></script>
<script src="{{ URL::asset('assets/waypoints/noframework.waypoints.js') }}"></script>
<script src="{{ URL::asset('assets/php-email-form/validate.js') }}"></script>
<script>

$( document ).ready(function() {
    var background_color = sessionStorage.getItem("background_color");
    var text_color = sessionStorage.getItem("text_color");
    document.getElementById('footer').style.backgroundColor = background_color ;
    document.getElementById('fouter_text').style.color = text_color ;
});

  
  </script>
<script src="{{ URL::asset('assets/js/main-home.js') }}"></script>
<script src='js/app.js'></script>
