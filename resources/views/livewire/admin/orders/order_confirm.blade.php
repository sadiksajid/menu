<div>
    @php
        // dd($order->client_address);
        if ($order->order_type == 'shipping') {
            switch ($order->client_address->accuracy) {
                case 'wrong':
                    $r_color = 'danger';
                    break;
                case 'pending':
                    $r_color = 'warning';
                    break;
                case 'verified':
                    $r_color = 'success';
                    break;
                case 'new':
                    $r_color = 'info';
                    break;
                default:
                    $r_color = 'info';
            }
        }

        switch ($order->status) {
            case 'pending':
                $btn1 = 'btn-success';
                $btn2 = 'btn-info';
                $btn3 = 'btn-danger';
                break;
            case 'declined':
                $btn1 = 'btn-light';
                $btn2 = 'btn-light';
                $btn3 = 'btn-danger';
                break;
            case 'confirmed':
                $btn1 = 'btn-success';
                $btn2 = 'btn-light';
                $btn3 = 'btn-light';
                break;
        }

    @endphp

    <div class="row">
        <div @if ($order->order_type == 'shipping') class="col-8" @else class="col-12" @endif>
            @if ($order->order_type == 'shipping')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Maps</h3>
                    </div>
                    @if (!isset($fix_latitude))
                        <div class="alert alert-danger mb-0">
                            You need Client Maps Location !
                        </div>
                    @endif

                    {{-- @if (isset($fix_latitude))
                @if ($fix_latitude == 0)
                    <div class="alert alert-danger mb-0">
                        You need Client Maps Location !
                    </div>
                @endif
            @endif --}}
                    <div class="card-body pl-0 pr-0 pt-0" wire:ignore>
                        <div id="map-wrapper">
                        </div>
                    </div>

                    @if (!isset($fix_latitude) or $fix_latitude == 0)
                        @if ($checklocal == false and $edit_quartier_name == false)
                            <center><button wire:click="checkLoactionInfo()" wire:loading.attr="disabled" type="button"
                                    class="btn btn-info mb-3" style="width: 80%;">Save Location</button></center>
                        @elseif($checklocal == true and $edit_quartier_name == false)
                            <center>
                                <button wire:click="saveRecieverLocation()" wire:loading.attr="disabled" type="button"
                                    class="btn btn-success mb-3">Is This
                                    {{ $order->client_address->quartier->quartier }} Location ? </button>

                                <button wire:click="ChangeQuartierName()" wire:loading.attr="disabled" type="button"
                                    class="btn btn-info mb-3" style="width: 30%;">Correct Quarter Name</button>
                            </center>
                        @elseif($checklocal == false and $edit_quartier_name == true)
                            <div class="container">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="text" class="form-control" placeholder="Quarter Name"
                                            wire:model="correct_quartier">
                                        @error('correct_quartier')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-2">
                                        <button wire:click="saveChangeRecieverLocation()" wire:loading.attr="disabled"
                                            type="button" class="btn btn-info mb-3" style="width: 100%;">Save</button>
                                    </div>
                                    <div class="col-2">
                                        <button wire:click="checkLoactionInfo()" wire:loading.attr="disabled"
                                            type="button" class="btn btn-danger mb-3"
                                            style="width: 100%;">Back</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                </div>
            @else
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Client Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="main-profile-contact-list">
                            <div class="row">
                                <div class="col-4">
                                    @php
                                        $trusted = $order->client->stores->where('store_id', Auth::id())->first()->trusted ?? 0;
                                    @endphp
                                    @if ($trusted == 0)
                                        <div class="media-icon bg-primary text-white" style="float:left">
                                            <i class="fa fa-hourglass"></i>
                                        </div>
                                    @elseif($trusted == 1)
                                        <div class="media-icon bg-success text-white" style="float:left">
                                            <i class="fa fa-check"></i>
                                        </div>
                                    @else
                                        <div class="media-icon bg-danger text-white " style="float:left">
                                            <i class="fa fa-ban"></i>
                                        </div>
                                    @endif

                                    <div class="media-body">
                                        <h4 class="font-weight-bold ml-1 mt-2">{{ $order->client->firstname }}
                                            {{ $order->client->lastname }}
                                        </h4>

                                    </div>


                                </div>
                                <div class="col-4">

                                    <div class="media-icon bg-primary text-white" style="float:left">
                                        <i class="fa fa-phone"></i>
                                    </div>

                                    <div class="media-body">
                                        <h4 class="font-weight-bold ml-1 mt-2">{{ $order->client->phone }}</h4>

                                    </div>
                                </div>
                                <div class="col-4">

                                    <div class="media-icon bg-primary text-white" style="float:left">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>

                                    <div class="media-body">
                                        <h4 class="font-weight-bold ml-1 mt-2">{{ $order->client->email }}</h4>

                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="media mr-5 mt-2">
                                @if ($order->order_type == 'shipping')
                                    <div class="media-icon bg-{{ $r_color }} text-white mr-4" data-placement="top"
                                        data-toggle="tooltip" title="Tooltip on top">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                @endif
                                <div class="media-body">
                                    <div class="row">
                                        <div class=" col-md-6 col-12">
                                            <div class="media-icon bg-primary text-white" style="float:left">
                                                <i class="fa fa-clock-o "></i>
                                            </div>

                                            <div class="media-body">
                                                <h3 class="font-weight-bold ml-1 mt-2">{{ $order->coming_date }}</h3>

                                            </div>
                                        </div>
                                        <div class=" col-md-6 col-12">
                                            <div class="media-icon bg-info text-white" id='time_left_1'
                                                style="float:left">
                                                <i class="fa fa-hourglass-start "></i>
                                            </div>

                                            <div class="media-body">
                                                <h3 class="font-weight-bold ml-1 mt-2 text-info" id='time_left_2'> <span
                                                        id="hours"></span> h
                                                    <span id="minuts"></span> min <span id="seconds"></span> s
                                                </h3>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


            @endif

            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Order Verification - {{ $order->tracking }}</h3>
                </div>
                @php
                if($order->offers != null){
                    $arr = json_decode($order->offers, true);
                    $offers =[];
                    foreach ($arr as  $value) {
                        $offers[$value['id']] = $value ;
                    }
                } 
                $x = 1 ; 
                @endphp

                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered border text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th class="wd-20p"></th>
                                    <th class="wd-20p">Image</th>
                                    <th class="tx-center">Title</th>
                                    <th class="tx-right">Qty</th>
                                    <th class="tx-right">Price</th>

                                    <th class="tx-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $order->products->where('is_offer',1)->groupBy('offer_id')  as $key => $offer)
                                
                                @foreach ($offer as $product)
                                <tr style="background-color:rgb(236, 180, 3,0.3);">
                                    <td class="font-weight-bold">{{ $x }}</td>
                                    <td class="tx-center">
                                        <img style='width:50px;height:50px'
                                            src="{{ url(env('PATH_PRODUCTS')) }}/{{ $product->product->media[0]->media ?? '' }}">
                                    </td>
                                    <td class="tx-center">{{ $product->product->title }}</td>
                                    <td class="tx-center">{{ $product->qte }}</td>
                                    <td class="tx-center"><del>{{ $product->price }} {{ $order->currency }} </del></td>
                                    <td class="tx-right"><del>{{ $product->total }} {{ $order->currency }}</del></td>
                                </tr>
                                @php
                                    $x++;
                                @endphp
                                @endforeach
                                <tr>
                                    <td colspan="6">
                                        <span class="badge badge-warning  " style="color: black">
                                            <h5 class="mb-0">
                                                Offer : {{ $offers[$key]['price'] }}  {{ $order->currency }} /  <del>{{ $offers[$key]['old_price'] }} {{ $order->currency }} </del>

                                            </h5>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach


                                @foreach ($order->products->where('is_offer',0) as $product)
                                    <tr>
                                        <td class="font-weight-bold">{{ $x }}</td>
                                        <td class="tx-center">
                                            <img style='width:50px;height:50px'
                                                src="{{ url(env('PATH_PRODUCTS')) }}/{{ $product->product->media[0]->media ?? '' }}">
                                        </td>
                                        <td class="tx-center">{{ $product->product->title }}</td>
                                        <td class="tx-center">{{ $product->qte }}</td>
                                        <td class="tx-center">{{ $product->price }} {{ $order->currency }} </td>
                                        <td class="tx-right">{{ $product->total }} {{ $order->currency }}</td>
                                    </tr>
                                    @php
                                    $x++;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td class="valign-middle" colspan="4" rowspan="10">
                                        <div class="invoice-notes">
                                            <label class="main-content-label tx-13 font-weight-semibold">Note</label>
                                            <p> {{ $order->comment }}</p>
                                        </div><!-- invoice-notes -->
                                    </td>
                                    </td>
                                </tr>
                                <tr>

                                </tr>
                                {{-- @php
                                $foo = $order->distance / 1000;
                                $km = number_format((float) $foo, 1, '.', '');
                                $cost = 0;
                            @endphp
                            @if ($km != 0)
                                <tr>
                                    <td class="tx-right font-weight-semibold">{!! $agencyProject['Total_Distance'] !!}</td>
                                    <td class="tx-right font-weight-semibold"> {{ $km }}
                                {!! $agencyProject['km'] !!}</td>
                                </tr>
                                @endif --}}
                                {{-- @foreach ($order->extras as $extra)
                            @if ($extra->extra_id == 3)
                                <tr>
                                    <td class="tx-right font-weight-semibold">{{ $extra->extrainfo->Type }}</td>
                                <td class="tx-right font-weight-semibold">{{ $order->insurance_value}}
                                    {!! $agencyProject['DH'] !!}</td>
                                </tr>
                                @php
                                $cost += $order->insurance_value;
                                @endphp
                                @else
                                <tr>
                                    <td class="tx-right font-weight-semibold">{{ $extra->extrainfo->Type }}</td>
                                    <td class="tx-right font-weight-semibold">{{ $extra->extrainfo->price }}
                                        {!! $agencyProject['DH'] !!}</td>
                                </tr>
                                @php
                                $cost += $extra->extrainfo->price;
                                @endphp
                                @endif
                                @endforeach --}}

                                {{-- <tr>
                                <td class="text-uppercase font-weight-semibold">{!! $agencyProject['Shipping_Cost'] !!}</td>
                                <td class="tx-right">
                                    <h4 class="text-primary font-weight-bold">{{ $order->total - $cost }}
                                {!! $agencyProject['DH'] !!}</h4>
                                </td>
                                </tr> --}}

                                <tr>
                                    <td class="text-uppercase font-weight-semibold">Total</td>
                                    <td class="tx-right">
                                        <h4 class="text-primary font-weight-bold">{{ $order->total }}
                                            {{ $order->currency }}</h4>
                                    </td>
                                </tr>
                                {{-- <tr>
                                <td class="text-uppercase font-weight-semibold">{!! $agencyProject['COD_Amount'] !!}</td>
                                <td class="tx-right">
                                    <h4 class="text-primary font-weight-bold">{{ $order->cod_price }}
                                {!! $agencyProject['DH'] !!}</h4>
                                </td>
                                </tr> --}}

                                {{-- @if ($order->is_sender_paying == 0)
                                <tr>
                                    <td class="text-uppercase font-weight-semibold">Receiver Pay : </td>
                                    <td class="tx-right">
                                        <h4 class="text-primary font-weight-bold">
                                            {{ $order->cod_price + $order->total }}
                                {!! $agencyProject['DH'] !!}</h4>
                                </td>
                                </tr>
                                @elseif($order->is_sender_paying == 1 and $order->cod_price > 0)
                                <tr>
                                    <td class="text-uppercase font-weight-semibold">Receiver Pay : </td>
                                    <td class="tx-right">
                                        <h4 class="text-primary font-weight-bold">{{ $order->cod_price }}
                                            {!! $agencyProject['DH'] !!}</h4>
                                    </td>
                                </tr>
                                @if ($order->is_prepade > 0)
                                <tr>
                                    <td class="text-uppercase font-weight-semibold">Sender Pay : </td>
                                    <td class="tx-right">
                                        <h4 class="text-primary font-weight-bold">{{ $order->total }}
                                            {!! $agencyProject['DH'] !!}</h4>
                                    </td>
                                </tr>
                                @endif
                                @endif --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order Information</h3>
                    <div class="spinner-border ml-auto float-right" wire:loading role="status">
                        <span class="sr-only">Loading}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class=" row">
                        {{-- @can('express-orders-to-verify-show') --}}
                        {{-- <div class="col-12 mb-4">
                                <div class=" row">
                                    <div class="col-12">
                                        <h4> :{!! $agencyProject['Sender_Calls'] !!}</h4>
                                    </div>
                                    <div class="col-4">
                                        <button wire:loading.attr="disabled" type="button"
                                            @if ($sender_calls < 1) wire:click="sender_calls(1)" @endif
                                            class="btn {{ $sender_calls >= 1 ? 'btn-yellow' : 'btn-light' }} "
                        style="width: 100%;"><i class="fe fe-phone mr-2"></i>{!! $agencyProject['Try_1'] !!}</button>
                    </div>
                    <div class="col-4">
                        <button wire:loading.attr="disabled" type="button" @if ($sender_calls < 2)
                            wire:click="sender_calls(2)" @endif
                            class="btn {{ $sender_calls >= 2 ? 'btn-orange' : 'btn-light' }}" style="width: 100%;"><i
                                class="fe fe-phone mr-2"></i>{!! $agencyProject['Try_2'] !!}</button>
                    </div>
                    <div class="col-4">
                        <button wire:loading.attr="disabled" type="button" @if ($sender_calls < 3)
                            wire:click="sender_calls(3)" @endif
                            class="btn {{ $sender_calls >= 3 ? 'btn-red' : 'btn-light' }}" style="width: 100%;"><i
                                class="fe fe-phone mr-2"></i>{!! $agencyProject['Try_2'] !!}</button>
                    </div>
                </div>
            </div> --}}

                        <div class="col-12 mb-6">
                            <div class=" row">
                                <div class="col-12">
                                    <h4>Receiver Calls :</h4>
                                </div>
                                <div class="col-4">
                                    <button wire:click="receiver_calls(1)" wire:loading.attr="disabled"
                                        type="button"
                                        class="btn {{ $receiver_calls >= 1 ? 'btn-yellow' : 'btn-light' }} "
                                        style="width: 100%;"><i class="fe fe-phone mr-2"></i>Try 1</button>
                                </div>
                                <div class="col-4">
                                    <button wire:click="receiver_calls(2)" wire:loading.attr="disabled"
                                        type="button"
                                        class="btn {{ $receiver_calls >= 2 ? 'btn-orange' : 'btn-light' }}"
                                        style="width: 100%;"><i class="fe fe-phone mr-2"></i>Try 2</button>
                                </div>
                                <div class="col-4">
                                    <button wire:click="receiver_calls(3)" wire:loading.attr="disabled"
                                        type="button"
                                        class="btn {{ $receiver_calls >= 3 ? 'btn-red' : 'btn-light' }}"
                                        style="width: 100%;"><i class="fe fe-phone mr-2"></i>Try 3</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-1 mb-1">
                            <textarea class="form-control" cols="10" rows="3" style="height:100px" wire:model.defer="adminComment">{!! $adminComment !!}</textarea>
                        </div>
                        <div class="col-12">
                            @foreach ($comments as $cmm)
                                @if ($cmm->type == 0)
                                    <span data-bs-placement="top" title="{{ $cmm->comment }}"
                                        wire:click="addComment('{{ $cmm->comment }}')"
                                        class="badge badge-primary-light mb-2"
                                        style="cursor:pointer;font-size: 15px;">{{ substr($cmm->comment, 0, 10) }}
                                        ...</span>
                                @elseif($cmm->type == 1)
                                    <span data-bs-placement="top" title="{{ $cmm->comment }}"
                                        wire:click="addComment('{{ $cmm->comment }}')"
                                        class="badge badge-success-light mb-2"
                                        style="cursor:pointer;font-size: 15px;">{{ substr($cmm->comment, 0, 10) }}
                                        ...</span>
                                @elseif($cmm->type == 2)
                                    <span data-bs-placement="top" title="{{ $cmm->comment }}"
                                        wire:click="addComment('{{ $cmm->comment }}')"
                                        class="badge badge-danger-light  mb-2"
                                        style="cursor:pointer;font-size: 15px;">{{ substr($cmm->comment, 0, 10) }}
                                        ...</span>
                                @endif
                                @isset($comments[$loop->index + 1])
                                    @if ($comments[$loop->index]->type != $comments[$loop->index + 1]->type)
                                    @endif
                                @endisset
                            @endforeach
                        </div>
                        {{-- @endcan --}}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-4">
                            <button wire:loading.attr="disabled" class="btn {{ $btn1 }} btn-block"
                                wire:click.prevent="orderstatus('confirmed')"><i class="fe fe-check"></i>
                                Verify</button>
                        </div>
                        <div class="col-4">
                            <button wire:loading.attr="disabled" class="btn {{ $btn2 }} btn-block"
                                wire:click.prevent="saveComment()"><i class="fe fe-info"></i>
                                Save</button>
                        </div>
                        <div class="col-4">
                            <button wire:loading.attr="disabled" class="btn {{ $btn3 }} btn-block"
                                wire:click.prevent="orderstatus('declined')"><i class="fe fe-x"></i>
                                Decline</button>
                        </div>

                    </div>
                </div>
            </div>
            {{-- <div class="row">
            @foreach ($order->package as $pkg)
                @foreach ($pkg->pakagepicture as $pic)
                    <div class="col-4">
                        <div class="card mb-3" data-target=".modimg{{ $loop->index }}" data-toggle="modal">
<div class="card-body p-1">
    <img src="https://minio-s3.sys.infodat.com/express-web/package-images/{{ $pic->image }}"
        style="height: 100%;width:100%">
</div>

<div class="p-4 bg-light border border-bottom-0">
    <div class="modal fade modimg{{ $loop->index }}" id="img{{ $loop->index }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">{!! $agencyProject['Image_Details'] !!}</h6>
                    <button class="close" data-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h6 id="ptitle"></h6>
                    <img id="pimg"
                        src='https://minio-s3.sys.infodat.com/express-web/package-images/{{ $pic->image }}' />
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endforeach
@endforeach
</div> --}}
        </div>
        @if ($order->order_type == 'shipping')
            <div class="col-4">
                {{-- @if (isset($order->from_depot))
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{!! $agencyProject['Agency_Information'] !!}</h3>
                </div>
                <div class="card-body">
                    <div class="main-profile-contact-list">
                        <div class="media mr-5 mt-0">
                            <div class="media-icon bg-success text-white mr-4">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="media-body">
                                <h6 class="font-weight-bold mb-1">{!! $agencyProject['Agency_name'] !!}</h6>
                                <span>{{ $order->from_depot->name }}</span>

</div>
</div>
<div class="media mr-5">
    <div class="media-icon bg-primary text-white mr-4">
        <i class="fa fa-user"></i>
    </div>
    <div class="media-body">
        <h6 class="font-weight-bold mb-1">{!! $agencyProject['Responsable'] !!}</h6>
        <span>{{ $order->from_depot->respo_firstname }}
            {{ $order->from_depot->respo_lastname }},
            {{ $order->from_depot->respo_phone }}</span>
        <p>{{ $order->from_depot->respo_email }}</p>
    </div>
</div>
<div class="media mr-5">
    <div class="media-icon bg-warning text-white mr-4">
        <i class="fa fa-map-marker"></i>
    </div>
    <div class="media-body">
        <h6 class="font-weight-bold mb-1">
            {{ $order->senderaddress->city->city ?? $order->senderaddress->ville_name }},
        </h6>
        <p>{{ $order->senderaddress->quartier->quartier ?? $order->senderaddress->quartier_name }}
        </p>
        <span>{{ $order->senderaddress->address }}</span>
    </div>
</div>
</div>
</div>
</div>
@endif --}}
                {{-- @if ($order->company_id != null)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{!! $agencyProject['Company_Information'] !!}</h3>
                </div>
                <div class="card-body">
                    <div class="main-profile-contact-list">
                        <div class="media mr-5 mt-0">
                            <div class="media-icon bg-primary text-white mr-4">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <div class="media-body">
                                <h6 class="font-weight-bold mb-1">{{ $order->company->brand }}</h6>
<span>{{ $order->company->phone }}</span>
<p>{{ $order->company->email }}</p>
</div>
</div>
<div class="media mr-5">
    @php
    switch ($order->companydepot->accuracy) {
    case 0:
    $color = 'danger';
    break;
    case 1:
    $color = 'warning';
    break;
    case 2:
    $color = 'success';
    break;
    default:
    $color = 'warning';
    break;
    }
    @endphp
    <div class="media-icon bg-{{ $color }} text-white mr-4">
        <i class="fa fa-map-marker"></i>
    </div>
    <div class="media-body">
        <h6 class="font-weight-bold mb-1">
            {{ $order->companydepot->city->city ?? $order->companydepot->ville_name }},
        </h6>
        <p>{{ $order->companydepot->quartier->quartier ?? $order->companydepot->quartier_name }}
        </p>
        <span>{{ $order->companydepot->address }}</span>
    </div>
</div>
</div>
</div>
<div class="card-footer">
    <a class="d-inline-flex align-items-center px-2 py-2">
        <span class="w-3 h-3 brround bg-danger mr-2"></span> {!! $agencyProject['not_verified'] !!} </a>
    <a class="d-inline-flex align-items-center px-3 py-2">
        <span class="w-3 h-3 brround bg-warning mr-2"></span> {!! $agencyProject['Not_accurate'] !!} </a>
    <a class="d-inline-flex align-items-center px-3 py-2">
        <span class="w-3 h-3 brround bg-success mr-2"></span> {!! $agencyProject['Accurate'] !!} </a>
</div>
</div>
@else
<div class="card">

    <div class="card-header">
        <h3 class="card-title">{!! $agencyProject['Sender_Information'] !!}</h3>
    </div>
    <div class="card-body">
        <div class="main-profile-contact-list">
            <div class="media mr-5 mt-0">
                <div class="media-icon bg-primary text-white mr-4">
                    <i class="fa fa-user"></i>
                </div>
                <div class="media-body">
                    <h6 class="font-weight-bold mb-1">{{ $order->sender->firstname }}
                        {{ $order->sender->lastname }}
                    </h6>
                    <span>{{ $order->sender->phone }}</span>
                    <p>{{ $order->sender->email }}</p>
                </div>
            </div>
            <div class="media mr-5">
                @php
                switch ($order->senderaddress->accuracy) {
                case 0:
                $color = 'danger';
                break;
                case 1:
                $color = 'warning';
                break;
                case 2:
                $color = 'success';
                break;
                default:
                $color = 'warning';
                break;
                }
                @endphp
                <div class="media-icon bg-{{ $color }} text-white mr-4">
                    <i class="fa fa-map-marker"></i>
                </div>
                <div class="media-body">
                    <h6 class="font-weight-bold mb-1">
                        {{ $order->senderaddress->city->city ?? $order->senderaddress->ville_name }},
                    </h6>
                    <p>{{ $order->senderaddress->quartier->quartier ?? $order->senderaddress->quartier_name }}
                    </p>
                    <span>{{ $order->senderaddress->address }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a class="d-inline-flex align-items-center px-2 py-2">
            <span class="w-3 h-3 brround bg-danger mr-2"></span> {!! $agencyProject['not_verified'] !!} </a>
        <a class="d-inline-flex align-items-center px-3 py-2">
            <span class="w-3 h-3 brround bg-warning mr-2"></span> {!! $agencyProject['Not_accurate'] !!} </a>
        <a class="d-inline-flex align-items-center px-3 py-2">
            <span class="w-3 h-3 brround bg-success mr-2"></span> {!! $agencyProject['Accurate'] !!} </a>
    </div>
</div>
@endif --}}

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Client Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="main-profile-contact-list">
                            <div class="media mr-5 mt-0">
                                <div class="media-icon bg-primary text-white mr-4">
                                    <i class="fa fa-user"></i>
                                </div>
                                @php
                                    $trusted = $order->client->stores->where('store_id', Auth::id())->first()->trusted ?? 0;
                                @endphp
                                @if ($trusted == 0)
                                    <div class="media-icon bg-primary text-white mt-7" style="position: absolute">
                                        <i class="fa fa-hourglass"></i>
                                    </div>
                                @elseif($trusted == 1)
                                    <div class="media-icon bg-success text-white mt-7" style="position: absolute">
                                        <i class="fa fa-check"></i>
                                    </div>
                                @else
                                    <div class="media-icon bg-danger text-white mt-7" style="position: absolute">
                                        <i class="fa fa-ban"></i>
                                    </div>
                                @endif

                                <div class="media-body">
                                    <h6 class="font-weight-bold">{{ $order->client->firstname }}
                                        {{ $order->client->lastname }}
                                    </h6>
                                    <p>{{ $order->client->phone }}</p>
                                    <p>{{ $order->client->email }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="media mr-5 mt-2">
                                <div class="media-icon bg-{{ $r_color }} text-white mr-4" data-placement="top"
                                    data-toggle="tooltip" title="Tooltip on top">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="media-body">
                                    <h6 class="font-weight-bold">
                                        {{ $order->client_address->city->city }},
                                    </h6>
                                    <span>{{ $order->client_address->quartier->quartier }}</span>
                                    <p>{{ $order->client_address->address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a class="d-inline-flex align-items-center px-2 py-2">
                            <span class="w-3 h-3 brround bg-danger mr-2"></span>Not verified</a>
                        <a class="d-inline-flex align-items-center px-3 py-2">
                            <span class="w-3 h-3 brround bg-warning mr-2"></span> Not Accurate</a>
                        <a class="d-inline-flex align-items-center px-3 py-2">
                            <span class="w-3 h-3 brround bg-success mr-2"></span> Accurate </a>
                    </div>
                </div>
                {{-- @if ($order->company_id != null)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{!! $agencyProject['Order_Information'] !!}</h3>
                    <div class="spinner-border ml-auto float-right" wire:loading role="status">
                        <span class="sr-only">{!! $agencyProject['Loading'] !!}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class=" row">

                        <div class="col-12 mt-1 mb-1">
                            <textarea class="form-control" cols="10" rows="3" style="height:100px" wire:model.defer="adminComment">{!! $adminComment !!}</textarea>
                        </div>
                        <div class="col-12">
                            @foreach ($comments as $cmm)
                                @if ($cmm->type == 0)
                                    <span data-bs-placement="top" title="{{ $cmm->comment }}"
wire:click="addComment('{{ $cmm->comment }}')"
class="badge badge-primary-light mb-2"
style="cursor:pointer;font-size: 15px;">{{ substr($cmm->comment, 0, 10) }}
...</span>
@elseif($cmm->type == 1)
<span data-bs-placement="top" title="{{ $cmm->comment }}" wire:click="addComment('{{ $cmm->comment }}')"
    class="badge badge-success-light mb-2" style="cursor:pointer;font-size: 15px;">{{ substr($cmm->comment, 0, 10) }}
    ...</span>
@elseif($cmm->type == 2)
<span data-bs-placement="top" title="{{ $cmm->comment }}" wire:click="addComment('{{ $cmm->comment }}')"
    class="badge badge-danger-light  mb-2" style="cursor:pointer;font-size: 15px;">{{ substr($cmm->comment, 0, 10) }}
    ...</span>
@endif
@isset($comments[$loop->index + 1])
@if ($comments[$loop->index]->type != $comments[$loop->index + 1]->type)
@endif
@endisset
@endforeach
</div>
</div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-4">
            <button wire:loading.attr="disabled" class="btn btn-success btn-block"
                wire:click.prevent="orderstatus({{ $order->id }},2)"><i class="fe fe-check"></i>
                {!! $agencyProject['Verify'] !!} </button>
        </div>
        <div class="col-4">
            <button wire:loading.attr="disabled" class="btn btn-info btn-block" wire:click.prevent="saveComment()"><i
                    class="fe fe-info"></i>
                {!! $agencyProject['Save'] !!}</button>
        </div>
        <div class="col-4">
            <button wire:loading.attr="disabled" class="btn btn-danger btn-block"
                wire:click.prevent="orderstatus({{ $order->id }},0)"><i class="fe fe-x"></i>
                {!! $agencyProject['Decline'] !!}</button>
        </div>

    </div>
</div>
</div>
@else --}}

                {{-- @endif --}}

            </div>
        @endif
    </div>
    {{-- ////////////////////////////////////////////////////////////////////////// --}}

</div>

@section('js')
    <script>
        $(document).ready(function() {
            Livewire.emit('showMap');
            var time = @Json($time_left);
            var h = time['h']
            var m = time['m']
            var s = time['s']
            if (time['rotar'] == true) {

                setInterval(() => {
                    $('#time_left_2').removeClass('text-info');
                    $('#time_left_2').addClass('text-danger');
                    $('#time_left_1').removeClass('bg-info');
                    $('#time_left_1').addClass('bg-danger');
                    s = s + 1;
                    if (s == 61) {
                        s = 0;
                        m = m + 1;
                    }
                    if (m == 61) {
                        m = 00;
                        h = h + 1;
                    }
                    $('#hours').html(h);
                    $('#minuts').html(m);
                    $('#seconds').html(s);
                }, 1000);

            } else {
                setInterval(() => {
                    if (h == 0) {
                        $('#time_left_2').removeClass('text-warning');
                        $('#time_left_2').addClass('text-warning');
                        $('#time_left_1').removeClass('bg-warning');
                        $('#time_left_1').addClass('bg-warning');
                    }
                    if (h > 0 && m > 0 && s > 0) {
                        s = s - 1;
                        if (s == -1) {
                            s = 60;
                            m = m - 1;
                        }
                        if (m == -1) {
                            m = 60;
                            h = h - 1;
                        }
                        if (h == -1) {
                            h = 00;

                        }
                        $('#hours').html(h);
                        $('#minuts').html(m);
                        $('#seconds').html(s);
                    }

                }, 1000);
            }



        });
    </script>
@endsection
