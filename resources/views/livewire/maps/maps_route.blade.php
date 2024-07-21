@extends('layouts-index1.app')


@section('content')
<div class="row">
		  
          <div class="col-12 add_bottom_25">
          <div id="map"></div>

      </div>
  </div>

  <script>

    function detectMob() {
        const toMatch = [
            /Android/i,
            /webOS/i,
            /iPhone/i,
            /iPad/i,
            /iPod/i,
            /BlackBerry/i,
            /Windows Phone/i
        ];
        
        return toMatch.some((toMatchItem) => {
            return navigator.userAgent.match(toMatchItem);
        });
    }

    const is_mobile = detectMob()
    const latitude = 30.368086;
    const longitude = -9.536161;
    const iframe_url = `https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d215.09161711587825!2d-9.550590639612876!3d30.39452150519511!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb3b797be766f47%3A0x8b1d71c7f1d3cdb5!2z2KzZiiDYpdmEINiq2Yog2YPYp9ix!5e0!3m2!1sar!2sma!4v1719609411241!5m2!1sar!2sma`;
    let height = screen.height;
    if(is_mobile == false){
        height = height*0.8
    }
    const iframe = document.createElement('iframe');
    iframe.src = iframe_url;
    iframe.width = "100%";
    iframe.height = height;
    iframe.style.border = "0";
    iframe.allowFullscreen = "";
    iframe.loading = "lazy";
    iframe.referrerPolicy = "no-referrer-when-downgrade";

    document.getElementById('map').appendChild(iframe);
</script>

@endsection


