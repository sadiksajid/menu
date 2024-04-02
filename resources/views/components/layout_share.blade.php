<!DOCTYPE html>
<html lang="en">

<head>
    <title>APPINO</title>
    @include('layouts.head')
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>


    <div class="site-wrap" id="app">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="site-logo"><a href="/" class="text-uppercase">APPINO</a></div>
                    <div>
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-xl-block">
                                <li><a href="/" class="nav-link">Home</a></li>
                                {{-- <li><a href="#work-section" class="nav-link">Our Applications</a></li> --}}
                                <li><a href="#more-Wallpappers" class="nav-link">Wallpappers</a></li>
          

                            </ul>
                        </nav>
                    </div>
                  
                </div>
            </div>

        </header>

        {{ $slot }}
        @include('layouts.footer')
    </div>
    @include('layouts.scripts')
</body>

</html>
