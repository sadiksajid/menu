<div>
    <style>
        .product_image{
            background-color: #cccccc; /* Used if the image is unavailable */
            height: 100%; /* You must set a specified height */
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover; /
        }
        .product_div{
            overflow: hidden;
            width: 100%;
            height: 30vh;
            position:relative
        }
        .lib_badge{
            position: absolute;
            z-index:10;
            bottom:10px;
            cursor:pointer;
        }
        .lib_badge:hover{
            border-width:2px!important;
        }
    </style>
    <div class="container-fluid mb-3">
    <div class='row'>
            <div class="col-md-2 col-1 ">
                <a href="/admin/products/addProduct">
                    <button class="btn btn-info">{{ $translations['new_product'] }}</button>
                </a>
            </div>
            <div class="col-md-2 col-1 ">
                    <button class="btn btn-primary" wire:click="LibUse()">{{ $translations['products_lib'] }}</button>
            </div>
            <div class="col-1 ">
              
                <div class="spinner-border text-info" role="status" style='width:30px;height:30px' wire:loading>
                    <span class="sr-only">Loading...</span>
                </div>
                
            </div>
            <div class="col-md-7 col-6 ">
                <div class="col-md-7 col-12 float-right">
                    <div class="input-group mb-3"> 
                        @if(!empty($search_products))
                        <button class="btn btn-danger" type="button"
                            wire:click='clearSearch'><i class="fa fa-close text-white-50"></i></button>
                        @endif
                        <input type="text" class="form-control"
                            placeholder="Search ..." aria-label="Search"
                            aria-describedby="button-addon2" wire:model.defer='search_products'> 
                            <button class="btn btn-primary" type="button"
                            id="button_saerch" wire:click='searchProduct'><i class="fa fa-search text-white-50"></i></button> 
                            
                        </div>

                </div>
            </div>
        </div>
    </div>
    @if(!$use_lib)
    <div class="container-fluid">
        <div class="row">
        @foreach ($products as $product)
            <div class="col-xxl-2 col-xl-3  col-lg-4 col-md-6 col-sm-6 col-12">
                @if($product->status == 0)
                <span class="badge badge-warning"
                    style="position: absolute; z-index:10">{{ $translations['inactive'] }}</span>
                @else
                <span class="badge badge-success"
                    style="position: absolute; z-index:10">{{ $translations['active'] }}</span>

                @endif
                <div class="card overflow-hidden">
                    <div class='product_div'>
                        <span class="badge badge-warning" role="button"
                            style="position: absolute; z-index:10;color:black;bottom:0px">
                            <h4 class="mb-0"><strong>{{ $product['price']}} {{$currency}}</strong></h4>
                        </span>
                        @isset($product?->media[0])
                        <div class='product_image' style="background-image: url({{ get_image('tmb/'.$product?->media[0]->media ?? 'pngs/food-icon.jpg') }});"> </div>
                        @else
                        <div class='product_image' style="background-image: url({{ get_image('pngs/food-icon.jpg') }});"> </div>
                        @endisset
                    </div>
                    <div class="card-body p-2">
                        <div style="color: rgb(81, 81, 81)">
                            <i aria-hidden="true" class="fa fa-clock-o float-left " style="margin-top: 3px;"></i>
                            <p class=" ml-4 font-blog">{{$product->updated_at}}</p>
                        </div>
                        <h5 class="card-title mb-3">{{substr($product->title , 0, 40) }}</h5>
                        <p class="card-text">{{substr($product->description , 0, 40) }}</p>
                        <a class="text-uppercase" href="/staf/products/editProduct/{{ $product->id }}">
                            <H5 class="">{{ $translations['edit'] }}</H5>
                        </a>


                    </div>
                </div>
            </div>
            @endforeach
       <center>
       {{$products->links()}}
       </center>

    </div>
    @else
    <div class="container-fluid">
        <div class="row">
        @foreach ($lib_products as $product)
        @php 
        if(!in_array($product['id'] ,$imported_products) ){
                $text =  $translations['add'] ;
                $color = 'badge-warning text-dark  border border-dark'  ;
        } else{
                $text = $translations['imported'];
                $color = 'badge-success border'  ;
        }
        @endphp
            <div class="col-xxl-2 col-xl-3  col-lg-4 col-md-6 col-sm-6 col-12 " >
             
                <div class="card overflow-hidden">
                    <div class='product_div'>
                  
                       
                        <div class='product_image'  @isset($product['media'])  style="background-image: url({{ get_image('tmb/'.$product['media'] ?? 'pngs/food-icon.jpg') }});display: flex; justify-content: center;"  @else  style="background-image: url({{ get_image('pngs/food-icon.jpg') }});display: flex; justify-content: center;" @endif>           
                            <span class="badge {{$color}} lib_badge" > 
                                 <h4 class='m-0'><strong>{{ $text }} </strong></h4>
                            </span>
                    
                        </div>
                     
                    </div>
                    <div class="card-body p-2 text-center">
                        <h5 class="card-title ">{{substr($product['title_tr'] , 0, 40) }}</h5>
                    </div>
                </div>
            </div>
            @endforeach

            @if($lib_pages_count > 1)
            <div class='col-12'>
                <div class='row'>
                    
                    <div class='col-6'>
                        @if($lib_products_page > 1)
                        <button class='btn btn-primary next_btn' wire:click='nextLibProducts(-1)' style='min-width: 30%;'>
                            {{$translations['previous']}}
                        </button>
                        @endif
                    </div>
                    <div class='col-6'>
                        @if($lib_products_page < $lib_pages_count)
                        <button class='btn btn-primary float-right next_btn' wire:click='nextLibProducts(1)' style='min-width: 30%;'>
                            {{$translations['next']}}
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endif
    </div>
    @endif
</div>
@section('js')
<script>

$(document).on('click','.next_btn',function() {
  $("html, body").animate({ scrollTop: 0 }, "slow");
  return false;
});


</script>
@endsection