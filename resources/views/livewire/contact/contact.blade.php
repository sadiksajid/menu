<div>

    
<div id="content">
            <div class="breadcrum pt-80 pb-80">
              <div class="bg-img"> <img src="assets/images/slider/breadcrum.png" alt=""/></div>
              <div class="container"> 
                <div class="row flex-center">
                  <div class="col-lg-7 col-md-8 col-sm-10">
                    <div class="heading-nav flex-center gap-8"><a class="hover-underline caption1 text-placehover" href="index.html">Home </a><i class="ph-fill ph-dot-outline text-purple"></i><a class="caption1 text-placehover" href="#!">Page</a><i class="ph-fill ph-dot-outline text-purple"></i>
                      <div class="caption1 text-white">Contact Us</div>
                    </div>
                    <div class="text-nav text-center mt-12">
                      <div class="heading3 text-white text-center display-inline-block">Contact Us
                        <svg xmlns="http://www.w3.org/2000/svg" width="38" height="46" viewbox="0 0 38 46" fill="none">
                          <path d="M10.1501 28.6324C13.835 25.1233 24.0331 16.9879 35.3457 12.5187M13.8035 40.7067C17.0357 40.4323 25.4105 40.4869 33.0524 42.9013M2.95566 19.8167C4.12796 16.7921 7.85358 9.29141 13.3777 3.48513" stroke="#7D3CF3" stroke-width="5" stroke-linecap="round"></path>
                        </svg>
                      </div>
                      <div class="sub-heading mt-8 text-white text-center fw-400">Get in touch with our dedicated team of experts. Whether you have a question, need assistance, or want to discuss your project, we are here to help.</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      <div class="form-contact style-contact bg-on-surface pt-100 pb-100">
        <div class="container"> 
          <div class="row flex-between row-gap-32">
            <div class="col-12 col-lg-5">
              <div class="infor">
                <div class="heading d-flex flex-column row-gap-16">
                  <div class="heading4 text-white">We’d love to help</div>
                  <div class="body3 text-placehover">Say goodbye to the hassle of managing multiple accounts across different financial institutions.</div>
                  <div class="list-social flex-item-center gap-12"><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.facebook.com/" target="_blank"><i class="icon-facebook display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.linkedin.com/" target="_blank"><i class="icon-linkedin fs-14 display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.twitter.com/" target="_blank"><i class="icon-twitter fs-12 display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.instagram.com/" target="_blank"><i class="icon-instagram fs-14 display-block"></i></a><a class="item bg-blue button-blue-hover bora-50 w-40 h-40 flex-center" href="https://www.youtube.com/" target="_blank"><i class="icon-youtube fs-12 display-block"></i></a></div>
                </div>
                <div class="list-more-infor mt-40">
                  <div class="item flex-item-center gap-12"><i class="ph ph-phone text-white bg-purple p-8 bora-50"></i>
                    <div class="line-y"> </div>
                    <div class="body2 text-white">123 456 7890</div>
                  </div>
                  <div class="item flex-item-center gap-12 mt-20"><i class="ph-bold ph-envelope-simple-open text-white bg-purple p-8 bora-50"></i>
                    <div class="line-y"> </div>
                    <div class="body2 text-white">hi.avitex@gmail.com</div>
                  </div>
                  <div class="item flex-item-center gap-12 mt-20"><i class="ph-bold ph-map-pin-line text-white bg-purple p-8 bora-50"></i>
                    <div class="line-y"> </div>
                    <div class="body2 text-white">4140 Rd. Allentown, New Mexico 31134</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-5">
              <div class="form-block flex-columns-between gap-20 p-28">
                <div class="row row-gap-20">
                  <div class="col-12 col-sm-6">
                    <input class="w-100 bg-surface text-secondary caption1 pl-16 pr-16 pt-12 pb-12 bora-8" type="text" placeholder="Full Name" wire:model.defer='full_name'/>
                    @error('full_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="col-12 col-sm-6">     
                    <input class="w-100 bg-surface text-secondary caption1 pl-16 pr-16 pt-12 pb-12 bora-8" type="text" placeholder="Subject" wire:model.defer='subject'/>
                    @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="col-12">
                    <input class="w-100 bg-surface text-secondary caption1 pl-16 pr-16 pt-12 pb-12 bora-8" type="text" placeholder="Email" wire:model.defer='email'/>
                    @error('email')
                        <span class="invalid-feedback" role="alert" style='color:red'>
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="col-12"> 
                    <textarea class="w-100 bg-surface text-secondary caption1 pl-16 pr-16 pt-12 pb-12 bora-8 display-block" name="messsage" cols="10" rows="4" placeholder="Your Questions..." wire:model.defer='message'></textarea>
                    @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <div class="button-block mt-40">
                  <button class="button bg-purple button-purple-hover text-white" wire:click='Message()'> <span> <span></span></span><span class="bg-purple">Send message</span></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="map-block">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16894.73660956101!2d-99.18411676499272!3d19.41781376470434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d201b420c8c849%3A0x84231ae36f6ec524!2sMuseo%20Nacional%20de%20Antropolog%C3%ADa!5e0!3m2!1svi!2s!4v1689137436245!5m2!1svi!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div id="preload" wire:ignore> 
        <div class="main-content flex-center">
          <div class="circle flex-center"><span></span>
            <div class="circle-child"></div>
          </div>
          <div class="circle flex-center"></div>
        </div>
      </div>
   <a class="scroll-to-top-btn" href="#header"><i class="ph-bold ph-caret-up"></i></a>
    </div>
</div>
   
