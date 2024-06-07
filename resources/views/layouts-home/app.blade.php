<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts-home.head')
    <body>
        @include('layouts-home.header')
        @yield('content')
        @include('layouts-home.footer')

    </body>
    @include('layouts-home.scripts')
</html>
