<div>

    <div wire:ignore class="hero_single inner_pages background-image" style="height:260px"
    @if (isset($competition_img))   data-background="url({{ get_image($competition_img)}})" @else data-background="url({{ URL::asset('index1/img/hero_menu.jpg')}})" @endif >

        <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-9 col-lg-10 col-md-8">
                        <h1  > {{ $translations_resto['competition'] }}  </h1>
                        {{-- <p  >{{ $titles['title-2'] ?? 'Cooking delicious and tasty food since 2005' }} </p> --}}
                    </div>
                </div>
                <!-- /row -->
            </div>
        </div>
        <div class="frame white"></div>
    </div>
    <!-- /hero_single -->
    
    
    <div class="container-sm mt-4 mb-4" style="width:  80% ">
        <div class="row">
            <div class="col-md-6 col-12">
                    <h3> Name : {{ $client->fullname }}</h3>
                    <h3> Phone: {{ $client->phone }}</h3>
                    <h3> Date: {{ $client->created_at->format('d-m-Y H:i') }}</h3>
            </div>       
            <div class="col-md-6 col-12">
            
            <div class="barcode-container">
                <div class="barcode">
                    {!! $qr_code !!}
                </div>
            </div>
            </div>
          
        
        </div>
    </div>
</div>
