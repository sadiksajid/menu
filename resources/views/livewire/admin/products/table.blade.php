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

        .img-flag {
            height: 30px;
            width: 30px;
            margin-right: 10px;
            border-radius: 10px;
        }
    </style>
    <div class="container-fluid mb-3">
    <div class='row'>
            <div class="col-md-2 col-1 ">
                <a href="/admin/products/addProduct">
                    <button class="btn btn-dark w-100">{{ $translations['new_product'] }}<i class="fa fa-plus-square-o ml-1 text-orange"></i>  </button>
                </a>
            </div>
            <div class="col-md-2 col-1 ">
                @if(!$use_lib)
                    <button class="btn bg-orange" wire:click="LibUse()">{{ $translations['products_lib'] }} <i class="fa fa-list" ></i>  </button>
                @else
                    <button class="btn btn-dark"  wire:click="LibUse()">{{ $translations['products_list'] }} <i class="fa fa-reply " ></i>  </button>
                @endif
            </div>
            <div class="col-1 " style='text-align: center;'>
              
                <div class="spinner-border text-dark" role="status" style='width:30px;height:30px' wire:loading>
                    <span class="sr-only">Loading...</span>
                </div>
                
            </div>
            <div class="col-md-3 col-6 ">
                @if($use_lib)
                
               <div class="input-group mb-3">
                    <div class="form-group w-100" wire:ignore>
                        <select class="form-control select2">
                            <optgroup label="Categories">
                                <option  value="0" data-icon="{{ get_image('pngs/food-icon.jpg') }}" >--Category--</option>
                                @foreach( $lib_categories as $category)
                                    <option value="{{$category->id}}"  data-icon="{{ get_image('tmb/'.$category->image ?? 'pngs/food-icon.jpg') }}"  >{{$category->title}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>
                </div>
               @endif
            </div>
            <div class="col-md-4 col-6 ">
                <div class="input-group mb-3"> 
                    @if(!empty($search_products))
                    <button class="btn btn-secondary" type="button"
                        wire:click='clearSearch'><i class="fa fa-close text-white-50"></i></button>
                    @endif
                    <input type="text" class="form-control"
                        placeholder="Search ..." aria-label="Search"
                        aria-describedby="button-addon2" wire:model.defer='search_products'> 
                        <button class="btn btn-dark" type="button"
                        id="button_saerch" wire:click='searchProduct'><i class="fa fa-search text-white-50"></i></button> 
                        
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
                <span class="badge bg-secondary"
                    style="position: absolute; z-index:10">{{ $translations['inactive'] }}</span>
                @else
                <span class="badge badge-dark"
                    style="position: absolute; z-index:10">{{ $translations['active'] }}</span>

                @endif
                <div class="card overflow-hidden">
                    <div class='product_div'>
                        <span class="badge bg-orange" role="button"
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
                        <a class="text-uppercase" href="/admin/products/editProduct/{{ $product->id }}">
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
                $text = "<h4 class='m-0'><strong>".$translations['add']."</strong></h4> ";
                $color = 'bg-orange text-dark border-dark'  ;
                $imported = false;
        } else{
                $text = "<h5 class='m-0'><strong>".$translations['imported']."</strong></h5> ";
                $color = 'badge-dark'  ;
                $imported = true;

        }
        @endphp
            <div class="col-xxl-2 col-xl-3  col-lg-4 col-md-6 col-sm-6 col-12 " >
             
                <div class="card overflow-hidden" id="lib-{{$product['id']}}"> 
                    <div class='product_div'>
                  
                        @if(!$imported)
                        <div class='product_image'  @isset($product['media'])  style="background-image: url({{ get_image('tmb/'.$product['media'] ?? 'pngs/food-icon.jpg') }});display: flex; justify-content: center;"  @else  style="background-image: url({{ get_image('pngs/food-icon.jpg') }});display: flex; justify-content: center;" @endif
                            wire:click="AddProductLib({{$product['id']}})" >           
                            <span class="badge border {{$color}} lib_badge " > 
                                {!! $text !!}
                            </span>
                        </div>
                        @else
                        <div class='product_image'  @isset($product['media'])  style="background-image: url({{ get_image('tmb/'.$product['media'] ?? 'pngs/food-icon.jpg') }});display: flex; justify-content: center;"  @else  style="background-image: url({{ get_image('pngs/food-icon.jpg') }});display: flex; justify-content: center;" @endif >           
                            <span class="badge border {{$color}} lib_badge" > 
                                {!! $text !!}
                            </span>
                        </div>
                        @endif
                     
                    </div>
                    
                    <div  @if(!$imported)  class="card-body p-2 text-center" @else class="card-body p-2 text-center bg-dark text-white" @endif >
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
                        <button class='btn btn-dark next_btn' wire:click='nextLibProducts(-1)' style='min-width: 30%;'>
                            {{$translations['previous']}}
                        </button>
                        @endif
                    </div>
                    <div class='col-6'>
                        @if($lib_products_page < $lib_pages_count)
                        <button class='btn btn-dark float-right next_btn' wire:click='nextLibProducts(1)' style='min-width: 30%;'>
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

    window.addEventListener('SelectedProduct', event => {
         
         $('#lib-'+event.detail.id+' .lib_badge').removeClass('bg-orange text-dark border-dark').addClass('badge-dark');
         $('#lib-'+event.detail.id+' .card-body').addClass('bg-dark text-white');

    });


    window.addEventListener('SelectedProduct', event => {
         
         $('#lib-'+event.detail.id+' .lib_badge').removeClass('bg-orange text-dark border-dark').addClass('badge-dark');
         $('#lib-'+event.detail.id+' .card-body').addClass('bg-dark text-white');

    });

    window.addEventListener('select2Start', event => {
         


         $('.select2').select2({
        templateResult: function (data) {
            if (!data.id) {
            return data.text;
            }

            var $result = $(`<span><img src="${data.element.getAttribute('data-icon')}" class="img-flag" /> ${data.text}</span>`);
            return $result;
        },
        templateSelection: function (data) {
            if (!data.id) {
            return data.text;
            }

            var $result = $(`<span><img src="${data.element.getAttribute('data-icon')}" class="img-flag" /> ${data.text}</span>`);
            return $result;
        }
        });



        $('.select2').on('change', function(e) {
            var selectedValue = $(this).val();
            if(selectedValue == 0){
                selectedValue = null
            }
            @this.set('lib_category', selectedValue);
            Livewire.emit('getLibData');
        });
    
     });


</script>
@endsection