<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{cache('appino')['name']}}</title>
    <link rel="icon" type="image/x-icon" href="{{ url('storage/appino_images') }}/{{cache('appino')['small_logo']}}">
    @include('layouts.home_head')
</head>

<body>
    <div id="home">
        {{$slot}}
    </div>
    <!-- ======= Footer ======= -->
    @include('layouts.home_footer')
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"
            style="border: 6px solid black;"></i></a>

    <!-- Vendor JS Files -->
    @include('layouts.home_scripts')


</body>

</html>