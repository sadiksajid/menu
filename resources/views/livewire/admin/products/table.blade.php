<div>
    <div class="container-fluid mb-3">
    <div class='row'>
            <div class="col-md-2 col-1 ">
                <a href="/admin/products/addProduct">
                    <button class="btn btn-info">{{ $translations['new_product'] }}</button>
                </a>

            </div>

            <div class="col-1 ">
              
                <div class="spinner-border text-info" role="status" style='width:30px;height:30px' wire:loading>
                    <span class="sr-only">Loading...</span>
                </div>
                
            </div>
            <div class="col-md-9 col-6 ">
                <div class="col-md-4 col-12 float-right">
                    <div class="input-group mb-3"> 
                        @if(!empty($search_products))
                        <button class="btn btn-danger" type="button"
                            wire:click='clearSearch'><i class="fa fa-close text-white-50"></i></button>
                        @endif
                        <input type="text" class="form-control"
                            placeholder="Search ..." aria-label="Search"
                            aria-describedby="button-addon2" wire:model.defer='search_products'> 
                            <button class="btn btn-primary" type="button"
                            id="button_saerch"><i class="fa fa-search text-white-50"></i></button> 
                            
                        </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-xl-2 col-md-4 col-lg-4 col-12">
                    @if($product->status == 0)
                    <span class="badge badge-warning" style="position: absolute; z-index:10">{{ $translations['inactive'] }}</span>
                    @else
                    <span class="badge badge-success"  style="position: absolute; z-index:10">{{ $translations['active'] }}</span>

                    @endif
                    <div class="card overflow-hidden">
                        <div style="overflow: hidden;
                                    width: 100%;
                                    height: 250px;
                                    position:relative">
                                     <span class="badge badge-warning" role="button"   style="position: absolute; z-index:10;color:black;bottom:0px">
                                        <h4 class="mb-0"><strong>{{ $product['price']}} {{$currency}}</strong></h4>
                                    </span>
                            @isset($product?->media[0])
                            <img src="{{ get_image('tmb/'.$product?->media[0]->media ?? 'pngs/food-icon.jpg') }}" onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';" lass="card-image1 " style='height: 100%;width: 100%;'>
                            @else
                            <img src="{{ get_image('pngs/food-icon.jpg') }}" onerror="this.onerror=null;this.src='https://minio-api.sys.coolrasto.com/menu/pngs/food-icon.jpg';" lass="card-image1 " style='height: 100%;width: 100%;'>
                            @endisset
                        </div>
                        <div class="card-body p-2">
                            <div style="color: rgb(81, 81, 81)">
                                <i aria-hidden="true" class="fa fa-clock-o float-left " style="margin-top: 3px;"></i>
                                <p class=" ml-4 font-blog" >{{$product->updated_at}}</p>
                            </div>
                            <h5 class="card-title mb-3">{{substr($product->title , 0, 40) }}</h5>
                            <p class="card-text">{{substr($product->description , 0, 40) }}</p>
                            <a  class="text-uppercase" href="/admin/products/editProduct/{{ $product->id }}" ><H5 class="">{{ $translations['edit'] }}</H5></a>
                           

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
       <center>
       {{$products->links()}}
       </center>

    </div>
</div>
@section('js')
<script>
$('#button_saerch').on('click', function() {
    Livewire.emit('render')
});
</script>
@endsection