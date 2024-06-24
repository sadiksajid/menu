<div>

<div wire:ignore class="hero_single inner_pages background-image"
        @if (isset($images_menu))   data-background="url({{get_image($images_menu)}})" @else data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif
        style="position: relative  ;  " >

            <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10 col-md-8">
                            <h1  > {{ $titles_menu ?? $translations['menu'] }}  </h1>
                            <p  >{{ $texts_menu ?? $translations_resto['store_meta']  }} </p>
                        </div>
                    </div>
                    <!-- /row -->
                </div>
            </div>
       
        </div>
    </div>

    <!-- /hero_single -->

    <div class="pattern_2" wire:ignore>
        <div class="container margin_60_40" data-cues="slideInUp">

            @foreach ( $categories as $category)
            <div class="main_title center">
                <span><em></em></span>
                <h2>{{ $category->title }}</h2>
                <p>{{ $category->s_title}}</p>
            </div>
            <div class="row add_bottom_45 menu-gallery">

                @foreach ( $products->where('product_category_id',$category->id) as $prod)
                <div class="col-lg-6" data-cue="slideInUp">
                    <div class="menu_item order">
                        <figure style='border:1px solid black'>
                            <a href="{{ get_image('moyen/'.$prod['media'][0]['media'])}}" title="Summer Berry"
                                data-effect="mfp-zoom-in">

                                <img src="{{ URL::asset('index1/img/menu_items/menu_items_placeholder.png') }}"
                                    data-src="{{ get_image('moyen/'.$prod['media'][0]['media'])}}" class="lazy" alt="">
                            </a>
                        </figure>
                        <div class="menu_title">
                            <h3>{{$prod['title']}}</h3><em>{{ $prod['price']}} {{ $currency }}</em>
                        </div>
                        <p>{{ substr($prod['description'], 0, 40) }}</p>
                        <a href="#0" class="add_to_cart"
                            style="margin-left: 5px;background-color:{{$store_info->btn_color}}"
                            wire:click="addToCart({{ $prod['id'] }},0)">{{$translations['add_to_cart']}}</a>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach



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