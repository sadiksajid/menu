    @php
        $translations = app('translations_admin');
    @endphp
    <aside class="app-sidebar  ">
        <div class="app-sidebar__logo">
            <a class="header-brand" href="{{ url('/' . ($page = '')) }}">
                <img src="{{ get_image(Auth::user()->store->logo ?? '') }}" style='height:4rem'
                    class="header-brand-img desktop-lgo rounded-circle" alt="Appino logo">

            </a>
        </div>
        <style>
            @media (min-width: 767px) {
                .sidebar-mini.sidenav-toggled .app-sidebar {
                    max-height: 100%;
                }
            }

            .side_btn {
                border-radius: 20px;
                margin-right: 10px;
            }
    
        </style>
        <div class="app-sidebar__user">
            <div class="dropdown user-pro-body text-center">
         
                <div class="user-info">
                    <h5 class=" mb-1">{{ Auth::user()->name ?? '' }} <i
                            class="ion-checkmark-circled  text-success fs-12"></i>
                    </h5>
                    <span class="text-muted app-sidebar__user-name text-sm"></span>
                </div>
            </div>
        </div>
        <ul class="side-menu app-sidebar3">
  

            <li class="slide">
                <a class="side-menu__item" href="{{ url('/staf/dashboard') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-bar-chart-o"></i></button>

                    <span class="side-menu__label"> {{ $translations['dashboard'] }} </span></a>
            </li>

            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/staf/products') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-shopping-bag"></i></button>
                    <span class="side-menu__label">{{ $translations['products'] }} </span><i
                        class="angle fa fa-angle-right"></i>
                </a>

            </li>




            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/staf/header_images') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-image"></i></button>
                    <span class="side-menu__label">{{ $translations['header_images'] }} </span><i
                        class="angle fa fa-angle-right"></i>
                </a>

            </li>

            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/staf/qr_code') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-qrcode"></i></button>
                    <span class="side-menu__label">{{ $translations['qr_code'] }} </span><i
                        class="angle fa fa-angle-right"></i>
                </a>

            </li>


            <a class="side-menu__item" href="{{ url('/staf/shipping_companies') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-truck"></i></button>
                    <span class="side-menu__label">{{ $translations['shipping_companies'] }} </span><i
                        class="angle fa fa-angle-right"></i>
                </a>

            </li>

<!-- 
            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/staf/clients') }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>


                    <span class="side-menu__label">{{ $translations['my_clients'] }}</span><i class="angle fa fa-angle-right"></i>
                </a>

            </li> -->
<!-- 
            <li class="slide mt-3">
                <a class="side-menu__item" href="/staf/store_info">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 20 20"
                        width="24">
                        <path
                            d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                    </svg>
                    <span class="side-menu__label">{{ $translations['store_info'] }}</span><i class="angle fa fa-angle-right"></i>
                </a>

            </li>
           -->
 
     

        
        </ul>
    </aside>
    <!--aside closed-->
