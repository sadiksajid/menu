<div>
    <div class="main-proifle">
        <div class="row">
            <div class="col-lg-8">
                <div class="box-widget widget-user">
                    <div class="widget-user-image1 d-sm-flex">
                        <img alt="User Avatar" style="width: 130px" class="rounded-circle border p-0"
                            src="{{ URL::asset('assets/images/users/avatar2.png') }}">
                        <div class="mt-1 ml-lg-5">
                            <h4 class="pro-user-username mb-3 font-weight-bold">{{ $client->firstname }}
                                {{ $client->lastname }}
                                @if ($client->trusted == 1)
                                    <i class="fa fa-check-circle text-success"></i>
                                @elseif ($client->trusted == 0)
                                    <i class="fa fa-hourglass-start text-info"></i>
                                @elseif ($client->trusted == -1)
                                    <i class="fa fa-ban text-danger"></i>
                                @endif
                            </h4>
                            <ul class="mb-0 pro-details">


                                <li><span class="profile-icon"><i class="fe fe-flag"></i></span><span
                                        class="h6 mt-3">{{ $client->client_address[0]->city->city }}</span></li>
                                <li><span class="profile-icon"><i class="fe fe-phone-call"></i></span><span
                                        class="h6 mt-3">{{ $client->phone }}</span></li>
                                <li style="width: 100%!important"><span class="profile-icon"><i
                                            class="fe fe-mail"></i></span><span
                                        class="h6 mt-3">{{ $client->email }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-auto">
                <div class="text-lg-right btn-list mt-4 mt-lg-0">
                    @if ($client->status == 'active')
                        @if ($client->trusted == 1)
                            <a wire:click='changeStatus(1)' class="btn btn-sm btn-success">Trusted</a>
                            <a wire:click='changeStatus(-1)'' class="btn btn-sm btn-light">Untrusted</a>
                        @elseif ($client->trusted == 0)
                            <a wire:click='changeStatus(1)' class="btn btn-sm btn-primary">Trusted</a>
                            <a wire:click='changeStatus(-1)'' class="btn btn-sm btn-danger">Untrusted</a>
                        @elseif ($client->trusted == -1)
                            <a wire:click='changeStatus(1)' class="btn btn-sm btn-light">Trusted</a>
                            <a wire:click='changeStatus(-1)'' class="btn btn-sm  btn-danger">Untrusted</a>
                        @endif
                        <a wire:click='BlockClient(0)' class="btn btn-sm btn-danger">Block</a>
                    @else
                        <a wire:click='BlockClient(1)' class="btn btn-danger">UnBlock</a>
                    @endif


                </div>
                <div class="mt-5">
                    <div class="main-profile-contact-list row">
                        <div class="media col-sm-6">
                            <div class="media-icon bg-primary text-white mr-3 mt-1">
                                <i class="fa fa-cart-plus fs-18"></i>
                            </div>
                            <div class="media-body">
                                <small class="text-muted">Orders</small>
                                <div class="font-weight-bold number-font">
                                    {{ $orders }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="profile-cover">
            <div class="wideget-user-tab">
                <div class="tab-menu-heading p-0">
                    {{-- <div class="tabs-menu1 px-3">
                        <ul class="nav">
                            <li><a href="#tab-7" class="active fs-14" data-toggle="tab">About</a></li>
                            <li><a href="#tab-8" data-toggle="tab" class="fs-14">Friends</a></li>
                            <li><a href="#tab-9" data-toggle="tab" class="fs-14">Timeline</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div><!-- /.profile-cover -->
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="border-0">
                <div class="tab-content">
                    <div>
                        <ul class="timelineleft pb-5">
                            @php
                                $date = null;
                            @endphp
                            @foreach ($all_orders as $order)
                                @if ($order->created_at->format('d-m-Y') != $date)
                                    <li class="timeleft-label"><span
                                            class="bg-danger">{{ $order->created_at->format('d-m-Y') }}</span></li>

                                    @php
                                        $date = $order->created_at->format('d-m-Y');
                                    @endphp
                                @endif
                                <li>
                                    <i class="fa fa-cart-plus bg-primary"></i>
                                    <div class="timelineleft-item">
                                        <span class="time"><i class="fa fa-clock-o text-danger"></i>
                                            {{ $order->created_at->format('H:d') }} </span>
                                        <h3 class="timelineleft-header"><a href="#">New Order</a>
                                            <div class="timelineleft-body">
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
                                                            @foreach ($order->products as $product)
                                                                <tr>
                                                                    <td class="font-weight-bold">{{ $loop->index + 1 }}
                                                                    </td>

                                                                    <td class="tx-center">
                                                                        <img style='width:50px;height:50px'
                                                                            src="{{ get_image($product->product->media[0]->media ?? null  ) ">
                                                                    </td>

                                                                    <td class="tx-center">
                                                                        {{ $product->product->title }}</td>
                                                                    <td class="tx-center">{{ $product->qte }}</td>
                                                                    <td class="tx-center">{{ $product->price }}
                                                                        {{ $order->currency }} </td>
                                                                    <td class="tx-right">{{ $product->total }}
                                                                        {{ $order->currency }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td class="valign-middle" colspan="4" rowspan="10">
                                                                    <div class="invoice-notes">
                                                                        <label
                                                                            class="main-content-label tx-13 font-weight-semibold">Note</label>
                                                                        <p> {{ $order->comment }}</p>
                                                                    </div><!-- invoice-notes -->
                                                                </td>
                                                                </td>
                                                            </tr>
                                                            <tr>

                                                            </tr>


                                                            <tr>
                                                                <td class="text-uppercase font-weight-semibold">Total
                                                                </td>
                                                                <td class="tx-right">
                                                                    <h4 class="text-primary font-weight-bold">
                                                                        {{ $order->total }}
                                                                        {{ $order->currency }}</h4>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="timelineleft-footer">
                                                <a href="/admin/orders/details/{{ $order->id }}"
                                                    class="btn btn-primary text-white btn-sm mt-2">Read more</a>
                                            </div>
                                    </div>
                                </li>
                            @endforeach



                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div><!-- end app-content-->
</div>

</div>
