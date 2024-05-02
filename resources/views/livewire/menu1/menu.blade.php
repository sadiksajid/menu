<div>
    


        <div wire:ignore class="hero_single inner_pages background-image"
        @if (isset($images['img_1']))   data-background="get_image($images['img_1'])" @else data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif >

            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1  > {{ $titles['title-1'] ?? $translations_resto['our_menu'] }}  </h1>
                            <p  >{{ $titles['title-2'] ?? $translations_resto['our_menu_text'] }} </p>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
            <div class="frame white"></div>
        </div>
        <!-- /hero_single -->
        
        <div class="pattern_2" wire:ignore>
            <div class="container margin_60_40" data-cues="slideInUp">
                
              @foreach ( $products as $product)
                <div class="main_title center">
                    <span><em></em></span>
                    <h2>{{ $product[0]['category']['title']}}</h2>
                    <p>{{ $product[0]['category']['s_title']}}</p>
                </div>
                <div class="row add_bottom_45 menu-gallery">

                    @foreach ( $product as $prod)
                        <div class="col-lg-6" data-cue="slideInUp">
                            <div class="menu_item order">
                                <figure style='border:1px solid black'>
                                    <a href="{{ get_image('moyen/'.$prod['media'][0]['media'])}}" title="Summer Berry"
                                        data-effect="mfp-zoom-in">
                                        
                                        <img src="{{ URL::asset('index1/img/menu_items/menu_items_placeholder.png') }}"
                                            data-src="{{ get_image('moyen/'.$prod['media'][0]['media'])}}" class="lazy"
                                            alt="">
                                    </a>
                                </figure>
                                <div class="menu_title">
                                    <h3>{{$prod['title']}}</h3><em>{{ $prod['price']}} {{ $currency }}</em>
                                </div>
                                <p>{{ substr($prod['description'], 0, 40) }}</p>
                                <a href="#0" class="add_to_cart" style="margin-left: 5px;background-color:{{$store_info->btn_color}}" wire:click="addToCart({{ $prod['id'] }},0)">{{$translations['add_to_cart']}}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
              @endforeach
                
                {{-- <div class="banner lazy" data-bg="url(img/banner_bg.jpg)">
                    <div class="wrapper d-flex align-items-center justify-content-between opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <div>
                            <small>Special Offer</small>
                            <h3>Burgher Menu $18 only</h3>
                            <p>Hamburgher, Chips, Mix Sausages, Beer, Muffin</p>
                            <a href="reservations.html" class="btn_1">Reserve now</a>
                        </div>
                        <figure class="d-none d-lg-block"><img src="img/banner.svg" alt="" width="200" height="200" class="img-fluid"></figure>
                    </div>
                    <!-- /wrapper -->
                </div>
                <!-- /banner --> --}}

               
                <!-- /row -->
                {{-- <p class="text-center">
                    <a href="#0" class="btn_1 outline" wire:click='generatePdf()'>
                     Download Menu
                     <span wire:loading.class.remove="d-none" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>

                    </a>

                </p> --}}
            </div>
            <!-- /container -->
        </div>
        <!-- /pattern_2 -->


    <div id="toTop"></div><!-- Back to top button -->


</div>

{{-- @section('js')
<script>




</script>
@endsection
 --}}
