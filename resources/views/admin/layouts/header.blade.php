
@php
$translations = app('translations_admin');
$languages = array('ma' => 'عربية', 'en' => 'English', 'fr' => 'Français');
$flag = array('ar' => 'ma', 'en' => 'en', 'fr' => 'fr');
$current_lang =  Cache::get('locale_admin') ?? 'en';
@endphp


<div class="app-header header">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="{{ url('/' . ($page = '')) }}">
                <img src="{{ URL::asset('assets/images/brand/logo.png') }}" class="header-brand-img desktop-lgo"
                    alt="Appino logo">
                <img src="{{ URL::asset('assets/images/brand/logo.png') }}" class="header-brand-img dark-logo"
                    alt="Appino logo">
                <img src="{{ URL::asset('assets/images/brand/favicon.png') }}" class="header-brand-img mobile-logo"
                    alt="Appino logo">
                <img src="{{ URL::asset('assets/images/brand/favicon.png') }}" class="header-brand-img darkmobile-logo"
                    alt="Appino logo">
            </a>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="{{ url('/' . ($page = '#')) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-align-left header-icon mt-1">
                        <line x1="17" y1="10" x2="3" y2="10"></line>
                        <line x1="21" y1="6" x2="3" y2="6"></line>
                        <line x1="21" y1="14" x2="3" y2="14"></line>
                        <line x1="17" y1="18" x2="3" y2="18"></line>
                    </svg>
                </a>
            </div>


            <div class="d-flex order-lg-2 ml-auto">


            
                <div class="dropdown   header-fullscreen">
                    <li class="submenu">
                        <a href="#" data-toggle="modal" data-target="#select_modal_language" ><img class="card-img-top" src="{{ asset('assets/countries/' . $flag[$current_lang] . '.svg') }}"
                            style="height: 20px" class="card-img-top" ></a>
                    </li>
                </div>

                <div class="dropdown   header-fullscreen">
                    <a class="nav-link icon full-screen-link p-0" id="fullscreen-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M10 4L8 4 8 8 4 8 4 10 10 10zM8 20L10 20 10 14 4 14 4 16 8 16zM20 14L14 14 14 20 16 20 16 16 20 16zM20 8L16 8 16 4 14 4 14 10 20 10z" />
                        </svg>
                    </a>
                </div>

                <div class="dropdown header-notify">
                    <a class="nav-link icon" id="message" data-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24"
                            viewBox="0 0 18 18 " style="border-radius: 10px!important">
                            <path 
                                d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1H2zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12z"/> <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"> 
                            </path> 
                        </svg>
                    </a>
                    
                </div>
                
                <div class="dropdown header-notify">
                    <a class="nav-link icon" id="notea" data-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707C3.105 15.48 3 15.734 3 16v2c0 .553.447 1 1 1h16c.553 0 1-.447 1-1v-2c0-.266-.105-.52-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707C6.895 14.52 7 14.266 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zM12 22c1.311 0 2.407-.834 2.818-2H9.182C9.593 21.166 10.689 22 12 22z">
                            </path>
                        </svg>
                    </a>
                    
                </div>

                <div class="dropdown profile-dropdown">
                    <a href="{{ url('/' . ($page = '#')) }}" class="nav-link pr-0 leading-none"
                        data-toggle="dropdown">
                        <span>
                            <img src="{{ URL::asset('assets/images/users/user_icon.png') }}" alt="img"
                                class="avatar avatar-md brround">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
                        <div class="text-center">
                            <a href="{{ url('/' . ($page = '#')) }}"
                                class="dropdown-item text-center user pb-0 font-weight-bold">{{ Auth::guard('web')->user()->firstname ?? '' }}
                                {{ Auth::guard('web')->user()->lastname ?? '' }}</a>
                            <span class="text-center user-semi-title"></span>
                            <div class="dropdown-divider"></div>
                        </div>

                        <a class="dropdown-item d-flex" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <svg class="header-icon mr-3" xmlns="http://www.w3.org/2000/svg"
                                enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24">
                                <g>
                                    <rect fill="none" height="24" width="24" />
                                </g>
                                <g>
                                    <path
                                        d="M11,7L9.6,8.4l2.6,2.6H2v2h10.2l-2.6,2.6L11,17l5-5L11,7z M20,19h-8v2h8c1.1,0,2-0.9,2-2V5c0-1.1-0.9-2-2-2h-8v2h8V19z" />
                                </g>
                            </svg>
                            <div class="">{{$translations['logout']}}</div>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  


</div>
<!--/app header-->
  <!-- /header -->
  <div wire:ignore class="modal fade bd-example-modal-lg" id="select_modal_language" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style="border:5px solid #262626;background-color:#f7f8fc;z-index:999">
  
          <div class="modal-body pb-0">
              <div class="container text-center">
                  <lottie-player src="{{ URL::asset('assets/SVG/world.json') }}" class="lottie" background="transparent"
                      speed="0.5" loop autoplay mode="bounce" style="width: 250px;margin: auto;">
                  </lottie-player>
                  <h3>
                      Feel free to choose your language
                  </h3>
                  <form  action="{{ route('change_lang') }}" method="POST">
                  @csrf
                
                    <div class="row px-md-5 mb-4 d-flex justify-content-center">
                        @foreach ($languages as $lang => $language)
                     
                        <div class="col-md-4 col-4 mt-2" wire:click="changeLang('{{ $lang }}','{{url()->current()}}')" 
                            style="cursor: pointer">
                            <button type="submit" name='lang' value='{{ $lang }}' class="card p-0" style="box-shadow: 3px 2px 13px -4px rgba(0,0,0,0.75); ">
                                <img class="card-img-top mt-2" src="{{ asset('assets/countries/' . $lang . '.svg') }}"
                                style="height: 60px" class="card-img-top" alt="{{ $language }} flag">
                            <p class="card-text mt-2 p-0 fs-13" style="  margin: auto;  font-weight: bold;color: #626262;">{{ $language }}</p>
                            </button>
                            {{-- <div class="card p-0" style="box-shadow: 3px 2px 13px -4px rgba(0,0,0,0.75); ">
                                <img class="card-img-top mt-2" src="{{ asset('assets/countries/' . $lang . '.svg') }}"
                                    style="height: 60px" class="card-img-top" alt="{{ $language }} flag">
                                <p class="card-text mt-2 p-0 fs-13" style="    font-weight: bold;color: #626262;">{{ $language }}</p>
                            </div> --}}
                        </div>
                        @endforeach
                    </div>
                </form>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn  mx-auto" aria-label="Close" class="close"
                  data-dismiss="modal" wire:click="changeLang('en','{{url()->current()}}')" style='background-color: #262626;color: #fff;width: 130px;'>
                  <span>Close</span>
              </button>
          </div>
      </div>
  </div>
  </div>