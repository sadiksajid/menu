<div>
    <div class="container-fluid mb-3">
        <div class="col-md-3 col-6 ">
            <a href="/admin/products/addProduct">
                <button class="btn btn-info" >New Product</button>
            </a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 col-lg-4 col-12">
                    @if($product->status == 0)
                    <span class="badge badge-warning" style="position: absolute; z-index:10">inactive</span>
                    @else
                    <span class="badge badge-success"  style="position: absolute; z-index:10">active</span>

                    @endif
                    <div class="card overflow-hidden">
                        <div style="overflow: hidden;
                                    width: 100%;
                                    height: 250px;
                                    position:relative">
                                     <span class="badge badge-warning" role="button"   style="position: absolute; z-index:10;color:black;bottom:0px">
                                        <h4 class="mb-0"><strong>{{ $product['price']}} {{$currency}}</strong></h4>
                                    </span>
                            <img src="{{ url(env('PATH_PRODUCTS_TMB')) }}/{{ $product->media[0]->media }}" 
                            class="card-image1 ">
                        </div>
                        <div class="card-body p-2">
                            <div style="color: rgb(81, 81, 81)">
                                <i aria-hidden="true" class="fa fa-clock-o float-left " style="margin-top: 3px;"></i>
                                <p class=" ml-4 font-blog" >{{$product->updated_at}}</p>
                            </div>
                            <h5 class="card-title mb-3">{{substr($product->title , 0, 40) }}</h5>
                            <p class="card-text">{{substr($product->description , 0, 40) }}</p>
                            <a  class="text-uppercase" href="/admin/products/editProduct/{{ $product->id }}" ><H5 class="">Edite</H5></a>
                           

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
