<!DOCTYPE html>
<html lang="en" dir="ltr">
  

<head>
    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="APPIINO - Admin Panel" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="APPIINO" name="author">
    <meta name="keywords" content="admin panel APPIINO" />
    @include('admin.layouts_caisse.head')
</head>

<body class="app sidebar-mini sidenav-toggled">
    <!---Global-loader-->
    <div id="global-loader">
        <img src="{{ URL::asset('assets/images/svgs/loader.svg') }}" alt="loader">
    </div>
    <!--- End Global-loader-->
    <!-- Page -->
    <div class="page">
        <div class="page-main">
            @include('admin.layouts_caisse.aside-menu')
            <!-- App-Content -->
            <div class="app-content main-content">
                <div class="side-app p-3">
                    @include('admin.layouts_caisse.header')
                    @yield('page-header')
                    @yield('content')
                </div><!-- End Page -->
                @include('admin.layouts_caisse.footer-scripts')
            </div>
        </div>
    </div>
</body>

</html>
