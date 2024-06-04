<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts-index1.head')
    <body>
        @livewire('header')
        @livewire('cart')

        <main>
            @yield('content')
        </main>
        {{-- @include('layouts-index1.footer') --}}
        @livewire('footer')

    </body>
    @include('layouts-index1.scripts')
</html>
