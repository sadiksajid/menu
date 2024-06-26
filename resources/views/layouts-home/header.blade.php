@php
    $json = app('translations');
    $translations = $json['home'];
@endphp
<div id="header">
      <div class="header-menu style-one bg-black-surface">
        <div class="container"> 
          <div class="header-main flex-between">
            <div class="menu-main"> 
              <ul class="flex-item-center">
                <li class="flex-center"><a class="text-subtitle" href="/">{{$translations['home']}}</a></li>
                <li class="flex-center"><a class="text-subtitle" href="/contact-us">{{$translations['contact_us']}}</a></li>
              </ul>
            </div><a class="logo" href="/"> 
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
              @if(!Auth::check())
              <div class="menu-humburger display-none pr-24 pointer"><i class="ph ph-list text-white fs-24"></i></div><a class="button button-blue-hover text-white text-button register_popup" role="button" href="#"> <span> <span></span></span><span class="bg-blue" >{{$translations['start_free']}}</span></a>
              <div class="menu-humburger display-none pr-24 pointer"><i class="ph ph-list text-white fs-24"></i></div><a class="button button-blue-hover text-white text-button" role="button" href="#" style="margin-left:10px" id='login_popup'> <span> <span></span></span><span class="bg-blue" style="background-color:#717173!important;" >{{$translations['login']}}</span></a>
              @else
              <div class="menu-humburger display-none pr-24 pointer"><i class="ph ph-list text-white fs-24"></i></div><a class="button button-blue-hover text-white text-button" role="button" href="/admin/dashboard" > <span> <span></span></span><span class="bg-blue" >{{$translations['dashboard']}}</span></a>
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
    
                <li><a class="text-subtitle text-white flex-between" href="/"><span>{{$translations['home']}}</span><i class="ph ph-caret-right text-white fs-12"></i></a></li>
                <li><a class="text-subtitle text-white flex-between" href="/contact-us"><span>{{$translations['contact_us']}}</span><i class="ph ph-caret-right text-white fs-12"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>