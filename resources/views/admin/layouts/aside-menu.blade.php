    @php
        $translations = app('translations_admin');
    @endphp
    <aside class="app-sidebar  ">
        <div class="app-sidebar__logo">
            <a class="header-brand" href="{{ url('/' . ($page = '')) }}">
                <img src="{{ get_image(Auth::user()->store->logo) }}" style='height:4rem'
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
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z" />
                    </svg>
                    <span class="side-menu__label"> {{ $translations['dashboard'] }}  </span></a>
            </li>

            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/products') }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 16 16 "
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />

                    </svg>
                    <span class="side-menu__label">{{ $translations['products'] }} </span><i class="angle fa fa-angle-right"></i>
                </a>

            </li>
            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/offers') }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 16 16 "
                        width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />

                    </svg>
                    <span class="side-menu__label">{{ $translations['offers'] }}</span><i class="angle fa fa-angle-right"></i>
                </a>

            </li>
            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/orders') }}">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M6 2L3 6v14c0 1.1.9 2 2 2h14a2 2 0 0 0 2-2V6l-3-4H6zM3.8 6h16.4M16 10a4 4 0 1 1-8 0" />
                    </svg>


                    <span class="side-menu__label">{{ $translations['orders'] }}</span><i class="angle fa fa-angle-right"></i>
                </a>

            </li>

            <li class="slide mt-3">
                <a class="side-menu__item" href="{{ url('/admin/clients') }}">
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

            </li>
            <li class="slide mt-3">
                <a class="side-menu__item" href="/admin/store_info">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 20 20"
                        width="24">
                        <path
                            d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                    </svg>
                    <span class="side-menu__label">{{ $translations['store_info'] }}</span><i class="angle fa fa-angle-right"></i>
                </a>

            </li>
            <li class="slide has-sub" style="width: 90%;    background-color: #ebeef1;border-radius: 40px;"> <a href="#email"  data-toggle="collapse" class="side-menu__item" style="width:100%"> <svg class="side-menu__icon"
                     xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                     <path d="M0 0h24v24H0z" fill="none"></path>
                     <path
                         d="M12 22C6.49 22 2 17.51 2 12S6.49 2 12 2s10 4.04 10 9c0 3.31-2.69 6-6 6h-1.77c-.28 0-.5.22-.5.5 0 .12.05.23.13.33.41.47.64 1.06.64 1.67 0 1.38-1.12 2.5-2.5 2.5zm0-18c-4.41 0-8 3.59-8 8s3.59 8 8 8c.28 0 .5-.22.5-.5 0-.16-.08-.28-.14-.35-.41-.46-.63-1.05-.63-1.65 0-1.38 1.12-2.5 2.5-2.5H16c2.21 0 4-1.79 4-4 0-3.86-3.59-7-8-7z">
                     </path>
                     <circle cx="6.5" cy="11.5" r="1.5"></circle>
                     <circle cx="9.5" cy="7.5" r="1.5"></circle>
                     <circle cx="14.5" cy="7.5" r="1.5"></circle>
                     <circle cx="17.5" cy="11.5" r="1.5"></circle>
                 </svg>
                 <span class="side-menu__label">{{ $translations['edite_pages'] }}</span>
                 <i class="fe fe-chevron-down side-menu__angle"></i> </a>

                 <div class="collapse" id="email">
                    <ul class="side-menu app-sidebar3">
                        <li class="slide mt-3">
                            <a class="side-menu__item" href="/admin/homeEdit">
                          
                                <i class="angle fa fa-angle-right ml-4 mr-3"></i><span class="side-menu__label">{{ $translations['home_page'] }}</span>
                            </a>
            
                        </li>
                        <li class="slide mt-3">
                            <a class="side-menu__item" href="/admin/MenuEdit">
                              
                                <i class="angle fa fa-angle-right ml-4 mr-3"></i> <span class="side-menu__label">{{ $translations['menu'] }}</span>
                            </a>
            
                        </li>
                        <li class="slide mt-3">
                            <a class="side-menu__item" href="/admin/HeadesEdit">
                              
                                <i class="angle fa fa-angle-right ml-4 mr-3"></i> <span class="side-menu__label">{{ $translations['other_pages'] }}</span>
                            </a>
            
                        </li>
                    </ul>
                </div>
  
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
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg"
                            enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24">
                            <path d="M0,0h24v24H0V0z" fill="none" />
                            <path
                                d="M4,18v-0.65c0-0.34,0.16-0.66,0.41-0.81C6.1,15.53,8.03,15,10,15c0.03,0,0.05,0,0.08,0.01c0.1-0.7,0.3-1.37,0.59-1.98 C10.45,13.01,10.23,13,10,13c-2.42,0-4.68,0.67-6.61,1.82C2.51,15.34,2,16.32,2,17.35V20h9.26c-0.42-0.6-0.75-1.28-0.97-2H4z" />
                            <path
                                d="M10,12c2.21,0,4-1.79,4-4s-1.79-4-4-4C7.79,4,6,5.79,6,8S7.79,12,10,12z M10,6c1.1,0,2,0.9,2,2s-0.9,2-2,2 c-1.1,0-2-0.9-2-2S8.9,6,10,6z" />
                            <path
                                d="M20.75,16c0-0.22-0.03-0.42-0.06-0.63l1.14-1.01l-1-1.73l-1.45,0.49c-0.32-0.27-0.68-0.48-1.08-0.63L18,11h-2l-0.3,1.49 c-0.4,0.15-0.76,0.36-1.08,0.63l-1.45-0.49l-1,1.73l1.14,1.01c-0.03,0.21-0.06,0.41-0.06,0.63s0.03,0.42,0.06,0.63l-1.14,1.01 l1,1.73l1.45-0.49c0.32,0.27,0.68,0.48,1.08,0.63L16,21h2l0.3-1.49c0.4-0.15,0.76-0.36,1.08-0.63l1.45,0.49l1-1.73l-1.14-1.01 C20.72,16.42,20.75,16.22,20.75,16z M17,18c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S18.1,18,17,18z" />
                        </svg>

                        <span class="side-menu__label">Application Admins</span><i
                            class="angle fa fa-angle-right"></i>
                    </a>

                </li>

                <li class="slide mt-3">
                    <a class="side-menu__item" href="{{ url('/admin/AppinoInfo') }}">
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg"
                            enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24">
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
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24"
                            viewBox="0 0 24 24" width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path
                                d="M17.63 5.84C17.27 5.33 16.67 5 16 5L5 5.01C3.9 5.01 3 5.9 3 7v10c0 1.1.9 1.99 2 1.99L16 19c.67 0 1.27-.33 1.63-.84L22 12l-4.37-6.16zM16 17H5V7h11l3.55 5L16 17z">
                        </svg>
                        <span class="side-menu__label">Store</span><i class="angle fa fa-angle-right"></i>
                    </a>

                </li>
                <li class="slide mt-3">
                    <a class="side-menu__item" href="{{ url('/admin/sendApkNotification') }}">
                        <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg"
                            enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24">
                            <path d="M0,0h24v24H0V0z" fill="none" />
                            <path
                                d="M4,18v-0.65c0-0.34,0.16-0.66,0.41-0.81C6.1,15.53,8.03,15,10,15c0.03,0,0.05,0,0.08,0.01c0.1-0.7,0.3-1.37,0.59-1.98 C10.45,13.01,10.23,13,10,13c-2.42,0-4.68,0.67-6.61,1.82C2.51,15.34,2,16.32,2,17.35V20h9.26c-0.42-0.6-0.75-1.28-0.97-2H4z" />
                            <path
                                d="M10,12c2.21,0,4-1.79,4-4s-1.79-4-4-4C7.79,4,6,5.79,6,8S7.79,12,10,12z M10,6c1.1,0,2,0.9,2,2s-0.9,2-2,2 c-1.1,0-2-0.9-2-2S8.9,6,10,6z" />
                            <path
                                d="M20.75,16c0-0.22-0.03-0.42-0.06-0.63l1.14-1.01l-1-1.73l-1.45,0.49c-0.32-0.27-0.68-0.48-1.08-0.63L18,11h-2l-0.3,1.49 c-0.4,0.15-0.76,0.36-1.08,0.63l-1.45-0.49l-1,1.73l1.14,1.01c-0.03,0.21-0.06,0.41-0.06,0.63s0.03,0.42,0.06,0.63l-1.14,1.01 l1,1.73l1.45-0.49c0.32,0.27,0.68,0.48,1.08,0.63L16,21h2l0.3-1.49c0.4-0.15,0.76-0.36,1.08-0.63l1.45,0.49l1-1.73l-1.14-1.01 C20.72,16.42,20.75,16.22,20.75,16z M17,18c-1.1,0-2-0.9-2-2s0.9-2,2-2s2,0.9,2,2S18.1,18,17,18z" />
                        </svg>

                        <span class="side-menu__label">Notification Manage</span><i
                            class="angle fa fa-angle-right"></i>
                    </a>

                </li>
            @endif --}}
        </ul>
    </aside>
    <!--aside closed-->
