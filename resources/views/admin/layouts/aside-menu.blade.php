    @php
    $translations = app('translations_admin');
    @endphp

    <style>
        .side_btn {
            border-radius: 20px;
            margin-right: 10px;
        }
    </style>
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
        </style>
        <div class="app-sidebar__user">
            <div class="dropdown user-pro-body text-center">
                <div class="user-pic">
                    <img src="{{ URL::asset('assets/images/users/user_icon.png') }}" alt="user-img"
                        class="avatar-xl rounded-circle mb-1">
                </div>
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
                <a class="side-menu__item" href="{{ url('/admin/dashboard') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-bar-chart-o"></i></button>

                    <span class="side-menu__label"> {{ $translations['dashboard'] }} </span></a>
            </li>

            <li class="slide">
                <a class="side-menu__item" href="{{ url('/admin/caisse') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-money"></i></button>
                    <span class="side-menu__label"> {{ $translations['caisse'] }} </span></a>
            </li>



            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/products') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-shopping-bag"></i></button>
                    <span class="side-menu__label">{{ $translations['products'] }} </span><i
                        class="angle fa fa-angle-right"></i>
                </a>

            </li>
            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/offers') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-shopping-bag"></i></button>
                    <span class="side-menu__label">{{ $translations['offers'] }}</span><i
                        class="angle fa fa-angle-right"></i>
                </a>

            </li>
            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/categories') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-sitemap"></i></button>
                    <span class="side-menu__label">{{ $translations['categories'] }}</span><i
                        class="angle fa fa-angle-right"></i>
                </a>

            </li>

            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/orders') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-bell-o	"></i></button>

                    <span class="side-menu__label">{{ $translations['orders'] }}</span><i
                        class="angle fa fa-angle-right"></i>
                </a>

            </li>

            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/clients') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-users"></i></button>

                    <span class="side-menu__label">{{ $translations['my_clients'] }}</span><i
                        class="angle fa fa-angle-right"></i>
                </a>

            </li>
            <li class="slide mt-3">
                <a class="side-menu__item" href="/admin/store_info">
                    <button class='btn btn-light side_btn'><i class="fa fa-cogs"></i></button>
                    <span class="side-menu__label">{{ $translations['store_info'] }}</span><i
                        class="angle fa fa-angle-right"></i>
                </a>

            </li>

            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/marketing') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-bullhorn"></i></button>
                    <span class="side-menu__label">{{ $translations['marketing'] }}</span><i
                        class="angle fa fa-angle-right"></i>
                </a>
            </li>

            <li class="slide mt-3">
                <a class="side-menu__item" href="/admin/security_code">
                    <button class='btn btn-light side_btn'><i class="fa fa-user-secret"></i></button>
                    <span class="side-menu__label">{{ $translations['security_codes'] }}</span><i
                        class="angle fa fa-angle-right"></i>
                </a>
            </li>


            <li class="slide has-sub" style="width: 90%;    background-color: #ebeef1;border-radius: 40px;"> <a
                    href="#email" data-toggle="collapse" class="side-menu__item" style="width:100%">
                    <button class='btn btn-light side_btn'><i class="fa fa-paint-brush"></i></button>
                    <span class="side-menu__label">{{ $translations['edite_pages'] }}</span>
                    <i class="fe fe-chevron-down side-menu__angle"></i> </a>

                <div class="collapse" id="email">
                    <ul class="side-menu app-sidebar3">
                        <li class="slide mt-3">
                            <a class="side-menu__item" href="/admin/homeEdit">

                                <i class="angle fa fa-angle-right ml-4 mr-3"></i><span
                                    class="side-menu__label">{{ $translations['home_page'] }}</span>
                            </a>

                        </li>
                        <li class="slide mt-3">
                            <a class="side-menu__item" href="/admin/MenuEdit">

                                <i class="angle fa fa-angle-right ml-4 mr-3"></i> <span
                                    class="side-menu__label">{{ $translations['menu'] }}</span>
                            </a>

                        </li>
                        <li class="slide mt-3">
                            <a class="side-menu__item" href="/admin/HomeHeaderEdit">

                                <i class="angle fa fa-angle-right ml-4 mr-3"></i> <span
                                    class="side-menu__label">{{ $translations['home_slide'] }}</span>
                            </a>

                        </li>
                        <li class="slide mt-3">
                            <a class="side-menu__item" href="/admin/HeadesEdit">

                                <i class="angle fa fa-angle-right ml-4 mr-3"></i> <span
                                    class="side-menu__label">{{ $translations['other_pages'] }}</span>
                            </a>

                        </li>
                    </ul>
                </div>

            </li>

            <li class="slide mt-3">

                <a class="side-menu__item" href="{{ url('/admin/shipping_companies') }}">
                    <button class='btn btn-light side_btn'><i class="fa fa-truck"></i></button>
                    <span class="side-menu__label">{{ $translations['shipping_companies'] }} </span><i
                        class="angle fa fa-angle-right"></i>
                </a>

            </li>








            {{-- <li class="slide mt-3">
                <a class="side-menu__item" href="/admin/apks">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M3 13h2v-2H3v2zm0 4h2v-2H3v2zm0-8h2V7H3v2zm4 4h14v-2H7v2zm0 4h14v-2H7v2zM7 7v2h14V7H7z">
                        </path>
                    </svg>
                    <span class="side-menu__label">Applications</span><i class="angle fa fa-angle-right"></i>
                </a>

            </li> --}}


            {{-- @if (Auth::User()->is_admin == 1)
                <li class="slide mt-3">
                    <a class="side-menu__item" href="{{ url('/admin/ApkToAdmin') }}">
            <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                height="24" viewBox="0 0 24 24" width="24">
                <path d="M0,0h24v24H0V0z" fill="none" />
                <path
                    d="M4,18v-0.65c0-0.34,0.16-0.66,0.41-0.81C6.1,15.53,8.03,15,10,15c0.03,0,0.05,0,0.08,0.01c0.1-0.7,0.3-1.37,0.59-1.98 C10.45,13.01,10.23,13,10,13c-2.42,0-4.68,0.67-6.61,1.82C2.51,15.34,2,16.32,2,17.35V20h9.26c-0.42-0.6-0.75-1.28-0.97-2H4z" />
                <path
                    d="M10,12c2.21,0,4-1.79,4-4s-1.79-4-4-4C7.79,4,6,5.79,6,8S7.79,12,10,12z M10,6c1.1,0,2,0.9,2,2s-0.9,2-2,2 c-1.1,0-2-0.9-2-2S8.9,6,10,6z" />
                <path
                    d="M20.75,16c0-0.22-0.03-0.42-0.06-0.63l1.14-1.01l-1-1.73l-1.45,0.49c-0.32-0.27-0.68-0.48-1.08-0.63L18,11h-2l-0.3,1.49 c-0.4,0.15-0.76,0.36-1.08,0.63l-1.45-0.49l-1,1.73l1.14,1.01c-0.03,0.21-0.06,0.41-0.06,0.63s0.03,0.42,0.06,0.63l-1.14,1.01 l1,1.73l1.45-0.49c0.32,0.27,0.68,0.48,1.08,0.63L16,21h2l0.3-1.49c0.4-0.15,0.76-0.36,1.08-0.63l1.45,0.49l1-1.73l-1.14-1.01 C20.72,16.42,20.75,16.22,20.75,16z M17,18c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S18.1,18,17,18z" />
            </svg>

            <span class="side-menu__label">Application Admins</span><i class="angle fa fa-angle-right"></i>
            </a>

            </li>

            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/AppinoInfo') }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                        height="24" viewBox="0 0 24 24" width="24">
                        <path d="M0,0h24v24H0V0z" fill="none" />
                        <path
                            d="M4,18v-0.65c0-0.34,0.16-0.66,0.41-0.81C6.1,15.53,8.03,15,10,15c0.03,0,0.05,0,0.08,0.01c0.1-0.7,0.3-1.37,0.59-1.98 C10.45,13.01,10.23,13,10,13c-2.42,0-4.68,0.67-6.61,1.82C2.51,15.34,2,16.32,2,17.35V20h9.26c-0.42-0.6-0.75-1.28-0.97-2H4z" />
                        <path
                            d="M10,12c2.21,0,4-1.79,4-4s-1.79-4-4-4C7.79,4,6,5.79,6,8S7.79,12,10,12z M10,6c1.1,0,2,0.9,2,2s-0.9,2-2,2 c-1.1,0-2-0.9-2-2S8.9,6,10,6z" />
                        <path
                            d="M20.75,16c0-0.22-0.03-0.42-0.06-0.63l1.14-1.01l-1-1.73l-1.45,0.49c-0.32-0.27-0.68-0.48-1.08-0.63L18,11h-2l-0.3,1.49 c-0.4,0.15-0.76,0.36-1.08,0.63l-1.45-0.49l-1,1.73l1.14,1.01c-0.03,0.21-0.06,0.41-0.06,0.63s0.03,0.42,0.06,0.63l-1.14,1.01 l1,1.73l1.45-0.49c0.32,0.27,0.68,0.48,1.08,0.63L16,21h2l0.3-1.49c0.4-0.15,0.76-0.36,1.08-0.63l1.45,0.49l1-1.73l-1.14-1.01 C20.72,16.42,20.75,16.22,20.75,16z M17,18c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S18.1,18,17,18z" />
                    </svg>

                    <span class="side-menu__label">Appino Info</span><i class="angle fa fa-angle-right"></i>
                </a>

            </li>
            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/StoreManage') }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M17.63 5.84C17.27 5.33 16.67 5 16 5L5 5.01C3.9 5.01 3 5.9 3 7v10c0 1.1.9 1.99 2 1.99L16 19c.67 0 1.27-.33 1.63-.84L22 12l-4.37-6.16zM16 17H5V7h11l3.55 5L16 17z">
                    </svg>
                    <span class="side-menu__label">Store</span><i class="angle fa fa-angle-right"></i>
                </a>

            </li>
            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/sendApkNotification') }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                        height="24" viewBox="0 0 24 24" width="24">
                        <path d="M0,0h24v24H0V0z" fill="none" />
                        <path
                            d="M4,18v-0.65c0-0.34,0.16-0.66,0.41-0.81C6.1,15.53,8.03,15,10,15c0.03,0,0.05,0,0.08,0.01c0.1-0.7,0.3-1.37,0.59-1.98 C10.45,13.01,10.23,13,10,13c-2.42,0-4.68,0.67-6.61,1.82C2.51,15.34,2,16.32,2,17.35V20h9.26c-0.42-0.6-0.75-1.28-0.97-2H4z" />
                        <path
                            d="M10,12c2.21,0,4-1.79,4-4s-1.79-4-4-4C7.79,4,6,5.79,6,8S7.79,12,10,12z M10,6c1.1,0,2,0.9,2,2s-0.9,2-2,2 c-1.1,0-2-0.9-2-2S8.9,6,10,6z" />
                        <path
                            d="M20.75,16c0-0.22-0.03-0.42-0.06-0.63l1.14-1.01l-1-1.73l-1.45,0.49c-0.32-0.27-0.68-0.48-1.08-0.63L18,11h-2l-0.3,1.49 c-0.4,0.15-0.76,0.36-1.08,0.63l-1.45-0.49l-1,1.73l1.14,1.01c-0.03,0.21-0.06,0.41-0.06,0.63s0.03,0.42,0.06,0.63l-1.14,1.01 l1,1.73l1.45-0.49c0.32,0.27,0.68,0.48,1.08,0.63L16,21h2l0.3-1.49c0.4-0.15,0.76-0.36,1.08-0.63l1.45,0.49l1-1.73l-1.14-1.01 C20.72,16.42,20.75,16.22,20.75,16z M17,18c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S18.1,18,17,18z" />
                    </svg>

                    <span class="side-menu__label">Notification Manage</span><i class="angle fa fa-angle-right"></i>
                </a>

            </li>
            @endif --}}
        </ul>
    </aside>
    <!--aside closed-->