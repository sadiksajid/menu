<script src="assets_home/js/jquery-3.7.0.js"></script>
<script src="assets_home/js/jquery-migrate-3.4.1.js"></script>
<script src="assets_home/js/slick.min.js"></script>
<script src="assets_home/js/scrollreveal.js"></script>
<script src="assets_home/js/swiper-bundle.min.js"></script>
<script src="assets_home/js/bootstrap.bundle.min.js"></script>
<script src="assets_home/js/countUp.min.js"></script>
<script src="assets_home/js/waypoints.min.js"></script>
<script src="assets_home/js/phosphor-icons.js"></script>
<script src="assets_home/js/main.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/Bluefieldscom/intl-tel-input/master/lib/libphonenumber/build/utils.js"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

@csrf



<script>
    $(document).ready(function() {
    const input = document.querySelector("#phone");
    const input_country = document.querySelector("#country_code");


    var iti =  window.intlTelInput(input, {
    initialCountry: "ma",
    strictMode: true,
    separateDialCode: true,

    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/utils.js?1716383386062" // just for formatting/placeholders etc
  });


  function updateInputValue() {
            // Ensure the input field has a value
            var phoneValue = input.value.trim();
            if (phoneValue !== '') {
                if (iti.isValidNumber()) {
                    var fullPhoneNumber = iti.getNumber();
                    console.log("Full Phone Number:", fullPhoneNumber); // Log the full phone number for debugging
                    input.value = fullPhoneNumber; // Update the input field with the full phone number
                } else {
                    console.log("Invalid phone number");
                    input.value = 'none';
                }

            } else {
                console.log("Phone input is empty");
            }
        }

        // Listen for the 'countrychange' event
        input.addEventListener('countrychange', function() {
            getCountryName()
            // updateInputValue();
        });

        function getCountryName() {
            var countryData = iti.getSelectedCountryData();
            console.log("Country Name:", countryData.iso2);
            input_country.value = countryData.iso2;
            // $('#country_code').val(countryData.iso2)
        }

        // Update the input value on form submit
        // $('#Register').on('submit', function() {
        //     updateInputValue();
        //     getCountryName();
        // });
        $('#submit_register').on('click', function() {
            updateInputValue();
            getCountryName();
            document.getElementById('Register').submit();
        });
        

        $('#phone').on('blur', function() {
            getCountryName();
        });
          // Populate the input field if there is an old value
          var oldCountryCode = '{{ old('country_code') }}';
          console.log()
          if (oldCountryCode) {
              iti.setCountry(oldCountryCode);
          }
        getCountryName();
      });

</script>
<script>
    $(document).ready(function() {


    //   $('#country').select2();

            ////////////////////////////////// popup login

        var popupLoginBlock = document.querySelector('#popup-login-block');
        var popupLoginMain = document.querySelector('#popup-login-block .popup-newsletter-main');
        var closePopupLoginBtn = document.querySelector('#popup-login-block .close-block');


        if (closePopupLoginBtn) {
            closePopupLoginBtn.addEventListener('click', function () {
            popupLoginBlock.classList.remove('open');
        });
        }


        // prevent default behavior when clicking mobile menu
        if (popupLoginMain) {
        popupLoginMain.addEventListener('click', function (event) {
            event.stopPropagation();
        });
        }

        ////////////////////////////////// popup register

        var popupRegisterBlock = document.querySelector('#popup-register-block');
        var popupRegisterMain = document.querySelector('#popup-register-block .popup-newsletter-main');
        var closePopupRegisterBtn = document.querySelector('#popup-register-block .close-block');


        if (closePopupRegisterBtn) {
            closePopupRegisterBtn.addEventListener('click', function () {
            popupRegisterBlock.classList.remove('open');
        });
        }


        // prevent default behavior when clicking mobile menu
        if (popupRegisterMain) {
        popupRegisterMain.addEventListener('click', function (event) {
            event.stopPropagation();
        });
        }

    ////////////////////////////////// news
        $('.register_popup').click(function(){
            if (popupRegisterBlock) {
                popupRegisterBlock.classList.add('open');
            }
        });
        $('#login_popup').click(function(){
            if (popupLoginBlock) {
                popupLoginBlock.classList.add('open');
            }
        });


        @if(session()->has('errors'))
        @php
            $is_login = false ;
            foreach(session()->get('errors')->keys() as $key){
                if($key == 'login_password' or $key == 'login_email'){
                    $is_login = true ;
                }

            }
        @endphp

        @if ($is_login)
            popupLoginBlock.classList.add('open');

        @else
            popupRegisterBlock.classList.add('open');
        @endif

        @endif
        @if(session()->has('error'))
            popupLoginBlock.classList.add('open');
        @endif


        
    });
    
    
</script>



@if(session('success_login'))
<script>
      if (popupLoginBlock) {
            popupLoginBlock.classList.add('open');
      }

      const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      timer: 10000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      }
    });
    Toast.fire({
      icon: "success",
      title: "Signed in successfully"
    });
</script>
@endif




@livewireScripts

<script>

    window.addEventListener('swal:timer', event => {

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 10000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
        Toast.fire({
            icon: event.detail.type,
            title: event.detail.message
            });

    });
</script>



@yield('js')