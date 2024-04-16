<footer>
@php
$translations = app('translations')['system'];
@endphp
  <div class="frame black"></div>
  <div class="container">
      <div class="row">
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="footer_wp">
                  <i class="icon_pin_alt"></i>
                  <h3> {{$translations['address']['en']}}</h3>
                  <p>{{$this->store_info->address}}</p>
              </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="footer_wp">
                  <i class="icon_tag_alt"></i>
                  <h3>{{$translations['contact_us']['en']}}</h3>
                  <p><a href="tel:{{$this->store_info->phone}}">{{$this->store_info->phone}}</a><br><a
                          href="#0">{{$this->store_info->email}}</a></p>
              </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <div class="footer_wp">
                  <i class="icon_clock_alt"></i>
                  <h3>{{$translations['opening_hours']['en']}}</h3>
                  <ul>
                      <li>Mon - Sat: 10am - 11pm</li>
                      {{-- <li>Sunday: Closed</li> --}}
                  </ul>
              </div>
          </div>
          {{-- <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
              <h3>Keep in touch</h3>
              <div id="newsletter">
                  <div id="message-newsletter"></div>
                  <form method="post" action="phpmailer/newsletter_template_email.php" name="newsletter_form"
                      id="newsletter_form">
                      <div class="form-group">
                          <input type="email" name="email_newsletter" id="email_newsletter"
                              class="form-control" placeholder="Your email">
                          <button type="submit" id="submit-newsletter" style=' background-color:{{$store_info->btn_color}}'><i
                                  class="arrow_carrot-right"></i></button>
                      </div>
                  </form>
              </div>
          </div> --}}
      </div>
      <!-- /row-->
      <hr>
      <div class="row">
          <div class="col-sm-5">
              <p class="copy">© Sadik Sajid  - {{$translations['all_rights_reserved']['en']}}</p>
          </div>
          <div class="col-sm-7">
              <div class="follow_us">
                  <ul>
                      @if(!empty($this->store_info->twitter))
                          <li><a href="{{$this->store_info->twitter}}"><img
                                      src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                      data-src="{{ URL::asset('index1/img/twitter_icon.svg') }}" alt=""
                                      class="lazy"></a></li>
                      @endif
                      @if(!empty($this->store_info->facebook))

                      <li><a href="{{$this->store_info->facebook}}"><img
                                  src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                  data-src="{{ URL::asset('index1/img/facebook_icon.svg') }}" alt=""
                                  class="lazy"></a></li>
                      @endif
                      @if(!empty($this->store_info->instagram))
                      <li><a href="{{$this->store_info->instagram}}"><img
                                  src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                  data-src="{{ URL::asset('index1/img/instagram_icon.svg') }}" alt=""
                                  class="lazy"></a></li>
                      @endif
                      @if(!empty($this->store_info->youtube))

                      <li><a href="{{$this->store_info->youtube}}"><img
                                  src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                  data-src="{{ URL::asset('index1/img/youtube_icon.svg') }}" alt=""
                                  class="lazy"></a></li>
                      @endif

                  </ul>
              </div>
          </div>
      </div>
      <p class="text-center"></p>
  </div>
</footer>