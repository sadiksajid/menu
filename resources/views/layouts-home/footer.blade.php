<!-- ///////////////////////////////////////////////// login -->
<div id="popup-login-block" class='popup-block'>
    <div class="popup-newsletter-main" style='height:520px'>
        <div class="bg-img"> <img class="w-100 h-100" src="assets_home/images/components/bg-popup-newsletter.png"
                alt="" /></div>
        <div class="content p-40 bg-on-surface">
            <div class="close-block text-end"><i class="ph-bold ph-x d-block fs-18 text-white pointer"></i></div>
            <div class="heading6 text-white">Login</div>
            <div class="text-placehover mt-8">Login To your Dashboard.</div>
            <form id='Login' class="mt-32" method="POST" action="{{ route('login') }}">
                @csrf
                <label style='margin-left:10px'>Phone:</label>
                <div class="">

                    <input class="bg-line-dark text-white form-input-new" type="tel" name="login_phone" required
                        id='login_phone' />    
                    <input class="d-none" type="text" name="country_code" required id='login_country_code' value="{{ old('country_code') }}" />

                </div>
                @error('login_phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label style='margin-left:10px;margin-top:15px'>Password:</label>
                <div class="form-input">
                    <input class="bg-line-dark text-white" type="password" name="login_password"
                        value="{{ old('login_password') }}" required autocomplete="current-password" placeholder="Password" />
                </div>
                @error('login_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                @if(session()->has('error'))
                <div class="col-md-12" style='margin-top: 15px;color: #ff9900;background-color: rgb(255, 255, 255, 0.2);border-radius: 10px;padding: 13px'>
                    <div class="form-check-label" >
                        {{ session()->get('error')}}
                    </div>
                </div>
                @endif
                
                <a style='margin-top:15px;cursor: pointer;' id='submit_login' class="button button-blue-hover text-white text-button mt-3" > <span>
                        <span></span></span><span class="bg-blue">Login</span></a>

                <!-- <div class="flex-item-center gap-8 mt-12">
            <input class="prevent-popup-input" type="checkbox" name="prevent"/>
            <div class="caption1 text-placehover">Prevent this Pop-up</div>
          </div> -->
            </form>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////// register -->
<div id="popup-register-block" class='popup-block'>
    <div class="popup-newsletter-main">
        <div class="bg-img"> <img class="w-100 h-100" src="assets_home/images/components/bg-popup-newsletter.png"
                alt="" /></div>
        <div class="content p-40 bg-on-surface">
            <div class="close-block text-end"><i class="ph-bold ph-x d-block fs-18 text-white pointer"></i></div>
            <div class="heading6 text-white">Register</div>
            <div class="text-placehover mt-8">Create New Account.</div>
            <form id='Register' class="mt-32" method="POST" action="{{ route('register.post') }}">
                @csrf
                <!-- /////////////////////////////////////////////////////////////////////////// -->

                <label style='margin-left:10px'>Full Name:</label>
                <div class="form-input">
                    <input class="bg-line-dark text-white @error('fullname') is-invalid @enderror" type="text"
                        placeholder="Full Name" name="fullname" required autocomplete="fullname" autofocus />
                </div>
                @error('fullname')
                <div class="col-md-12 error" style='#ff9900'>
                    <div class="form-check-label">
                        {{ $message}}
                    </div>
                </div>
                @enderror
                <!-- /////////////////////////////////////////////////////////////////////////// -->

                <label style='margin-left:10px;margin-top:10px'>Business Name:</label>
                <div class="form-input">
                    <input class="bg-line-dark text-white @error('store_name') is-invalid @enderror" type="text"
                        placeholder="Business Name" name="store_name" required autocomplete="businessname" autofocus />

                </div>
                @error('store_name')
                <div class="col-md-12 error" style='#ff9900'>
                    <div class="form-check-label">
                        {{ $message}}
                    </div>
                </div>
                @enderror
                @error('store_meta')
                <div class="col-md-12 error" style='#ff9900'>
                    <div class="form-check-label">
                        {{ $message}}
                    </div>
                </div>
                @enderror
                <!-- /////////////////////////////////////////////////////////////////////////// -->

                <input class="d-none" type="text" name="country_code" required id='country_code'
                    value="{{ old('country_code') }}" />

                <!-- /////////////////////////////////////////////////////////////////////////// -->


                <label style='margin-left:10px;margin-top:10px'>Phone:</label>
                <div class="">
                    <input class="bg-line-dark text-white form-input-new" type="tel" name="telephone" required
                        id='phone' />
                    <input class="d-none" type="string" name="phone_code" required
                        id='phone_code' />
                </div>
                @error('telephone')
                <div class="col-md-12 error" style='#ff9900'>
                    <div class="form-check-label">
                        {{ $message}}
                    </div>
                </div>
                @enderror
                <!-- /////////////////////////////////////////////////////////////////////////// -->

                <label style='margin-left:10px;margin-top:10px'>Password:</label>
                <div class="form-input">
                    <input class="bg-line-dark text-white" type="password" name="password" required
                        placeholder="Password" />
                </div>
                @error('password')
                <div class="col-md-12 error" style='#ff9900'>
                    <div class="form-check-label">
                        {{ $message}}
                    </div>
                </div>
                @enderror
                <!-- /////////////////////////////////////////////////////////////////////////// -->

                <label style='margin-left:10px;margin-top:10px'>Confirm Password:</label>
                <div class="form-input">
                    <input class="bg-line-dark text-white" type="password" name="password_confirmation" required
                        placeholder="Confirm Password" />

                </div>
                @error('password_confirmation')
                <div class="col-md-12 error" style='#ff9900'>
                    <div class="form-check-label">
                        {{ $message}}
                    </div>
                </div>
                @enderror
                <!-- /////////////////////////////////////////////////////////////////////////// -->

                <a style='margin-top:15px;cursor: pointer'  id='submit_register'
                    class="button button-blue-hover text-white text-button" > <span>
                        <span></span></span><span class="bg-blue">Register</span></a>

                <!-- <div class="flex-item-center gap-8 mt-12">
            <input class="prevent-popup-input" type="checkbox" name="prevent"/>
            <div class="caption1 text-placehover">Prevent this Pop-up</div>
          </div> -->
            </form>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////// end register -->
<a class="scroll-to-top-btn" href="#header"><i class="ph-bold ph-caret-up"></i></a>
</div>

<div id="footer">
    <div class="footer-block bg-black-surface pt-60">
        <div class="container">
            <div class="heading flex-between">
                <div class="footer-company-infor d-flex flex-column gap-20"><a class="logo" href="">
                        <svg width="46" height="34" viewbox="0 0 46 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_8601_1496)">
                                <path
                                    d="M0.745605 29.981C1.67613 27.7771 2.54072 25.7314 3.40532 23.6877C6.04243 17.449 8.69272 11.2161 11.3016 4.96611C11.5992 4.25409 11.9495 3.97154 12.7369 4.00168C14.3983 4.06761 16.0653 4.05819 17.7267 4.00356C18.4123 3.98096 18.7118 4.23902 18.9605 4.84367C20.7744 9.25141 22.6148 13.6497 24.4589 18.0462C25.1615 19.7226 25.9243 21.3764 26.5968 23.0642C26.8436 23.6858 27.1638 23.9005 27.8381 23.8968C33.2367 23.8685 38.6371 23.8798 44.0356 23.8779C44.4067 23.8779 44.7759 23.8779 45.1997 23.8779C45.1997 25.9255 45.1997 27.8863 45.1997 29.9339C44.872 29.9508 44.5687 29.981 44.2654 29.981C37.1076 29.9847 29.9516 29.9753 22.7937 29.9979C22.1382 29.9998 21.7709 29.8378 21.5467 29.1842C21.1794 28.118 20.6972 27.0914 20.2998 26.0347C20.1227 25.5619 19.8778 25.3566 19.3391 25.3623C16.4835 25.3905 13.626 25.3585 10.7704 25.4037C10.469 25.4093 10.0301 25.7164 9.89825 25.9989C9.38213 27.1065 8.98845 28.2687 8.49305 29.3857C8.38192 29.6362 8.04286 29.9508 7.80175 29.9546C5.515 29.9979 3.22449 29.981 0.745605 29.981ZM17.9358 19.7867C16.9827 17.3605 16.071 15.038 15.0595 12.463C14.0649 15.0512 13.172 17.3718 12.2453 19.7867C14.176 19.7867 15.9824 19.7867 17.9358 19.7867Z"
                                    fill="#3D89FB"></path>
                                <path
                                    d="M45.2506 4.09424C45.2506 5.7688 45.2656 7.36614 45.2355 8.96347C45.2299 9.21023 45.0622 9.49466 44.8889 9.69056C41.7357 13.2601 37.8422 17.4418 34.6513 20.9774C33.3045 20.9755 31.2287 20.9585 29.8423 20.9096C29.8423 20.9096 28.4032 18.4213 28.1847 18.0219C28.2864 17.924 28.3354 17.9278 30.1682 16.0234C31.92 14.2038 33.5268 12.2429 35.3614 10.1596C34.7003 10.1596 34.2482 10.1596 33.7961 10.1596C31.0968 10.1596 28.3976 10.1709 25.6983 10.1389C25.3894 10.1351 24.9091 9.9505 24.8017 9.71505C23.9748 7.89167 23.2213 6.03816 22.4038 4.09424C30.0439 4.09424 37.5785 4.09424 45.2506 4.09424Z"
                                    fill="white"></path>
                            </g>
                            <defs>
                                <clippath id="clip0_8601_1496">
                                    <rect width="44.5087" height="26" fill="white" transform="translate(0.745605 4)">
                                    </rect>
                                </clippath>
                            </defs>
                        </svg></a></div>
                <div class="footer-navigate">
                    <ul class="flex-item-center gap-40">
                        <li class="flex-center"><a class="text-subtitle text-white" href="/">Home</a></li>
                        <li class="flex-center"><a class="text-subtitle text-white" href="service-one.html">Services</a>
                        </li>
                        <li class="flex-center"><a class="text-subtitle text-white" href="about.html">About</a></li>
                        <li class="flex-center"><a class="text-subtitle text-white" href="blog.html">Blog</a></li>
                        <li class="flex-center"><a class="text-subtitle text-white" href="/contact-us">Contact</a></li>
                    </ul>
                </div>
                <div class="list-social flex-item-center gap-12"><a
                        class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center"
                        href="https://www.facebook.com/" target="_blank"><i
                            class="icon-facebook display-block"></i></a><a
                        class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center"
                        href="https://www.linkedin.com/" target="_blank"><i
                            class="icon-linkedin fs-14 display-block"></i></a><a
                        class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center"
                        href="https://www.twitter.com/" target="_blank"><i
                            class="icon-twitter fs-12 display-block"></i></a><a
                        class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center"
                        href="https://www.instagram.com/" target="_blank"><i
                            class="icon-instagram fs-14 display-block"></i></a><a
                        class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center"
                        href="https://www.youtube.com/" target="_blank"><i
                            class="icon-youtube fs-12 display-block"></i></a></div>
            </div>
            <div class="company-contact flex-center gap-16 mt-32 flex-wrap">
                <div class="phone flex-item-center gap-8"><i class="ph ph-phone text-placehover fs-24"></i><span
                        class="text-button-uppercase text-placehover">012 345 6789</span></div><span
                    class="text-placehover">|</span>
                <div class="mail flex-item-center gap-8"><i class="ph-light ph-envelope text-placehover fs-24"></i><span
                        class="text-button-uppercase text-placehover">aizan@gmail.com</span></div><span
                    class="text-placehover">|</span>
                <div class="location flex-item-center gap-8"><i
                        class="ph-light ph-map-pin text-placehover fs-24"></i><span
                        class="text-button-uppercase text-placehover">710 1st St. Easton, PA 18042 | Chester
                        County</span></div>
            </div>
        </div>
        <div class="bg-black-surface mt-32">
            <div class="container bg-black-surface">
                <div class="line-dark"></div>
                <div class="footer-bottom flex-between pt-12 pb-12 flex-wrap">
                    <div class="left-block flex-item-center">
                        <div class="copy-right text-placehover caption1">©2023 AIZAN. All Rights Reserved.</div>
                    </div>
                    <div class="nav-link flex-item-center gap-8"><a class="text-placehover caption1 hover-underline"
                            href="#!">Terms Of Services</a><span class="text-placehover caption1">|</span><a
                            class="text-placehover caption1 hover-underline" href="#!">Privacy Policy</a><span
                            class="text-placehover caption1">|</span><a class="text-placehover caption1 hover-underline"
                            href="#!">Cookie Policy</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
