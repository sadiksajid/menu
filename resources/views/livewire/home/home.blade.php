<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Home 1 - AI Chat Bot</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&amp;display=swap"/>
    <link rel="shortcut icon" href="assets_home/images/fav.png"/>
    <link rel="stylesheet" href="assets_home/css/animate.min.css"/>
    <link rel="stylesheet" href="assets_home/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets_home/css/slick.css"/>
    <link rel="stylesheet" href="assets_home/icons/style.css"/>
    <link rel="stylesheet" href="assets_home/css/style.css"/>
    <link rel="stylesheet" href="assets_home/css/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/css/intlTelInput.css">



    <style>
        .iti__tel-input{
          padding-top:5px!important;
        }
        .form-input-new{
            padding:6px;
            padding-top:10px;
            height: 50px;
            width: 100%;
            border-radius: 100px;

        }
        .iti__selected-dial-code{
          color:gray;

        }



        .iti__dropdown-content{
          margin-left: -32px;
          width: 410px !important;
          height: 500px;
        }
        .iti--inline-dropdown{
          width: 100%!important;
          color:black;
          z-index:9999;
        }


          
        .select2-container--default .select2-selection--single{
            padding:6px;
            padding-top:10px;
            height: 50px;
            position: relative;
            background-color: #2A2A2D;
            color:white;
            border: none;

        }
        .select2-selection__rendered{
          color:white!important;

        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            background-image: -khtml-gradient(linear, left top, left bottom, from(#424242), to(#030303));
            background-image: -moz-linear-gradient(top, #424242, #030303);
            background-image: -ms-linear-gradient(top, #424242, #030303);
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #424242), color-stop(100%, #030303));
            background-image: -webkit-linear-gradient(top, #424242, #030303);
            background-image: -o-linear-gradient(top, #424242, #030303);
            background-image: linear-gradient(#424242, #030303);
            width: 40px;
            color: #fff;
            font-size: 1.3em;
            padding: 4px 12px;
            height: 27px;
            position: absolute;
            top: 0px;
            right: 0px;
            width: 20px;
        }

                /* Hide scrollbar for Chrome, Safari and Opera */
        .select2-results__options::-webkit-scrollbar {
          display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .select2-results__options {
          -ms-overflow-style: none;  /* IE and Edge */
          scrollbar-width: none;  /* Firefox */
        }


        .select2-dropdown{
          background-color: #2A2A2D;
          border-bottom-left-radius: 20px;
          border-bottom-right-radius: 20px;
          width: 354px !important;


        }
        .select2-results__option--selected{
          background-color: #464646 !important;
        }
        .error{
          color: red;
          margin-left: 10px;
        }
    </style>
  </head>
  <body> 
    <div id="header">
      <div class="header-menu style-one bg-black-surface">
        <div class="container"> 
          <div class="header-main flex-between">
            <div class="menu-main"> 
              <ul class="flex-item-center">
                <li class="flex-center"><a class="text-subtitle active" href="#!">Home<i class="ph ph-caret-down fs-12 pl-4"></i></a>
                  <div class="sub-nav">
                    <div class="sub-nav-main bg-black-surface p-24">
                      <div class="row">
                        <div class="col-9">
                          <div class="list-home p-32 flex-between gap-30">
                            <div class="item"> <i class="icon-chat-bot text-white fs-32"> </i><a class="display-block mt-20" href="index.html">
                                <div class="text-button text-white">Home chat bot</div>
                                <div class="caption1 text-placehover mt-8">Seamlessly integrate AI chat services into your existing systems</div></a></div>
                            <div class="item"> <i class="icon-image text-white fs-32"> </i><a class="display-block mt-20" href="home2.html">
                                <div class="text-button text-white">Home Image generator</div>
                                <div class="caption1 text-placehover mt-8">Seamlessly integrate AI chat services into your existing systems</div></a></div>
                            <div class="item"> <i class="icon-laptop text-white fs-32"> </i><a class="display-block mt-20" href="home3.html">
                                <div class="text-button text-white">Home Digital Agency</div>
                                <div class="caption1 text-placehover mt-8">Seamlessly integrate AI chat services into your existing systems</div></a></div>
                            <div class="item"> <i class="icon-clip text-white fs-32"> </i><a class="display-block mt-20" href="home4.html">
                                <div class="text-button text-white">Home Business Agency</div>
                                <div class="caption1 text-placehover mt-8">Seamlessly integrate AI chat services into your existing systems</div></a></div>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="explore-block bg-line-dark p-24 bora-12">
                            <div class="heading7 text-white">Explore AI help Business</div>
                            <div class="text-placehover mt-12">Praesent interdum lacus ac est viverra hendrerit. Aliquam dapibus, ante vitae matti gravida.</div><a class="button bg-blue button-blue-hover text-white mt-12" href="about.html"> <span> <span> </span></span><span class="bg-blue">Explore now</span></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="flex-center"><a class="text-subtitle" href="#!">Services</a>
                  <div class="sub-nav">
                    <div class="sub-nav-main bg-black-surface p-24">
                      <div class="row">
                        <div class="col-8">
                          <div class="list-home flex-between gap-30">
                            <div class="item"> <a class="flex-column-center" href="service-one.html">
                                <div class="bg-img bora-12 overflow-hidden"><img class="w-100" src="assets_home/images/submenu/182x182.png" alt=""/></div>
                                <div class="text-button text-white text-center mt-8">AI chat bot</div></a></div>
                            <div class="item"> <a class="flex-column-center" href="service-two.html">
                                <div class="bg-img bora-12 overflow-hidden"><img class="w-100" src="assets_home/images/submenu/182x182.png" alt=""/></div>
                                <div class="text-button text-white text-center mt-8">AI Image generator</div></a></div>
                            <div class="item"> <a class="flex-column-center" href="service-three.html">
                                <div class="bg-img bora-12 overflow-hidden"><img class="w-100" src="assets_home/images/submenu/182x182.png" alt=""/></div>
                                <div class="text-button text-white text-center mt-8">Digital Agency</div></a></div>
                            <div class="item"> <a class="flex-column-center" href="service-four.html">
                                <div class="bg-img bora-12 overflow-hidden"><img class="w-100" src="assets_home/images/submenu/182x182.png" alt=""/></div>
                                <div class="text-button text-white text-center mt-8">Business Agency</div></a></div>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="explore-block bg-line-dark p-24 bora-12">
                            <div class="heading7 text-white">AI Create Image</div>
                            <div class="text-placehover mt-12">Praesent interdum lacus ac est viverra hendrerit. Aliquam dapibus, ante vitae matti gravida.</div><a class="button bg-blue button-blue-hover text-white mt-12" href="about.html"> <span> <span> </span></span><span class="bg-blue">Explore now</span></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="flex-center"><a class="text-subtitle" href="#!">Pages<i class="ph ph-caret-down fs-12 pl-4"></i></a>
                  <div class="sub-nav">
                    <div class="sub-nav-main bg-black-surface p-24">
                      <div class="row">
                        <div class="col-9">
                          <div class="list-pages p-24 flex-between bg-line-dark bora-16"><a class="item flex-item-center gap-8" href="about.html"><i class="icon-infor icon-blue fs-28"> </i>
                              <div class="text-button text-white">About Us</div></a><a class="item flex-item-center gap-8" href="pricing.html"><i class="icon-pricing icon-blue fs-28"> </i>
                              <div class="text-button text-white">Pricing</div></a><a class="item flex-item-center gap-8" href="faqs.html"><i class="icon-faq icon-blue fs-28"> </i>
                              <div class="text-button text-white">FAQs</div></a><a class="item flex-item-center gap-8" href="page-not-found.html"><i class="icon-not-found icon-blue fs-28"> </i>
                              <div class="text-button text-white">404 Page</div></a></div>
                          <div class="banner-infor bora-16 overflow-hidden mt-20">
                            <div class="bg-img w-100 h-100"><img class="w-100 h-100 object-fit-cover" src="assets_home/images/components/bg-submenu.png" alt=""/></div>
                            <div class="text-content pt-24 pb-24 pl-32 pr-32"> 
                              <div class="heading7">AI Create Image</div>
                              <div class="mt-12">Praesent interdum lacus ac est viverra hendrerit. Aliquam dapibus, ante vitae matti gravida.</div><a class="button bg-blue button-blue-hover text-white mt-12" href="about.html"> <span> <span> </span></span><span class="bg-blue">Explore now</span></a>
                            </div>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="main-content bg-line-dark bora-12 h-100">
                            <div class="explore-block p-24 h-100">
                              <div class="list-social flex-item-center gap-12"><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.facebook.com/" target="_blank"><i class="icon-facebook display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.linkedin.com/" target="_blank"><i class="icon-linkedin fs-14 display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.twitter.com/" target="_blank"><i class="icon-twitter fs-12 display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.instagram.com/" target="_blank"><i class="icon-instagram fs-14 display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.youtube.com/" target="_blank"><i class="icon-youtube fs-12 display-block"></i></a></div>
                              <div class="text-placehover mt-16">Praesent interdum lacus ac est viverra hendrerit. Aliquam dapibus, ante vitae matti.</div>
                              <div class="mail flex-item-center gap-8 mt-16"><i class="ph-light ph-envelope text-white fs-20"></i><span class="caption1 text-white">hi.avitex@gmail.com</span></div>
                              <div class="phone flex-item-center gap-8 mt-16"><i class="ph-fill ph-phone text-white"></i><span class="fw-700 text-placehover">123 456 7890</span></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="flex-center"><a class="text-subtitle" href="blog.html">Blog</a></li>
                <li class="flex-center"><a class="text-subtitle" href="contact.html">Contact</a></li>
              </ul>
            </div><a class="logo" href=""> 
              <svg width="46" height="34" viewbox="0 0 46 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_8601_1497)">
                  <path d="M0.745605 29.981C1.67613 27.7771 2.54072 25.7314 3.40532 23.6877C6.04243 17.449 8.69272 11.2161 11.3016 4.96611C11.5992 4.25409 11.9495 3.97154 12.7369 4.00168C14.3983 4.06761 16.0653 4.05819 17.7267 4.00356C18.4123 3.98096 18.7118 4.23902 18.9605 4.84367C20.7744 9.25141 22.6148 13.6497 24.4589 18.0462C25.1615 19.7226 25.9243 21.3764 26.5968 23.0642C26.8436 23.6858 27.1638 23.9005 27.8381 23.8968C33.2367 23.8685 38.6371 23.8798 44.0356 23.8779C44.4067 23.8779 44.7759 23.8779 45.1997 23.8779C45.1997 25.9255 45.1997 27.8863 45.1997 29.9339C44.872 29.9508 44.5687 29.981 44.2654 29.981C37.1076 29.9847 29.9516 29.9753 22.7937 29.9979C22.1382 29.9998 21.7709 29.8378 21.5467 29.1842C21.1794 28.118 20.6972 27.0914 20.2998 26.0347C20.1227 25.5619 19.8778 25.3566 19.3391 25.3623C16.4835 25.3905 13.626 25.3585 10.7704 25.4037C10.469 25.4093 10.0301 25.7164 9.89825 25.9989C9.38213 27.1065 8.98845 28.2687 8.49305 29.3857C8.38192 29.6362 8.04286 29.9508 7.80175 29.9546C5.515 29.9979 3.22449 29.981 0.745605 29.981ZM17.9358 19.7867C16.9827 17.3605 16.071 15.038 15.0595 12.463C14.0649 15.0512 13.172 17.3718 12.2453 19.7867C14.176 19.7867 15.9824 19.7867 17.9358 19.7867Z" fill="#3D89FB"></path>
                  <path d="M45.2506 4.09424C45.2506 5.7688 45.2656 7.36614 45.2355 8.96347C45.2299 9.21023 45.0622 9.49466 44.8889 9.69056C41.7357 13.2601 37.8422 17.4418 34.6513 20.9774C33.3045 20.9755 31.2287 20.9585 29.8423 20.9096C29.8423 20.9096 28.4032 18.4213 28.1847 18.0219C28.2864 17.924 28.3354 17.9278 30.1682 16.0234C31.92 14.2038 33.5268 12.2429 35.3614 10.1596C34.7003 10.1596 34.2482 10.1596 33.7961 10.1596C31.0968 10.1596 28.3976 10.1709 25.6983 10.1389C25.3894 10.1351 24.9091 9.9505 24.8017 9.71505C23.9748 7.89167 23.2213 6.03816 22.4038 4.09424C30.0439 4.09424 37.5785 4.09424 45.2506 4.09424Z" fill="white"></path>
                </g>
                <defs>
                  <clippath id="clip0_8601_1497">
                    <rect width="44.5087" height="26" fill="white" transform="translate(0.745605 4)"></rect>
                  </clippath>
                </defs>
              </svg></a>
            <div class="right-block flex-item-center">
              <div class="search-icon pr-24 pointer"><i class="ph ph-magnifying-glass text-white fs-24"></i></div>
              @if(!Auth::check())
              <div class="menu-humburger display-none pr-24 pointer"><i class="ph ph-list text-white fs-24"></i></div><a class="button button-blue-hover text-white text-button register_popup" role="button" href="#"> <span> <span></span></span><span class="bg-blue" >Start For Free</span></a>
              <div class="menu-humburger display-none pr-24 pointer"><i class="ph ph-list text-white fs-24"></i></div><a class="button button-blue-hover text-white text-button" role="button" href="#" style="margin-left:10px" id='login_popup'> <span> <span></span></span><span class="bg-blue" style="background-color:#717173!important;" >Login</span></a>
              @else
              <div class="menu-humburger display-none pr-24 pointer"><i class="ph ph-list text-white fs-24"></i></div><a class="button button-blue-hover text-white text-button" role="button" href="/admin/dashboard" > <span> <span></span></span><span class="bg-blue" >Dashboard</span></a>
              @endif
            </div>
          </div>
          <div id="menu-mobile-block">
            <div class="menu-mobile-main"> 
              <div class="heading flex-between"><a class="logo" href=""> 
                  <svg width="46" height="34" viewbox="0 0 46 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_8601_1498)">
                      <path d="M0.745605 29.981C1.67613 27.7771 2.54072 25.7314 3.40532 23.6877C6.04243 17.449 8.69272 11.2161 11.3016 4.96611C11.5992 4.25409 11.9495 3.97154 12.7369 4.00168C14.3983 4.06761 16.0653 4.05819 17.7267 4.00356C18.4123 3.98096 18.7118 4.23902 18.9605 4.84367C20.7744 9.25141 22.6148 13.6497 24.4589 18.0462C25.1615 19.7226 25.9243 21.3764 26.5968 23.0642C26.8436 23.6858 27.1638 23.9005 27.8381 23.8968C33.2367 23.8685 38.6371 23.8798 44.0356 23.8779C44.4067 23.8779 44.7759 23.8779 45.1997 23.8779C45.1997 25.9255 45.1997 27.8863 45.1997 29.9339C44.872 29.9508 44.5687 29.981 44.2654 29.981C37.1076 29.9847 29.9516 29.9753 22.7937 29.9979C22.1382 29.9998 21.7709 29.8378 21.5467 29.1842C21.1794 28.118 20.6972 27.0914 20.2998 26.0347C20.1227 25.5619 19.8778 25.3566 19.3391 25.3623C16.4835 25.3905 13.626 25.3585 10.7704 25.4037C10.469 25.4093 10.0301 25.7164 9.89825 25.9989C9.38213 27.1065 8.98845 28.2687 8.49305 29.3857C8.38192 29.6362 8.04286 29.9508 7.80175 29.9546C5.515 29.9979 3.22449 29.981 0.745605 29.981ZM17.9358 19.7867C16.9827 17.3605 16.071 15.038 15.0595 12.463C14.0649 15.0512 13.172 17.3718 12.2453 19.7867C14.176 19.7867 15.9824 19.7867 17.9358 19.7867Z" fill="#3D89FB"></path>
                      <path d="M45.2506 4.09424C45.2506 5.7688 45.2656 7.36614 45.2355 8.96347C45.2299 9.21023 45.0622 9.49466 44.8889 9.69056C41.7357 13.2601 37.8422 17.4418 34.6513 20.9774C33.3045 20.9755 31.2287 20.9585 29.8423 20.9096C29.8423 20.9096 28.4032 18.4213 28.1847 18.0219C28.2864 17.924 28.3354 17.9278 30.1682 16.0234C31.92 14.2038 33.5268 12.2429 35.3614 10.1596C34.7003 10.1596 34.2482 10.1596 33.7961 10.1596C31.0968 10.1596 28.3976 10.1709 25.6983 10.1389C25.3894 10.1351 24.9091 9.9505 24.8017 9.71505C23.9748 7.89167 23.2213 6.03816 22.4038 4.09424C30.0439 4.09424 37.5785 4.09424 45.2506 4.09424Z" fill="white"></path>
                    </g>
                    <defs>
                      <clippath id="clip0_8601_1498">
                        <rect width="44.5087" height="26" fill="white" transform="translate(0.745605 4)"></rect>
                      </clippath>
                    </defs>
                  </svg></a>
                <div class="close-block"> <i class="ph-bold ph-x d-block fs-18 text-white pointer"></i></div>
              </div>
              <ul class="nav d-block">
                <li><a class="text-subtitle text-white flex-between active" href="#!"><span>Home</span><i class="ph ph-caret-right text-white fs-12"></i></a>
                  <div class="sub-nav-mobile bg-black-surface">
                    <div class="heading flex-between"> 
                      <div class="back-block pointer"><i class="ph ph-caret-left text-white fs-18 d-block"></i></div>
                      <div class="heading7 text-uppercase text-white">Home</div>
                      <div class="close-block"> <i class="ph-bold ph-x d-block fs-18 text-white pointer"></i></div>
                    </div>
                    <div class="list-home"><a class="display-block item" href="index.html"> <i class="icon-chat-bot text-white fs-32"> </i>
                        <div class="text-button text-white">Home chat bot</div>
                        <div class="caption1 text-placehover mt-4">Seamlessly integrate AI chat services into your existing systems</div></a><a class="display-block item mt-24" href="home2.html"><i class="icon-image text-white fs-32"> </i>
                        <div class="text-button text-white">Home Image generator</div>
                        <div class="caption1 text-placehover mt-4">Seamlessly integrate AI chat services into your existing systems</div></a><a class="display-block item mt-24" href="home3.html"><i class="icon-laptop text-white fs-32"> </i>
                        <div class="text-button text-white">Home Digital Agency</div>
                        <div class="caption1 text-placehover mt-4">Seamlessly integrate AI chat services into your existing systems</div></a><a class="display-block item mt-24" href="home4.html"><i class="icon-clip text-white fs-32"> </i>
                        <div class="text-button text-white">Home Business Agency</div>
                        <div class="caption1 text-placehover mt-4">Seamlessly integrate AI chat services into your existing systems</div></a></div>
                    <div class="explore-block">
                      <div class="main bg-line-dark p-16 bora-12">
                        <div class="heading7 text-white">Explore AI help Business</div>
                        <div class="text-placehover mt-12">Praesent interdum lacus ac est viverra hendrerit. Aliquam dapibus, ante vitae matti gravida.</div><a class="button bg-blue button-blue-hover text-white mt-12" href="about.html"> <span> <span> </span></span><span class="bg-blue">Explore now</span></a>
                      </div>
                    </div>
                  </div>
                </li>
                <li><a class="text-subtitle text-white flex-between" href="#!"><span>Services</span><i class="ph ph-caret-right text-white fs-12"></i></a>
                  <div class="sub-nav-mobile bg-black-surface">
                    <div class="heading flex-between"> 
                      <div class="back-block pointer"><i class="ph ph-caret-left text-white fs-18 d-block"></i></div>
                      <div class="heading7 text-uppercase text-white">Services</div>
                      <div class="close-block"> <i class="ph-bold ph-x d-block fs-18 text-white pointer"></i></div>
                    </div>
                    <div class="list-home">
                      <div class="item"> <a class="flex-column-center" href="service-one.html">
                          <div class="bg-img bora-12 overflow-hidden"><img class="w-100" src="assets_home/images/submenu/182x182.png" alt=""/></div>
                          <div class="text-button text-white text-center mt-8">AI chat bot</div></a></div>
                      <div class="item mt-24"><a class="flex-column-center" href="service-two.html">
                          <div class="bg-img bora-12 overflow-hidden"><img class="w-100" src="assets_home/images/submenu/182x182.png" alt=""/></div>
                          <div class="text-button text-white text-center mt-8">AI Image generator</div></a></div>
                      <div class="item mt-24"><a class="flex-column-center" href="service-three.html">
                          <div class="bg-img bora-12 overflow-hidden"><img class="w-100" src="assets_home/images/submenu/182x182.png" alt=""/></div>
                          <div class="text-button text-white text-center mt-8">Digital Agency</div></a></div>
                      <div class="item mt-24"><a class="flex-column-center" href="service-four.html">
                          <div class="bg-img bora-12 overflow-hidden"><img class="w-100" src="assets_home/images/submenu/182x182.png" alt=""/></div>
                          <div class="text-button text-white text-center mt-8">Business Agency</div></a></div>
                    </div>
                    <div class="explore-block"> 
                      <div class="main bg-line-dark p-16 bora-12">
                        <div class="heading7 text-white">AI Create Image</div>
                        <div class="text-placehover mt-12">Praesent interdum lacus ac est viverra hendrerit. Aliquam dapibus, ante vitae matti gravida.</div><a class="button bg-blue button-blue-hover text-white mt-12" href="about.html"> <span> <span> </span></span><span class="bg-blue">Explore now</span></a>
                      </div>
                    </div>
                  </div>
                </li>
                <li><a class="text-subtitle text-white flex-between" href="#!"><span>Pages</span><i class="ph ph-caret-right text-white fs-12"></i></a>
                  <div class="sub-nav-mobile bg-black-surface">
                    <div class="heading flex-between"> 
                      <div class="back-block pointer"><i class="ph ph-caret-left text-white fs-18 d-block"></i></div>
                      <div class="heading7 text-uppercase text-white">Pages</div>
                      <div class="close-block"> <i class="ph-bold ph-x d-block fs-18 text-white pointer"></i></div>
                    </div>
                    <div class="list-pages"><a class="item flex-item-center gap-8" href="about.html"><i class="icon-infor icon-blue fs-28"> </i>
                        <div class="text-button text-white">About Us</div></a><a class="item flex-item-center gap-8 mt-16" href="pricing.html"><i class="icon-pricing icon-blue fs-28"> </i>
                        <div class="text-button text-white">Pricing</div></a><a class="item flex-item-center gap-8 mt-16" href="faqs.html"><i class="icon-faq icon-blue fs-28"> </i>
                        <div class="text-button text-white">FAQs</div></a><a class="item flex-item-center gap-8 mt-16" href="page-not-found.html"><i class="icon-not-found icon-blue fs-28"> </i>
                        <div class="text-button text-white">404 Page</div></a></div>
                    <div class="banner-infor bora-16 overflow-hidden">
                      <div class="bg-img"><img class="w-100 h-100 object-fit-cover" src="assets_home/images/components/bg-submenu.png" alt=""/></div>
                      <div class="text-content pt-24 pb-24 pl-32 pr-32"> 
                        <div class="heading7">AI Create Image</div>
                        <div class="mt-12">Praesent interdum lacus ac est viverra hendrerit. Aliquam dapibus, ante vitae matti gravida.</div><a class="button bg-blue button-blue-hover text-white mt-12" href="about.html"> <span> <span> </span></span><span class="bg-blue">Explore now</span></a>
                      </div>
                    </div>
                    <div class="explore-block"> 
                      <div class="main bg-line-dark p-16 bora-12">
                        <div class="list-social flex-item-center gap-12"><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.facebook.com/" target="_blank"><i class="icon-facebook display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.linkedin.com/" target="_blank"><i class="icon-linkedin fs-14 display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.twitter.com/" target="_blank"><i class="icon-twitter fs-12 display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.instagram.com/" target="_blank"><i class="icon-instagram fs-14 display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.youtube.com/" target="_blank"><i class="icon-youtube fs-12 display-block"></i></a></div>
                        <div class="text-placehover mt-16">Praesent interdum lacus ac est viverra hendrerit. Aliquam dapibus, ante vitae matti.</div>
                        <div class="mail flex-item-center gap-8 mt-16"><i class="ph-light ph-envelope text-white fs-20"></i><span class="caption1 text-white">hi.avitex@gmail.com</span></div>
                        <div class="phone flex-item-center gap-8 mt-16"><i class="ph-fill ph-phone text-white"></i><span class="fw-700 text-placehover">123 456 7890</span></div>
                      </div>
                    </div>
                  </div>
                </li>
                <li><a class="text-subtitle text-white flex-between" href="blog.html"><span>Blog</span><i class="ph ph-caret-right text-white fs-12"></i></a></li>
                <li><a class="text-subtitle text-white flex-between" href="contact.html"><span>Contact</span><i class="ph ph-caret-right text-white fs-12"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="content">
      <div class="slider-block style-one">
        <div class="slider-main">
          <div class="container"> 
            <div class="row"> 
              <div class="col-xl-6">
                <div class="text-content"> 
                  <div class="heading1 scroll-bottom-to-top2">{{ $translations['title1'] ?? 'text'}}</div>
                  <div class="body2 text-placehover mt-40">{{ $translations['title2'] ?? 'text'}}</div><a class="button button-blue-hover mt-40 register_popup" href="#"> <span> <span></span></span><span class="bg-blue">{{ $translations['title3'] ?? 'text'}}<i class="ph-bold ph-arrow-up-right fs-18 flex-center"></i></span></a>
                </div>
              </div>
              <div class="col-xl-6 scroll-right-to-left2">
                <div class="bg-img"> <img src="assets_home/images/slider/user1.png" alt=""/><img src="assets_home/images/slider/frame-above.png" alt=""/><img src="assets_home/images/slider/frame-below.png" alt=""/></div>
                <div class="icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="68" height="67" viewbox="0 0 68 67" fill="none">
                    <path d="M19.5202 46C23.5662 38.2807 35.6305 19.4737 51.5202 5.99999M32.0899 63.5741C37.1814 61.3503 50.7952 56.8307 64.5188 56.5417M3.00006 35.66C3.23721 30.1091 5.15276 15.8931 10.9177 3.43579" stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="165" height="121" viewbox="0 0 165 121" fill="none">
                    <path d="M2.00006 67C26.6785 44.4479 36.5001 29.5 80.5001 5C55.5001 48.5 36.162 82.718 33.5001 104.5C51.9116 87.0666 132.511 13.8811 138.5 2C124.081 19.8767 76.4868 118.534 76.4868 118.534C76.4868 118.534 116.5 85.5 163 59.1285" stroke="#3D89FB" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
                </div>
                <div class="user-infor bora-24 p-16 flex-item-center gap-12"><i class="ph-fill ph-user fs-24 p-8 bora-50 bg-blue"> </i>
                  <div class="infor"> 
                    <div class="heading7">Maverick Nguyen</div>
                    <div class="text-button-small text-placehover">UI UX Designer, Avitex Inc</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="how-it-work pt-50 pb-100"> 
        <div class="container"> 
          <div class="row heading flex-between row-gap-8">
            <div class="col-lg-6"> 
              <div class="heading3">{{ $translations['title4'] ?? 'text'}} ,{{ $translations['title5'] ?? 'text'}} </div>
            </div>
            <div class="col-lg-5">
              <div class="body1 text-placehover">Power up your website with our advanced chat bot that offers image and video tools, as well as quick and accurate question answering capabilities</div>
            </div>
          </div>
          <div class="row flex-between mt-40 row-gap-40">
            <div class="col-lg-4">
              <div class="feature-item flex-item-center gap-24 scroll-bottom-to-top1">
                <div class="icon"><i class="icon-box-group icon-white fs-40 p-16 bg-line-dark bora-50"></i></div>
                <div class="infor"> 
                  <div class="heading6">{{ $translations['step1'] ?? 'text'}}</div>
                  <div class="text-placehover mt-8">{{ $translations['step1_text'] ?? 'text'}}</div>
                </div>
              </div>
              <div class="feature-item flex-item-center gap-24 mt-40 scroll-bottom-to-top2">
                <div class="icon"><i class="icon-chart-box icon-white fs-40 p-16 bg-line-dark bora-50"></i></div>
                <div class="infor"> 
                  <div class="heading6">{{ $translations['step2'] ?? 'text'}} </div>
                  <div class="text-placehover mt-8">{{ $translations['step2_text'] ?? 'text'}}</div>
                </div>
              </div>
              <div class="feature-item flex-item-center gap-24 mt-40 scroll-bottom-to-top3">
                <div class="icon"><i class="icon-flash icon-white fs-40 p-16 bg-line-dark bora-50"></i></div>
                <div class="infor"> 
                  <div class="heading6">{{ $translations['step3'] ?? 'text'}}</div>
                  <div class="text-placehover mt-8">{{ $translations['step3_text'] ?? 'text'}}</div>
                </div>
              </div>
            </div>
            <div class="col-lg-7"> 
              <div class="bg-img bora-24 overflow-hidden"><img class="w-100" src="assets_home/images/components/bg-how-it-work.png" alt=""/>
                <div class="count bg-blue bora-12 flex-item-center gap-60 pt-20 pb-20 pl-32 pr-32 scroll-left-to-right4">
                  <div class="item">
                    <div class="heading4">1.77<span>k+</span></div>
                    <div class="text-button">Menus</div>
                  </div>
                  <!-- <div class="item">
                    <div class="heading4">2.3<span>k+</span></div>
                    <div class="text-button">Business Setup </div>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="list-partner bg-line-dark pt-40 pb-40"> 
        <div class="container text-center">
          <div class="heading7 text-center">Trusted by 1700+ Restorant</div>
        </div>
        <div class="container gap-32 row-gap-32 flex-between flex-wrap mt-32">
          <div class="partner-item"><img src="assets_home/images/partners/mega.svg" alt=""/></div>
          <div class="partner-item"><img src="assets_home/images/partners/mian.svg" alt=""/></div>
          <div class="partner-item"><img src="assets_home/images/partners/beta.svg" alt=""/></div>
          <div class="partner-item"><img src="assets_home/images/partners/mian2.svg" alt=""/></div>
          <div class="partner-item"><img src="assets_home/images/partners/genvi.svg" alt=""/></div>
        </div>
      </div>
      <!-- /////////////////////////////////////////////// fauturs -->
      <div class="about-us style-one pt-100 pb-100 bg-black-surface">
        <div class="container pb-60">
          <div class="row row-gap-40 flex-between">
            <div class="col-12 col-lg-5 flex-column row-gap-20">
              <div class="heading3">{{ $translations['Feature1_title'] ?? 'text'}}</p>
              </div>
              <div class="body2 text-placehover mt-16">{{ $translations['Feature1_text'] ?? 'text'}}</div>
              <!-- <div class="list-service mt-32">
                <div class="service-item flex-item-center scroll-right-to-left1"><i class="ph-bold ph-check text-blue fs-24"> </i>
                  <div class="heading7 pl-12">Free Live Chat Software</div>
                </div>
                <div class="service-item flex-item-center mt-12 scroll-right-to-left2"><i class="ph-bold ph-check text-blue fs-24"> </i>
                  <div class="heading7 pl-12">Real Time Language Translation</div>
                </div>
                <div class="service-item flex-item-center mt-12 scroll-right-to-left3"><i class="ph-bold ph-check text-blue fs-24"> </i>
                  <div class="heading7 pl-12">Free Question</div>
                </div>
              </div> -->
              <div class="button-block mt-32"><a class="button button-blue-hover" href="about.html"><span> <span></span></span><span class="pt-16 pb-16 bg-blue">Find out more<i class="ph-bold ph-arrow-up-right fs-18 flex-center"></i></span></a></div>
            </div>
            <div class="col-12 col-xl-6">
              <div class="bg w-100 h-100"></div>
              <div class="bg-img"><img src="assets_home/images/components/avatar-about1-1.png" alt=""/>
                <svg xmlns="http://www.w3.org/2000/svg" width="66" height="68" viewbox="0 0 66 68" fill="none">
                  <path d="M45.5642 19.8299C37.8449 23.8759 19.0379 35.9403 5.56419 51.8299M63.1383 32.3997C60.9145 37.4912 56.3949 51.105 56.1059 64.8286M35.2242 3.30982C29.6733 3.54696 15.4573 5.46251 3 11.2275" stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                </svg>
              </div>
              <div class="bg-img"><img src="assets_home/images/components/avatar-about1-2.png" alt=""/>
                <svg xmlns="http://www.w3.org/2000/svg" width="68" height="67" viewbox="0 0 68 67" fill="none">
                  <path d="M19.5201 46C23.5661 38.2807 35.6305 19.4737 51.5201 5.99999M32.0899 63.5741C37.1813 61.3503 50.7952 56.8307 64.5187 56.5417M3 35.66C3.23715 30.1091 5.1527 15.8931 10.9177 3.43579" stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                </svg>
              </div><img src="assets_home/images/components/line-about1.png" alt=""/>
            </div>
          </div>
        </div>
      </div>
      <div class="about-us-reflex style-one pt-100 pb-100 bg-black-surface">
        <div class="container pb-60">
          <div class="row row-gap-40 flex-between">
           
            <div class="col-12 col-xl-6">
              <div class="bg w-100 h-100"></div>
              <div class="bg-img"><img src="assets_home/images/components/avatar-about1-1.png" alt=""/>
                <svg xmlns="http://www.w3.org/2000/svg" width="66" height="68" viewbox="0 0 66 68" fill="none">
                  <path d="M45.5642 19.8299C37.8449 23.8759 19.0379 35.9403 5.56419 51.8299M63.1383 32.3997C60.9145 37.4912 56.3949 51.105 56.1059 64.8286M35.2242 3.30982C29.6733 3.54696 15.4573 5.46251 3 11.2275" stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                </svg>
              </div>
              <div class="bg-img"><img src="assets_home/images/components/avatar-about1-2.png" alt=""/>
                <svg xmlns="http://www.w3.org/2000/svg" width="68" height="67" viewbox="0 0 68 67" fill="none">
                  <path d="M19.5201 46C23.5661 38.2807 35.6305 19.4737 51.5201 5.99999M32.0899 63.5741C37.1813 61.3503 50.7952 56.8307 64.5187 56.5417M3 35.66C3.23715 30.1091 5.1527 15.8931 10.9177 3.43579" stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                </svg>
              </div><img src="assets_home/images/components/line-about1.png" alt=""/>
            </div>


            <div class="col-12 col-lg-5 flex-column row-gap-20">
              <div class="heading3">{{ $translations['Feature2_title'] ?? 'text'}}</p>
              </div>
              <div class="body2 text-placehover mt-16">{{ $translations['Feature2_text'] ?? 'text'}}</div>
     
              <div class="button-block mt-32"><a class="button button-blue-hover" href="about.html"><span> <span></span></span><span class="pt-16 pb-16 bg-blue">Find out more<i class="ph-bold ph-arrow-up-right fs-18 flex-center"></i></span></a></div>
            </div>

            
          </div>
        </div>
      </div>
      <div class="about-us style-one pt-100 pb-100 bg-black-surface">
        <div class="container pb-60">
          <div class="row row-gap-40 flex-between">
            <div class="col-12 col-lg-5 flex-column row-gap-20">
              <div class="heading3">{{ $translations['Feature3_title'] ?? 'text'}}</p>
              </div>
              <div class="body2 text-placehover mt-16">{{ $translations['Feature3_text'] ?? 'text'}}</div>

              <div class="button-block mt-32"><a class="button button-blue-hover" href="about.html"><span> <span></span></span><span class="pt-16 pb-16 bg-blue">Find out more<i class="ph-bold ph-arrow-up-right fs-18 flex-center"></i></span></a></div>
            </div>
            <div class="col-12 col-xl-6">
              <div class="bg w-100 h-100"></div>
              <div class="bg-img"><img src="assets_home/images/components/avatar-about1-1.png" alt=""/>
                <svg xmlns="http://www.w3.org/2000/svg" width="66" height="68" viewbox="0 0 66 68" fill="none">
                  <path d="M45.5642 19.8299C37.8449 23.8759 19.0379 35.9403 5.56419 51.8299M63.1383 32.3997C60.9145 37.4912 56.3949 51.105 56.1059 64.8286M35.2242 3.30982C29.6733 3.54696 15.4573 5.46251 3 11.2275" stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                </svg>
              </div>
              <div class="bg-img"><img src="assets_home/images/components/avatar-about1-2.png" alt=""/>
                <svg xmlns="http://www.w3.org/2000/svg" width="68" height="67" viewbox="0 0 68 67" fill="none">
                  <path d="M19.5201 46C23.5661 38.2807 35.6305 19.4737 51.5201 5.99999M32.0899 63.5741C37.1813 61.3503 50.7952 56.8307 64.5187 56.5417M3 35.66C3.23715 30.1091 5.1527 15.8931 10.9177 3.43579" stroke="#3D89FB" stroke-width="5" stroke-linecap="round"></path>
                </svg>
              </div><img src="assets_home/images/components/line-about1.png" alt=""/>
            </div>
          </div>
        </div>
      </div>

      <!-- /////////////////////////////////////////////////////// end fauturs -->
      

      
      <div class="service-block list-service style-one pt-100"> 
        <div class="container"> 
          <div class="heading text-center"> 
            <div class="heading3 text-center">Find an AI solution for your business</div>
            <div class="body2 text-placehover mt-12 text-center">Experience the future of communication with our AI-powered chat solution.</div>
          </div>
          <div class="list row row-gap-32 mt-40">
            <div class="col-lg-3 col-sm-6 scroll-bottom-to-top1">
                    <div class="service-item hover-box-shadow pl-32 pr-32 pt-24 pb-24 bora-24 h-100"><a class="service-item-main" href="services-detail.html">
                        <div class="heading"><i class="icon-chart icon-white fs-60"></i></div>
                        <div class="desc mt-24">
                          <div class="heading7">Analytics and Insights</div>
                          <div class="text-placehover mt-4">Gain valuable insights into customer behavior, preferences</div>
                        </div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 scroll-bottom-to-top2">
                    <div class="service-item hover-box-shadow pl-32 pr-32 pt-24 pb-24 bora-24 h-100"><a class="service-item-main" href="services-detail.html">
                        <div class="heading"><i class="icon-message icon-white fs-60"></i></div>
                        <div class="desc mt-24">
                          <div class="heading7">Chat Bot AI</div>
                          <div class="text-placehover mt-4">Engage and assist your website visitors with our intelligent </div>
                        </div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 scroll-bottom-to-top3">
                    <div class="service-item hover-box-shadow pl-32 pr-32 pt-24 pb-24 bora-24 h-100"><a class="service-item-main" href="services-detail.html">
                        <div class="heading"><i class="icon-flash icon-white fs-60"></i></div>
                        <div class="desc mt-24">
                          <div class="heading7">Multilingual Support</div>
                          <div class="text-placehover mt-4">Expand your reach and cater to a global audience ...</div>
                        </div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 scroll-bottom-to-top4">
                    <div class="service-item hover-box-shadow pl-32 pr-32 pt-24 pb-24 bora-24 h-100"><a class="service-item-main" href="services-detail.html">
                        <div class="heading"><i class="icon-chart-box icon-white fs-60"></i></div>
                        <div class="desc mt-24">
                          <div class="heading7">AI-Powered Chatbots</div>
                          <div class="text-placehover mt-4">Engage and assist your website visitors with our intelligent</div>
                        </div></a>
                    </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="testimonial-block style-one">
        <div class="container">
          <div class="heading3 text-center">What’s people say’s</div>
          <div class="main-cmt bg-line-dark pl-16 pr-16 pb-60 bora-44 mt-40">
            <div class="row flex-center">
              <div class="col-xl-8 col-lg-9 col-md-10">
                <div class="list-avatar">
                  <div class="prev-btn w-40 h-40 flex-center border-white bora-50"><i class="ph ph-caret-left fs-20 d-block"></i></div>
                  <div class="avatar">
                    <div class="item" data-name="0">
                      <div class="bg-img"><img src="assets_home/images/avatar/76x76.png" alt=""/></div>
                    </div>
                    <div class="item" data-name="1">
                      <div class="bg-img"> <img src="assets_home/images/avatar/76x76.png" alt=""/></div>
                    </div>
                    <div class="item" data-name="2">
                      <div class="bg-img"> <img src="assets_home/images/avatar/76x76.png" alt=""/></div>
                    </div>
                    <div class="item" data-name="3">
                      <div class="bg-img"> <img src="assets_home/images/avatar/76x76.png" alt=""/></div>
                    </div>
                    <div class="item" data-name="4">
                      <div class="bg-img"> <img src="assets_home/images/avatar/76x76.png" alt=""/></div>
                    </div>
                    <div class="item" data-name="5">
                      <div class="bg-img"> <img src="assets_home/images/avatar/76x76.png" alt=""/></div>
                    </div>
                  </div>
                  <div class="next-btn w-40 h-40 flex-center border-white bora-50"><i class="ph ph-caret-right fs-20 d-block"></i></div>
                </div>
                <div class="list-comment">
                  <div class="cmt-item text-center active" data-name="0">
                    <div class="heading6 fw-500">"Working with this agency has been a game-changer for our business. Their team is knowledgeable, and always goes the extra mile."</div>
                    <div class="text-button mt-24">Maverick Nguyen</div>
                    <div class="caption1 text-placehover mt-4">UI UX Designer, Avitex Inc</div>
                  </div>
                  <div class="cmt-item text-center" data-name="1">
                    <div class="heading6 fw-500">"Thanks to their AI solutions, our customer experience has significantly improved. Personal recommendation fostered stronger relationships."</div>
                    <div class="text-button mt-24">Christina Smith</div>
                    <div class="caption1 text-placehover mt-4">Data Analyst, Microsoft</div>
                  </div>
                  <div class="cmt-item text-center" data-name="2">
                    <div class="heading6 fw-500">"Their AI services have been a reliable partner in our business journey. They've empowered us with data-driven solutions for better results."</div>
                    <div class="text-button mt-24">David Johnson</div>
                    <div class="caption1 text-placehover mt-4">Mobile App Developer, Apple</div>
                  </div>
                  <div class="cmt-item text-center" data-name="3">
                    <div class="heading6 fw-500">"The insight generated by their AI tools have been invaluable. They helped us understand our customer behavior and optimize our AI."</div>
                    <div class="text-button mt-24">Peter Parker</div>
                    <div class="caption1 text-placehover mt-4">Business Analyst, Oracle</div>
                  </div>
                  <div class="cmt-item text-center" data-name="4">
                    <div class="heading6 fw-500">"Smart and Efficient! The AI integration into our workflow has been seamless. It's simplified complex task and improved our resource."</div>
                    <div class="text-button mt-24">Georgina Rodriguez</div>
                    <div class="caption1 text-placehover mt-4">Network Engineer, Amazon</div>
                  </div>
                  <div class="cmt-item text-center" data-name="5">
                    <div class="heading6 fw-500">"Efficiency at Its Best! Remarkable AI Solutions! Our business has witnessed remarkable improvements since integrating their AI."</div>
                    <div class="text-button mt-24">Rihana Pavard</div>
                    <div class="caption1 text-placehover mt-4">Database Administrator, IBM</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="projects-block pt-100"> 
        <div class="container"> 
          <div class="bg-blur"></div>
          <div class="heading text-center">
            <div class="heading3 text-center">Our Gallery of Innovative Artworks</div>
            <div class="list-nav flex-center mt-24">
              <div class="nav-item text-button pt-8 pb-8 pl-16 pr-16 bora-44 pointer" data-name="all">All</div>
              <div class="nav-item text-button pt-8 pb-8 pl-16 pr-16 bora-44 pointer" data-name="anime">Anime</div>
              <div class="nav-item text-button pt-8 pb-8 pl-16 pr-16 bora-44 pointer active" data-name="creative">Creative</div>
              <div class="nav-item text-button pt-8 pb-8 pl-16 pr-16 bora-44 pointer" data-name="pixel">Pixel</div>
              <div class="nav-item text-button pt-8 pb-8 pl-16 pr-16 bora-44 pointer" data-name="illustration">Illustration</div>
            </div>
          </div>
          <div class="list row row-gap-32 mt-40">
            <div class="col-lg-3 col-sm-6 item-filter scroll-bottom-to-top1" data-name="creative">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter scroll-bottom-to-top2" data-name="creative">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter scroll-bottom-to-top3" data-name="creative">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter scroll-bottom-to-top4" data-name="creative">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter scroll-bottom-to-top5" data-name="creative">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter scroll-bottom-to-top6" data-name="creative">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter scroll-bottom-to-top7" data-name="creative">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter scroll-bottom-to-top8" data-name="creative">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="anime">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="anime">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="anime">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="anime">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="pixel">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="pixel">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="pixel">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="pixel">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="illustration">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="illustration">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="illustration">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="illustration">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="illustration">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="illustration">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="illustration">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="illustration">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="all">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="all">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="all">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="all">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="all">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="all">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="all">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="all">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="all">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="all">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="all">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
            <div class="col-lg-3 col-sm-6 item-filter hide" data-name="all">
                    <div class=" item">
                      <div class="bg-img bora-20 overflow-hidden"><img class="w-100" src="assets_home/images/projects/300x300.png" alt="AI financial management"/></div><a class="infor p-12" href="project-detail.html">
                        <div class="text-button-uppercase text-secondary">Marketting</div>
                        <div class="heading7 text-on-surface mt-4">AI financial management</div></a>
                    </div>
            </div>
          </div>
        </div>
      </div>
      <div class="section-pricing style-one pt-100">
        <div class="bg-blur"></div>
        <div class="container"> 
          <div class="bg-blur"></div>
          <div class="row flex-between row-gap-40">
            <div class="col-xl-3 col-12">
              <div class="heading">
                <div class="heading3 text-white">Find Your Right Plan</div>
                <div class="body2 text-placehover mt-16">We offer a variety of pricing packages to meet the unique needs of our services. Contact us today to discuss which package is right for you.</div>
                <div class="choose-type bg-line-dark bora-8 p-8 flex-between gap-8 mt-32 display-inline-flex">
                  <button class="button text-white text-button-small bg-transparent pt-12 pb-12 pl-16 pr-16 active" data-name="monthly">Pay Monthly</button>
                  <button class="button text-white text-button-small bg-transparent pt-12 pb-12 pl-16 pr-16" data-name="yearly">Pay Yearly</button>
                </div>
              </div>
            </div>
            <div class="col-xl-9 col-12 pl-65">
              <div class="list-pricing" data-name="monthly">
                <div class="row row-gap-32">
                  <div class="col-md-6 col-12">
                    <div class="pricing-item bg-line-dark p-40 bora-20 h-100">
                      <div class="heading5 text-white">Freebie</div>
                      <div class="body3 text-placehover mt-12">Ideal for individuals who need quick access to basic features.</div>
                      <div class="heading2 text-white mt-20">Free</div><a class="button text-white w-100 mt-24" href="pricing.html"> <span> <span> </span></span><span class="bg-line-dark">Get Started</span></a>
                      <div class="list-feature d-flex flex-column gap-12 mt-40">
                        <div class="item flex-item-center gap-16"> <i class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                          <div class="feature text-white">20,000+ of PNG & SVG graphics</div>
                        </div>
                        <div class="item flex-item-center gap-16"> <i class="ph ph-x fs-12 p-8 bora-50 bg-placehover text-white"></i>
                          <div class="feature text-placehover">Upload custom icons and fonts</div>
                        </div>
                        <div class="item flex-item-center gap-16"> <i class="ph ph-x fs-12 p-8 bora-50 bg-placehover text-white"></i>
                          <div class="feature text-placehover">Unlimited Projects</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="pricing-item bg-line-dark p-40 bora-20 h-100">
                      <div class="heading5 text-white">Premium</div>
                      <div class="body3 text-placehover mt-12">Ideal for individuals who who need advanced features and tools for client work.</div>
                      <div class="price d-flex mt-20">
                        <div class="heading2 text-white">$9.99</div>
                        <div class="text-white">/month</div>
                      </div><a class="button text-white w-100 mt-24" href="pricing.html"> <span> <span> </span></span><span class="bg-line-dark">Get Started</span></a>
                      <div class="list-feature d-flex flex-column gap-12 mt-40">
                        <div class="item flex-item-center gap-16"> <i class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                          <div class="feature text-white">20,000+ of PNG & SVG graphics</div>
                        </div>
                        <div class="item flex-item-center gap-16"> <i class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                          <div class="feature text-placehover">Upload custom icons and fonts</div>
                        </div>
                        <div class="item flex-item-center gap-16"> <i class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                          <div class="feature text-placehover">Access to 100 million stock images</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="list-pricing hide" data-name="yearly">
                <div class="row row-gap-32">
                  <div class="col-md-6 col-12">
                    <div class="pricing-item bg-line-dark p-40 bora-20 h-100">
                      <div class="heading5 text-white">Freebie</div>
                      <div class="body3 text-placehover mt-12">Ideal for individuals who need quick access to basic features.</div>
                      <div class="heading2 text-white text-white mt-20">Free</div><a class="button text-white w-100 mt-24" href="pricing.html"> <span> <span> </span></span><span class="bg-line-dark">Get Started</span></a>
                      <div class="list-feature d-flex flex-column gap-12 mt-40">
                        <div class="item flex-item-center gap-16"> <i class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                          <div class="feature text-white">20,000+ of PNG & SVG graphics</div>
                        </div>
                        <div class="item flex-item-center gap-16"> <i class="ph ph-x fs-12 p-8 bora-50 text-white"></i>
                          <div class="feature text-placehover">Upload custom icons and fonts</div>
                        </div>
                        <div class="item flex-item-center gap-16"> <i class="ph ph-x fs-12 p-8 bora-50 text-white"></i>
                          <div class="feature text-placehover">Unlimited Projects</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-12">
                    <div class="pricing-item bg-line-dark p-40 bora-20 h-100">
                      <div class="heading5 text-white">Premium</div>
                      <div class="body3 text-placehover mt-12">Ideal for individuals who who need advanced features and tools for client work.</div>
                      <div class="price d-flex mt-20">
                        <div class="heading2 text-white">$89.99</div>
                        <div class="text-white">/year</div>
                      </div><a class="button text-white w-100 mt-24" href="pricing.html"> <span> <span> </span></span><span class="bg-line-dark">Get Started</span></a>
                      <div class="list-feature d-flex flex-column gap-12 mt-40">
                        <div class="item flex-item-center gap-16"> <i class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                          <div class="feature text-white">20,000+ of PNG & SVG graphics</div>
                        </div>
                        <div class="item flex-item-center gap-16"> <i class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                          <div class="feature text-placehover">Upload custom icons and fonts</div>
                        </div>
                        <div class="item flex-item-center gap-16"> <i class="ph-bold ph-check fs-12 text-white p-8 bora-50 bg-blue"></i>
                          <div class="feature text-placehover">Access to 100 million stock images</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="our-leader pb-100"> 
        <div class="container"> 
          <div class="row"> 
            <div class="heading3">Meet our leader</div>
            <div class="col-xl-6 col-lg-7 body1 text-placehover mt-24">Beratung’s global leadership is comprised of several key entities, including the managing partner, the Shareholders Council (elected board of directors), the Acceleration Team (global leadership team), and the leaders of various offices and practices.</div>
            <div class="list-our-team mt-40"> 
              <div class="row row-gap-32">
                <div class="col-lg-3 col-sm-6">
                  <div class="item"> 
                    <div class="bg-img"> <img class="w-100 d-block" src="assets/images/avatar/300x400.png" alt=""/></div>
                    <div class="infor mt-16"> 
                      <div class="heading7">Maverick Nguyen</div>
                      <div class="text-placehover mt-8">Graphic Designer</div>
                    </div>
                    <div class="list-social bg-white"><a href="http://facebook.com" target="_blank"> <i class="icon-facebook fs-14"></i></a><a href="http://linkedin.com" target="_blank"> <i class="icon-linkedin fs-14"></i></a><a href="http://twitter.com" target="_blank"> <i class="icon-twitter fs-12"></i></a><a href="http://instagram.com" target="_blank"> <i class="icon-instagram fs-12"></i></a></div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="item"> 
                    <div class="bg-img"> <img class="w-100" src="assets/images/avatar/300x400.png" alt=""/></div>
                    <div class="infor mt-16"> 
                      <div class="heading7">Georgina Smith</div>
                      <div class="text-placehover mt-8">CEO - Marketting</div>
                    </div>
                    <div class="list-social bg-white"><a href="http://facebook.com" target="_blank"> <i class="icon-facebook fs-14"></i></a><a href="http://linkedin.com" target="_blank"> <i class="icon-linkedin fs-14"></i></a><a href="http://twitter.com" target="_blank"> <i class="icon-twitter fs-12"></i></a><a href="http://instagram.com" target="_blank"> <i class="icon-instagram fs-12"></i></a></div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="item"> 
                    <div class="bg-img"> <img class="w-100" src="assets/images/avatar/300x400.png" alt=""/></div>
                    <div class="infor mt-16"> 
                      <div class="heading7">Benjamin Pavard</div>
                      <div class="text-placehover mt-8">CEM - digiNova</div>
                    </div>
                    <div class="list-social bg-white"><a href="http://facebook.com" target="_blank"> <i class="icon-facebook fs-14"></i></a><a href="http://linkedin.com" target="_blank"> <i class="icon-linkedin fs-14"></i></a><a href="http://twitter.com" target="_blank"> <i class="icon-twitter fs-12"></i></a><a href="http://instagram.com" target="_blank"> <i class="icon-instagram fs-12"></i></a></div>
                  </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                  <div class="item"> 
                    <div class="bg-img"> <img class="w-100" src="assets/images/avatar/300x400.png" alt=""/></div>
                    <div class="infor mt-16"> 
                      <div class="heading7">Christina Rodriguez</div>
                      <div class="text-placehover mt-8">Photographer</div>
                    </div>
                    <div class="list-social bg-white"><a href="http://facebook.com" target="_blank"> <i class="icon-facebook fs-14"></i></a><a href="http://linkedin.com" target="_blank"> <i class="icon-linkedin fs-14"></i></a><a href="http://twitter.com" target="_blank"> <i class="icon-twitter fs-12"></i></a><a href="http://instagram.com" target="_blank"> <i class="icon-instagram fs-12"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="style-blue">
        <div id="preload"> 
          <div class="main-content flex-center">
            <div class="circle flex-center"><span></span>
              <div class="circle-child"></div>
            </div>
            <div class="circle flex-center"></div>
          </div>
        </div>
      </div>
      <!-- ////////////////////////////// modals  -->
      <div id="popup-newsletter-block" class='popup-block'>
        <div class="popup-newsletter-main">
          <div class="bg-img"> <img class="w-100 h-100" src="assets_home/images/components/bg-popup-newsletter.png" alt=""/></div>
          <div class="content p-40 bg-on-surface"> 
            <div class="close-block text-end"><i class="ph-bold ph-x d-block fs-18 text-white pointer"></i></div>
            <div class="heading6 text-white">News letter</div>
            <div class="text-placehover mt-8">Sign up to get all the latest AIZAN news, website updates, offers and promos.</div>
            <form class="mt-32">
              <div class="form-input">
                <input class="bg-line-dark text-white" type="text" placeholder="Email"/>
                <button><i class="ph ph-paper-plane-tilt text-placehover"></i></button>
              </div>
              <div class="flex-item-center gap-8 mt-12">
                <input class="prevent-popup-input" type="checkbox" name="prevent"/>
                <div class="caption1 text-placehover">Prevent this Pop-up</div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- ///////////////////////////////////////////////// login -->
      <div id="popup-login-block" class='popup-block'>
        <div class="popup-newsletter-main">
          <div class="bg-img"> <img class="w-100 h-100" src="assets_home/images/components/bg-popup-newsletter.png" alt=""/></div>
          <div class="content p-40 bg-on-surface"> 
            <div class="close-block text-end"><i class="ph-bold ph-x d-block fs-18 text-white pointer"></i></div>
            <div class="heading6 text-white">Login</div>
            <div class="text-placehover mt-8">Login To your Dashboard.</div>
            <form id='Login' class="mt-32" method="POST" action="{{ route('login') }}">
              @csrf
              <label  style='margin-left:10px'>Phone:</label>
              <div class="form-input">
                <input class="bg-line-dark text-white" type="text" placeholder="Phone Or Email"   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                
                <!-- <button><i class="ph ph-paper-plane-tilt text-placehover"></i></button> -->
              </div>
              <label  style='margin-left:10px;margin-top:15px'>Password:</label>
              <div class="form-input">
                <input class="bg-line-dark text-white" type="password" name="password" value="{{ old('password') }}" required autocomplete="current-password" placeholder="Password"/>
                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <a style='margin-top:15px' href="javascript:;" onclick="document.getElementById('Login').submit();" class="button button-blue-hover text-white text-button" href="about.html"> <span> <span></span></span><span class="bg-blue">Login</span></a>
              @error('email')
                    <div class="col-md-12" style='margin-top: 15px;color: #ff9900;background-color: rgb(255, 255, 255, 0.2);border-radius: 10px;padding: 13px'>
                        <div class="form-check-label" >
                            {{ $message}}
                        </div>
                    </div>
                @enderror
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
          <div class="bg-img"> <img class="w-100 h-100" src="assets_home/images/components/bg-popup-newsletter.png" alt=""/></div>
          <div class="content p-40 bg-on-surface"> 
            <div class="close-block text-end"><i class="ph-bold ph-x d-block fs-18 text-white pointer"></i></div>
            <div class="heading6 text-white">Register</div>
            <div class="text-placehover mt-8">Create New Account.</div>
            <form id='Register' class="mt-32" method="POST" action="{{ route('register') }}">
              @csrf
              <!-- /////////////////////////////////////////////////////////////////////////// -->

              <label  style='margin-left:10px'>Full Name:</label>
              <div class="form-input">
                <input class="bg-line-dark text-white @error('fullname') is-invalid @enderror" type="text" placeholder="Full Name"   name="fullname"  required autocomplete="fullname" autofocus/>
              </div>
               @error('fullname')
                    <div class="col-md-12 error" style='#ff9900'>
                        <div class="form-check-label" >
                            {{ $message}}
                        </div>
                    </div>
                @enderror
              <!-- /////////////////////////////////////////////////////////////////////////// -->

              <label  style='margin-left:10px;margin-top:10px'>Business Name:</label>
              <div class="form-input">
                <input class="bg-line-dark text-white @error('store_meta') is-invalid @enderror" type="text" placeholder="Business Name"   name="store_meta"  required autocomplete="businessname" autofocus/>
                
              </div>
               @error('store_meta')
                    <div class="col-md-12 error" style='#ff9900'>
                        <div class="form-check-label" >
                            {{ $message}}
                        </div>
                    </div>
                @enderror
              <!-- /////////////////////////////////////////////////////////////////////////// -->
              <!-- <label  style='margin-left:10px;margin-top:10px'>Country:</label>
              <div class="form-input">
                <select class="bg-line-dark text-white @error('country') is-invalid @enderror" style=' height: 50px;padding: 10px;background-color: #2A2A2D;'  name="country"  required id='country'>
                  <option value="">Select Country</option>
                  @foreach($countries as $country)
                    <option value="{{ $country->name.'%%'.$country->id.'%%'.$country->currency}}">{{ $country->name}}</option>
                  @endforeach
                </select>
              </div>
               @error('country')
                    <div class="col-md-12 error" style='#ff9900'>
                        <div class="form-check-label" >
                            {{ $message}}
                        </div>
                    </div>
                @enderror -->
                <input class="d-none" type="text"  name="country_code" required  id='country_code' value="{{ old('country_code') }}"/>

              <!-- /////////////////////////////////////////////////////////////////////////// -->


              <label  style='margin-left:10px;margin-top:10px'>Phone:</label>
              <div class="">
                <input class="bg-line-dark text-white form-input-new" type="tel"  name="telephone" required  id='phone'/>
              </div>
              @error('telephone')
                    <div class="col-md-12 error" style='#ff9900'>
                        <div class="form-check-label" >
                            {{ $message}}
                        </div>
                    </div>
              @enderror
              <!-- /////////////////////////////////////////////////////////////////////////// -->

              <label  style='margin-left:10px;margin-top:10px'>Password:</label>
              <div class="form-input">
                <input class="bg-line-dark text-white" type="password" name="password" required placeholder="Password"/>
              </div>
              @error('password')
                    <div class="col-md-12 error" style='#ff9900'>
                        <div class="form-check-label" >
                            {{ $message}}
                        </div>
                    </div>
              @enderror
              <!-- /////////////////////////////////////////////////////////////////////////// -->

              <label  style='margin-left:10px;margin-top:10px'>Confirm Password:</label>
              <div class="form-input">
                <input class="bg-line-dark text-white" type="password" name="password_confirmation" required  placeholder="Confirm Password"/>
                
              </div>
              @error('password_confirmation')
                    <div class="col-md-12 error" style='#ff9900'>
                        <div class="form-check-label" >
                            {{ $message}}
                        </div>
                    </div>
              @enderror
              <!-- /////////////////////////////////////////////////////////////////////////// -->

              <a style='margin-top:15px' href="javascript:;" id='submit_register'  class="button button-blue-hover text-white text-button" href="about.html"> <span> <span></span></span><span class="bg-blue">Register</span></a>

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
                    <path d="M0.745605 29.981C1.67613 27.7771 2.54072 25.7314 3.40532 23.6877C6.04243 17.449 8.69272 11.2161 11.3016 4.96611C11.5992 4.25409 11.9495 3.97154 12.7369 4.00168C14.3983 4.06761 16.0653 4.05819 17.7267 4.00356C18.4123 3.98096 18.7118 4.23902 18.9605 4.84367C20.7744 9.25141 22.6148 13.6497 24.4589 18.0462C25.1615 19.7226 25.9243 21.3764 26.5968 23.0642C26.8436 23.6858 27.1638 23.9005 27.8381 23.8968C33.2367 23.8685 38.6371 23.8798 44.0356 23.8779C44.4067 23.8779 44.7759 23.8779 45.1997 23.8779C45.1997 25.9255 45.1997 27.8863 45.1997 29.9339C44.872 29.9508 44.5687 29.981 44.2654 29.981C37.1076 29.9847 29.9516 29.9753 22.7937 29.9979C22.1382 29.9998 21.7709 29.8378 21.5467 29.1842C21.1794 28.118 20.6972 27.0914 20.2998 26.0347C20.1227 25.5619 19.8778 25.3566 19.3391 25.3623C16.4835 25.3905 13.626 25.3585 10.7704 25.4037C10.469 25.4093 10.0301 25.7164 9.89825 25.9989C9.38213 27.1065 8.98845 28.2687 8.49305 29.3857C8.38192 29.6362 8.04286 29.9508 7.80175 29.9546C5.515 29.9979 3.22449 29.981 0.745605 29.981ZM17.9358 19.7867C16.9827 17.3605 16.071 15.038 15.0595 12.463C14.0649 15.0512 13.172 17.3718 12.2453 19.7867C14.176 19.7867 15.9824 19.7867 17.9358 19.7867Z" fill="#3D89FB"></path>
                    <path d="M45.2506 4.09424C45.2506 5.7688 45.2656 7.36614 45.2355 8.96347C45.2299 9.21023 45.0622 9.49466 44.8889 9.69056C41.7357 13.2601 37.8422 17.4418 34.6513 20.9774C33.3045 20.9755 31.2287 20.9585 29.8423 20.9096C29.8423 20.9096 28.4032 18.4213 28.1847 18.0219C28.2864 17.924 28.3354 17.9278 30.1682 16.0234C31.92 14.2038 33.5268 12.2429 35.3614 10.1596C34.7003 10.1596 34.2482 10.1596 33.7961 10.1596C31.0968 10.1596 28.3976 10.1709 25.6983 10.1389C25.3894 10.1351 24.9091 9.9505 24.8017 9.71505C23.9748 7.89167 23.2213 6.03816 22.4038 4.09424C30.0439 4.09424 37.5785 4.09424 45.2506 4.09424Z" fill="white"></path>
                  </g>
                  <defs>
                    <clippath id="clip0_8601_1496">
                      <rect width="44.5087" height="26" fill="white" transform="translate(0.745605 4)"></rect>
                    </clippath>
                  </defs>
                </svg></a></div>
            <div class="footer-navigate">
              <ul class="flex-item-center gap-40">
                <li class="flex-center"><a class="text-subtitle text-white" href="index.html">Home</a></li>
                <li class="flex-center"><a class="text-subtitle text-white" href="service-one.html">Services</a></li>
                <li class="flex-center"><a class="text-subtitle text-white" href="about.html">About</a></li>
                <li class="flex-center"><a class="text-subtitle text-white" href="blog.html">Blog</a></li>
                <li class="flex-center"><a class="text-subtitle text-white" href="contact.html">Contact</a></li>
              </ul>
            </div>
            <div class="list-social flex-item-center gap-12"><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.facebook.com/" target="_blank"><i class="icon-facebook display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.linkedin.com/" target="_blank"><i class="icon-linkedin fs-14 display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.twitter.com/" target="_blank"><i class="icon-twitter fs-12 display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.instagram.com/" target="_blank"><i class="icon-instagram fs-14 display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.youtube.com/" target="_blank"><i class="icon-youtube fs-12 display-block"></i></a></div>
          </div>
          <div class="company-contact flex-center gap-16 mt-32 flex-wrap">
            <div class="phone flex-item-center gap-8"><i class="ph ph-phone text-placehover fs-24"></i><span class="text-button-uppercase text-placehover">012 345 6789</span></div><span class="text-placehover">|</span>
            <div class="mail flex-item-center gap-8"><i class="ph-light ph-envelope text-placehover fs-24"></i><span class="text-button-uppercase text-placehover">aizan@gmail.com</span></div><span class="text-placehover">|</span>
            <div class="location flex-item-center gap-8"><i class="ph-light ph-map-pin text-placehover fs-24"></i><span class="text-button-uppercase text-placehover">710 1st St. Easton, PA 18042 | Chester County</span></div>
          </div>
        </div>
        <div class="bg-black-surface mt-32">
          <div class="container bg-black-surface">
            <div class="line-dark"></div>
            <div class="footer-bottom flex-between pt-12 pb-12 flex-wrap">
              <div class="left-block flex-item-center">
                <div class="copy-right text-placehover caption1">©2023 AIZAN. All Rights Reserved.</div>
              </div>
              <div class="nav-link flex-item-center gap-8"><a class="text-placehover caption1 hover-underline" href="#!">Terms Of Services</a><span class="text-placehover caption1">|</span><a class="text-placehover caption1 hover-underline" href="#!">Privacy Policy</a><span class="text-placehover caption1">|</span><a class="text-placehover caption1 hover-underline" href="#!">Cookie Policy</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="assets_home/js/jquery-3.7.0.js"></script>
    <script src="assets_home/js/jquery-migrate-3.4.1.js"></script>
    <script src="assets_home/js/slick.min.js"></script>
    <script src="assets_home/js/scrollreveal.js"></script>
    <script src="assets_home/js/swiper-bundle.min.js"></script>
    <script src="assets_home/js/bootstrap.bundle.min.js"></script>
    <script src="assets_home/js/countUp.min.js"></script>
    <script src="assets_home/js/waypoints.min.js"></script>
    <script src="assets_home/js/phosphor-icons.js"></script>
    <script src="assets_home/js/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/Bluefieldscom/intl-tel-input/master/lib/libphonenumber/build/utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>
    <script>
       $(document).ready(function() {
        const input = document.querySelector("#phone");
        const input_country = document.querySelector("#country_code");


        var iti =  window.intlTelInput(input, {
        initialCountry: "ma",
        strictMode: true,
        separateDialCode: true,

        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/utils.js?1716383386062" // just for formatting/placeholders etc
      });


      function updateInputValue() {
                // Ensure the input field has a value
                var phoneValue = input.value.trim();
                if (phoneValue !== '') {
                    if (iti.isValidNumber()) {
                        var fullPhoneNumber = iti.getNumber();
                        console.log("Full Phone Number:", fullPhoneNumber); // Log the full phone number for debugging
                        input.value = fullPhoneNumber; // Update the input field with the full phone number
                    } else {
                        console.log("Invalid phone number");
                        input.value = 'none';
                    }

                } else {
                    console.log("Phone input is empty");
                }
            }

            // Listen for the 'countrychange' event
            input.addEventListener('countrychange', function() {
                getCountryName()
                // updateInputValue();
            });

            function getCountryName() {
                var countryData = iti.getSelectedCountryData();
                console.log("Country Name:", countryData.iso2);
                input_country.value = countryData.iso2;
                // $('#country_code').val(countryData.iso2)
            }

            // Update the input value on form submit
            // $('#Register').on('submit', function() {
            //     updateInputValue();
            //     getCountryName();
            // });
            $('#submit_register').on('click', function() {
                updateInputValue();
                getCountryName();
                document.getElementById('Register').submit();
            });
            

            $('#phone').on('blur', function() {
                getCountryName();
            });
             // Populate the input field if there is an old value
             var oldCountryCode = '{{ old('country_code') }}';
             console.log()
              if (oldCountryCode) {
                  iti.setCountry(oldCountryCode);
              }
            getCountryName();
          });

    </script>
    <script>
        $(document).ready(function() {
          $('#country').select2();
          $('.register_popup').click(function(){
              if (popupRegisterBlock) {
                popupRegisterBlock.classList.add('open');
              }
          });
          $('#login_popup').click(function(){
              if (popupLoginBlock) {
                popupLoginBlock.classList.add('open');
              }
          });


        });
        
        
    </script>

    @if($errors->any())
            <script>
                popupRegisterBlock.classList.add('open');

            </script>
    @endif

    @if(session('success_login'))
    <script>
          if (popupLoginBlock) {
                popupLoginBlock.classList.add('open');
          }

          const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 10000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          }
        });
        Toast.fire({
          icon: "success",
          title: "Signed in successfully"
        });
    </script>
    @endif
  </body>
</html>