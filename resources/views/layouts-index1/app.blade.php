<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts-index1.head')
    <body>
        @livewire('header',['store'=>$store])
        @livewire('cart')

        <main>
            @yield('content')
        </main>
        @livewire('footer')

    </body>
    @include('layouts-index1.scripts')


</html>
