 <!-- Fav icon -->
 <link href="{{ URL::asset('assets2/images/logo/favicon.png') }}" rel="shortcut icon">
 <!-- Font Family-->
 <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
 <!--bootstrap css-->
 <link href="{{ URL::asset('assets2/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
 <!-- color css -->
 <link href="{{ URL::asset('assets2/css/inner-page.css') }}" rel="stylesheet" type="text/css">
 <!-- Icons -->
 <link href="{{ URL::asset('assets2/css/fontawesome.css') }}" rel="stylesheet" type="text/css">
 <link href="{{ URL::asset('assets2/css/themify.css') }}" rel="stylesheet" type="text/css">
 <link href="{{ URL::asset('assets2/css/owl.carousel.min.css') }}" rel="stylesheet">
 <link href="{{ URL::asset('assets2/css/owl.theme.default.min.css') }}" rel="stylesheet">
 <link href="{{ URL::asset('assets2/css/slick.css') }}" rel="stylesheet" type="text/css">
 <link href="{{ URL::asset('assets2/css/slick-theme.css') }}" rel="stylesheet" type="text/css">

 <link href="{{ URL::asset('assets2/css/magnific-popup.css') }}" rel="stylesheet">
 <link href="{{ URL::asset('assets3/css/style.css') }}" rel="stylesheet">
 <link href="{{ URL::asset('assets\plugins\select2\select2.min.css') }}" rel="stylesheet">
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <style>
     .hover-overlay:hover {
         transform: scale(1.1);

     }

     .red-color {
         color: #ee042c;
     }

     .red-bg-color {
         background-color: #ee042c !important;
     }

     .gray-bg-color {
         background-color: #3c3c3c !important;
     }

     .text-white {
         color: white !important;

     }
 </style>
 @livewireStyles
 @yield('css')
