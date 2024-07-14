  <!-- Title -->
  <title>GoodForHealth - Admin Panel</title>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!--Favicon -->
  <link rel="icon" href="{{ URL::asset('assets/images/brand/favicon.png') }}" type="image/x-icon" />

  <!--Bootstrap css -->
  <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Style css -->
  <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('assets/css/dark.css') }}" rel="stylesheet" />
  <link href="{{ URL::asset('assets/css/skin-modes.css') }}" rel="stylesheet" />

  <!-- Animate css -->
  <link href="{{ URL::asset('assets/css/animated.css') }}" rel="stylesheet" />

  <!--Sidemenu css -->
  <link href="{{ URL::asset('assets/css/sidemenu.css') }}" rel="stylesheet">

  <!-- P-scroll bar css-->
  <link href="{{ URL::asset('assets/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />

  <!---Icons css-->
  <link href="{{ URL::asset('assets/css/icons.css') }}" rel="stylesheet" />
  @yield('css')

  <!-- Simplebar css -->
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins/simplebar/css/simplebar.css') }}">
  <link href="{{ URL::asset('assets/plugins/fileupload/css/fileupload.css') }}" rel="stylesheet" type="text/css" />

  <!-- INTERNAL Mutipleselect css-->
  <link rel="stylesheet" href="{{ URL::asset('assets/plugins/multipleselect/multiple-select.css') }}">
  <!-- INTERNAL File Uploads css-->
  <link href="{{ URL::asset('assets/plugins/fileupload/css/fileupload.css') }}" rel="stylesheet" type="text/css" />

  <!-- Color Skin css -->
  <!-- <link id="theme" href="{{ URL::asset('assets/colors/color1.css') }}" rel="stylesheet" type="text/css" /> -->

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <link href="{{ URL::asset('assets/plugins/morris/morris.css') }}" rel="stylesheet" />

  <link rel="stylesheet" href="{{ URL::asset('js/leaflet.css') }}" />
  <link rel="stylesheet" href="{{ URL::asset('js/Control.Geocoder.css') }}" />


  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />




  @livewireStyles
