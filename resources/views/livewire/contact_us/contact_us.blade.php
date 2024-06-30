<div>
<div wire:ignore class="hero_single inner_pages background-image"
        @if (isset($images_contact_us))   data-background="url({{get_image($images_contact_us)}})" @else data-background="url({{ URL::asset('index1/img/hero_contact_us.jpg')}})" @endif
        style="position: relative  ;  " >

            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <!-- <h1  > {{ $titles_contact_us ?? $translations['contact_us'] }}  </h1> -->
                            <h1  > {{  $translations['contact_us'] }}  </h1>
                            <!-- <p  >{{ $texts_contact_us ?? $translations_resto['store_meta']  }} </p> -->
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
       
        </div>
    </div>


    <div class="bg_gray">
		    <div class="container margin_60_40">
		        <div class="row justify-content-center">
		            <div class="col-lg-4">
		                <div class="box_contacts">
		                    <i class="icon_tag_alt" style='color:{{$store_info->btn_color}}!important'></i>
		                    <h2>{{$translations['to_order']}}</h2>
		                    <a href="#0"><h4>{{$store_info->phone}}</h4></a>
                            <br>
                            <a href="#0"><h4>{{$store_info->phone2}}</h4></a>
		                </div>
		            </div>
		            <div class="col-lg-4">
		                <div class="box_contacts">
		                    <i class="icon_pin_alt" style='color:{{$store_info->btn_color}}!important'></i>
		                    <h2>{{$translations['address']}}</h2>
		                    <div>{{$store_info->address }}</div>
		                </div>
		            </div>
		            <div class="col-lg-4">
		                <div class="box_contacts">
		                    <i class="icon_clock_alt" style='color:{{$store_info->btn_color}}!important'></i>
		                    <h2>{{$translations['opening_hours']}}</h2>
		                    <div> 06:30 pm - 03:00 am </div>
		                </div>
		            </div>
		        </div>
		        <!-- /row -->
		    </div>
		    <!-- /container -->
		</div>
		<!-- /bg_gray -->

		<div class="container margin_60_40">
        <center><h1>{{$translations['our_location']}}</h1></center>
        <div class="row">
		  
		        <div class="col-12 add_bottom_25">
                <div id="map"></div>

                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d8884.338319226717!2d-9.53602216878213!3d30.373079358028406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2sma!4v1719608418834!5m2!1sar!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>		        </div> -->
		    </div>
		    <!-- /row -->
		</div>
		<!-- /container -->


    <div id="toTop"></div><!-- Back to top button -->


</div>



<script>
    const latitude = 30.368086;
    const longitude = -9.536161;
    const iframe_url = `https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d215.09161711587825!2d-9.550590639612876!3d30.39452150519511!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb3b797be766f47%3A0x8b1d71c7f1d3cdb5!2z2KzZiiDYpdmEINiq2Yog2YPYp9ix!5e0!3m2!1sar!2sma!4v1719609411241!5m2!1sar!2sma`;

    const iframe = document.createElement('iframe');
    iframe.src = iframe_url;
    iframe.width = "100%";
    iframe.height = "600";
    iframe.style.border = "0";
    iframe.allowFullscreen = "";
    iframe.loading = "lazy";
    iframe.referrerPolicy = "no-referrer-when-downgrade";

    document.getElementById('map').appendChild(iframe);
</script>