<div>
    <div class="container-fluid mb-3">
        <div class="col-md-3 col-6 ">
            <a href="/admin/offers/addOffer">
                <button class="btn btn-info" >New Offer</button>
            </a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($offers as $offer)
                <div class="col-md-4 col-lg-4 col-12">
                    @if($offer->status == 0)
                    <span class="badge badge-warning" style="position: absolute; z-index:10">inactive</span>
                    @else
                    <span class="badge badge-success"  style="position: absolute; z-index:10">active</span>

                    @endif
                    <div class="card overflow-hidden">
                        <div style="overflow: hidden;
                                    width: 100%;
                                    height: 200px;
                                    background: url({{ url(env('PATH_OFFERS')) }}/{{ $offer->image }});
                                    background-size: cover;
                                    background-position:50%,50%;
                                    position:relative"
                                    >
                                     <span class="badge badge-dark" role="button"   style="position: absolute; z-index:10;bottom:0px">
                                        <h5 class="mb-0"><strong> <span style='color:red;text-decoration: line-through
                                            '>{{ $offer['old_price']}} </span> {{ $offer['price']}} {{$currency}}</strong></h5>
                                    </span>
                      
                        </div>
                        <div class="card-body p-2">
                            <div style="color: rgb(81, 81, 81)">
                                <i aria-hidden="true" class="fa fa-clock-o float-left " style="margin-top: 3px;"></i>
                                <p class=" ml-4 font-blog" >{{$offer->updated_at}}</p>
                            </div>
                            <h5 class="card-title mb-3">{{substr($offer->title , 0, 40) }}</h5>
                            <p class="card-text">{{substr($offer->description , 0, 40) }}</p>
                            <a  class="text-uppercase" href="/admin/offers/editOffer/{{ $offer->id }}" ><H5 class="">Edite</H5></a>
                           

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
