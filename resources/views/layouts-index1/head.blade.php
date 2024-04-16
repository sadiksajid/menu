<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Foores - Single Restaurant Version">
    <meta name="author" content="Ansonika">
    <title>CoolResto</title>
    <!-- Favicons-->
    <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/css/animated.css') }}" rel="stylesheet" />

    <link href="{{ URL::asset('assets2/css/inner-page-copy.css') }}" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" href="{{ URL::asset('index1/img/favicon.ico" type="image/x-icon') }}">
    <link rel="apple-touch-icon" type="image/x-icon"
        href="{{ URL::asset('index1/img/apple-touch-icon-57x57-precomposed.png') }} ">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="{{ URL::asset('index1/img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="{{ URL::asset('index1/img/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="{{ URL::asset('index1/img/apple-touch-icon-144x144-precomposed.png') }}">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital@1&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- BASE CSS -->
    <link href="{{ URL::asset('index1/css/vendors.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('index1/css/style.css') }}" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="{{ URL::asset('index1/css/wizard.css') }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ URL::asset('index1/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />

    <!-- INTERNAL File Uploads css-->
    <link href="{{ URL::asset('assets/plugins/fileupload/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets3/css/style.css') }}" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ URL::asset('assets2/css/fontawesome.css') }}" rel="stylesheet" type="text/css">
    {{-- <link href="{{ URL::asset('assets2/css/themify.css') }}" rel="stylesheet" type="text/css"> --}}
    <link href="{{ URL::asset('assets2/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets2/css/owl.theme.default.min.css') }}" rel="stylesheet">


    <link href="{{ URL::asset('assets2/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets\plugins\select2\select2.min.css') }}" rel="stylesheet">

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



        .edit-title {
            transition: 0.5s
        }

        .edit-text {
            transition: 0.5s;
        }

        .edit-btn {
            transition: 0.5s;
        }

        .edit-image {
            transition: 0.5s;
        }

        .edit-title:hover {
            border: 3px solid #0090ff;

            .edit-button {
                display: block !important;
            }
        }

        .edit-text:hover {
            border: 3px solid #0090ff;

            .edit-button {
                display: block !important;
            }
        }

        .edit-btn:hover {
            border: 3px solid #0090ff;

            .edit-button {
                display: block !important;
            }
        }

        .url-btn {
            bottom: 0px !important;
            z-index: 10;
            height: 15%;
            font-size: 1vw !important;
            top: auto !important;

            border-radius: 5px;
            background-color: rgb(170 0 255) !important;
        }

        .edit-url:hover {
            .edit-button-url {
                display: block !important;
            }
        }



        .edit-button-image {
            position: absolute;
            z-index: 100;
            padding: 7px;
            background: rgb(0, 144, 255);
            border: none;
            font-size: min(1vw, 60%);
            cursor: pointer;
            display: none;
            right: 0px;
            top: 0px;
            color: white;
            border-top-left-radius: 20px;
            border-bottom-left-radius: 20px;
        }

        .edit-image:hover {
            border: 3px solid #0090ff;

            .edit-button-image {
                display: block !important;
            }
        }
    </style>
    @livewireStyles
    @yield('css')

</head>