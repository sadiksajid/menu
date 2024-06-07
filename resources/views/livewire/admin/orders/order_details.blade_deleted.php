<form>

    <div class="card d-none d-sm-block">
        <div class="card-header">
            <h3 class="card-title">Client Information</h3>
                <button type="button" wire:click.prevent="editOrder({{ $order->id }})" class="btn btn-primary"
                    style="right:1rem;position: absolute; z-index: 2;">Edit</button>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="main-profile-contact-list">
                            <div class="media mr-4 mt-0">
                                <div class="media-icon bg-primary text-white mr-3 mt-1">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Full Name</small>
                                    <div class="font-weight-normal1">
                                        {{ $order->client->firstname }} {{ $order->client->lastname }}
                                    </div>
                                </div>
                            </div>
                            <div class="media mr-4">
                                <div class="media-icon bg-primary text-white mr-3 mt-1">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Phone</small>
                                    <div class="font-weight-normal1">
                                        {{ $order->client->phone }}
                                    </div>
                                </div>
                            </div>
                            @if (isset($order->client->email))
                                <div class="media mr-4">
                                    <div class="media-icon bg-primary text-white mr-3 mt-1">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="media-body">
                                        <small class="text-muted">Email</small>
                                        <div class="font-weight-normal1">
                                            {{ $order->client->email }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="main-profile-contact-list">
                            <div class="media">
                                <div class="media-icon bg-primary text-white mr-3 mt-1">
                                    <i class="fa fa-map"></i>
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">City</small>
                                    <div class="font-weight-normal1">
                                        {{ $order->client_address->city->city }}
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-icon bg-primary text-white mr-3 mt-1">
                                    <i class="fa fa-map"></i>
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Quartier</small>
                                    <div class="font-weight-normal1">
                                        {{  $order->client_address->quartier->quartier  }}
                                    </div>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-icon bg-primary text-white mr-3 mt-1">
                                    <i class="fa fa-map"></i>
                                </div>
                                <div class="media-body">
                                    <small class="text-muted">Address</small>
                                    <div class="font-weight-normal1">
                                        {{ $order->client_address->address }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Order Products</h3>
            <button type="button" wire:click.prevent="renderDially" class="btn btn-success"
                style="z-index: 2;"><i class="fa fa-rotate-left"></i></button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($order->products)
                            @foreach ($order->products as $product)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>
                                       <img style='width:50px;height:50px' src="{{ get_image($product->product->media[0]->media) }}">
                                    </td>
                                    <td>{{$product->product->title}}</td>
                                    <td>{{$product->qte}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->total}}</td>
                                    {{-- <td>
                                        @if ($package_delete_id === $package->id)
                                            <button type="button" class="btn btn-icon  btn-primary"
                                                wire:click.prevent="deletepackage({{ $package->id }})">
                                                <i class="fe fe-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-icon  btn-danger"
                                                wire:click.prevent="Canceldeletepackage()">
                                                <i class="fe fe-x"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-icon  btn-info"
                                                wire:click.prevent="editPackage({{ $package->id }},{{ $loop->index + 1 }})">
                                                <i class="fe fe-edit"></i></button>
                                            <button type="button" class="btn btn-icon  btn-danger"
                                                wire:click.prevent="confermdeletepackage({{ $package->id }})">
                                                <i class="fe fe-trash"></i></button>
                                        @endif
                                    </td> --}}
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="card  overflow-hidden d-none d-sm-block">
        <div class="card-header">
            <h3 class="card-title">{!! $agencyProject['Extra_Services'] !!} <span class="float-right">{{ $extra_price }}
                    {!! $agencyProject['Dh'] !!}</span></h3>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if ($updateMode)
                            <button type="button" class="btn btn-icon  btn-info" wire:click.prevent="editCach()"><i
                                    class="fe fe-edit"></i></button>
                        @endif
                        @foreach ($extra as $extras)
                            <button class="btn btn-light  mr-3 mb-3"
                                style="width: max-content;border-radius: 15px;transition:0.5s;background-color: #bf1c3d;color:white ">{{ $deliverytypes->where('id', $extras)->first()->Type }}
                                -
                                @if ($deliverytypes->where('id', $extras)->first()->type_id == 3)
                                    {{ $insurance_price }}
                                @else
                                    {{ $deliverytypes->where('id', $extras)->first()->price }}
                                @endif DH
                            </button>
                        @endforeach


                        <h4>{!! $agencyProject['COD_Price'] !!} {{ $cod_cost }}
                            {!! $agencyProject['Dh'] !!}</h4>

                        <h4>{!! $agencyProject['Receiver_will_pay'] !!} {{ $receiver_cost }}
                            {!! $agencyProject['Dh'] !!}</h4>

                        <h4>{!! $agencyProject['Sender_will_pay'] !!} {{ $sender_cost }}
                            {!! $agencyProject['Dh'] !!}</h4>


                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="card  overflow-hidden" wire:ignore>
        <div class="card-header">
            <h3 class="card-title">{!! $agencyProject['comment'] !!}</h3>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        @foreach ($comments as $comment)
                            @if ($comment->type == 0)
                                <span data-bs-placement="top" title="{{ $comment->comment }}"
                                    wire:click="addComment({{ $loop->index }})" class="badge badge-primary-light "
                                    style="cursor:pointer">{{ substr($comment->comment, 0, 10) }} ...</span>
                            @elseif($comment->type == 1)
                                <span data-bs-placement="top" title="{{ $comment->comment }}"
                                    wire:click="addComment({{ $loop->index }})" class="badge badge-success-light "
                                    style="cursor:pointer">{{ substr($comment->comment, 0, 10) }} ...</span>
                            @elseif($comment->type == 2)
                                <span data-bs-placement="top" title="{{ $comment->comment }}"
                                    wire:click="addComment({{ $loop->index }})" class="badge badge-danger-light  "
                                    style="cursor:pointer">{{ substr($comment->comment, 0, 10) }} ...</span>
                            @endif
                        @endforeach

                    </div>
                    <div class="col-12 mt-1 mb-1">
                        <textarea class="form-control" wire:model.defer="comment" cols=" 30" rows="3">

                    </textarea>
                        @error('comment')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

{{-- 
    @if ($n_package > 1 and $packageadd)
        <div class="col-12 d-block d-sm-none mb-5">
            <button type="button" wire:click="NextFinish({{ $t_id_order }})" class="btn btn-primary btn-block">
                {!! $agencyProject['Next'] !!}
            </button>
        </div>
    @endif


    @if ($payment)
        <button type="button" @if ($prob) disabled @else wire:click="finOrder" @endif
            class="btn btn-gray btn-block d-block d-sm-none mb-5">{!! $agencyProject['agencyproject_Print_Recu_finish'] !!}
        </button>
    @endif --}}

</form>
