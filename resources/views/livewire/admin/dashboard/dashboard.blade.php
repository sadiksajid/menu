@section('content')
    <style>
        .hover_appino {
            transition: 0.5s;
        }

        .hover_appino:hover {
            border: 1px solid #fd7e14;
            margin-left: 5px;
        }
    </style>

    <!-- Row-2 -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="card overflow-hidden">
                <div class="card-body pb-0">
                    <div class="text-left mb-4">
                        <p class=" mb-1 ">
                            <i class="fa fa-cart-plus mr-1"></i>
                            New Orders
                        </p>
                        <h2 class="mb-0 font-weight-bold">{{ end($orders['all']) }}<span class="fs-12 text-muted"><span
                                    class=" @if ($res_orders['all'] >= 0) text-success @else text-danger @endif  mr-1"><i
                                        class="fe fe-arrow-up ml-1 "></i> {{ $res_orders['all'] }}%</span> last week</span>
                        </h2>
                    </div>
                </div>
                <div class="chart-wrapper overflow-hidden">
                    <span class="sparkline_new"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="card overflow-hidden">
                <div class="card-body pb-0">
                    <div class="text-left mb-4">
                        <p class=" mb-1 ">
                            <i class="fa fa-cart-arrow-down mr-1"></i>
                            Pending Orders
                        </p>
                        <h2 class="mb-0 font-weight-bold">{{ end($orders['pending']) }}<span class="fs-12 text-muted"><span
                                    class=" @if ($res_orders['pending'] >= 0) text-success @else text-danger @endif  mr-1"><i
                                        class="fe fe-arrow-up ml-1 "></i> {{ $res_orders['pending'] }}%</span> last
                                week</span></h2>
                    </div>
                </div>
                <div class="chart-wrapper overflow-hidden">
                    <span class="sparkline_pending"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="card overflow-hidden">
                <div class="card-body pb-0">
                    <div class="text-left mb-4">
                        <p class=" mb-1 ">
                            <i class="fa fa-cart-arrow-down mr-1"></i>
                            Confirmed Orders
                        </p>
                        <h2 class="mb-0 font-weight-bold">{{ end($orders['confirmed']) }}<span
                                class="fs-12 text-muted"><span
                                    class=" @if ($res_orders['confirmed'] >= 0) text-success @else text-danger @endif  mr-1"><i
                                        class="fe fe-arrow-up ml-1 "></i> {{ $res_orders['confirmed'] }}%</span> last
                                week</span></h2>
                    </div>
                </div>
                <div class="chart-wrapper overflow-hidden">
                    <span class="sparkline_confirm"></span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12">
            <div class="card overflow-hidden">
                <div class="card-body pb-0">
                    <div class="text-left mb-4">
                        <p class=" mb-1">
                            <i class="fa fa-exclamation-triangle mr-1"></i>
                            Declined Orders
                        </p>
                        <h2 class="mb-0 font-weight-bold">{{ end($orders['declined']) }}<span class="fs-12 text-muted"><span
                                    class=" @if ($res_orders['declined'] >= 0) text-success @else text-danger @endif  mr-1"><i
                                        class="fe fe-arrow-up ml-1 "></i> {{ $res_orders['declined'] }}%</span> last
                                week</span></h2>
                    </div>
                </div>
                <div class="chart-wrapper overflow-hidden">
                    <span class="sparkline_declined"></span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row-2 -->
    <div class="row">
        <div class="col-12">
            <div class="card" style="height:95.5%">
                <div class="card-header">
                    <div class="card-title">Clicks Analyse</div>
                </div>
                <div class="card-body">
                    <div class="morris-wrapper-demo" id="morrisLine1"></div>
                    <div class="text-center mt-2">
                        <span class="mr-4"><span class="dot-label" style="background-color:#9400D3 "></span>Store
                            Views</span>
                        <span class="mr-4"><span class="dot-label " style="background-color:#FF1493 "></span>Products
                            Views</span>
                        <span><span class="dot-label " style="background-color:#00BFFF "></span>Orders</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Row-3 -->
    <div class="row">
        <div class="col-xl-4 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Orders</h3>
                    <div class="card-options">
                        <a href="/admin/orders"><button class="btn btn-light btn-sm"> All Orders</button></a>
                    </div>
                </div>
                <div class="card-body">

                    @foreach ($orders_list as $order)
                        <a href="/admin/orders/details/{{ $order->id }}">
                            <div class="list-card hover_appino">
                                <span class="bg-warning list-bar"></span>
                                <div class="row align-items-center">
                                    <div class="col-9 col-sm-9">
                                        <div class="media mt-0">
                                            <img src="{{ url(env('PATH_PRODUCTS_TMB')) }}/{{ $order->products[0]->product->media[0]->media ?? '' }}"
                                                alt="img" class="avatar brround avatar-md mr-3">
                                            <div class="media-body">
                                                <div class="d-md-flex align-items-center mt-1">
                                                    <h6 class="mb-1">{{ $order->client->firstname }}
                                                        {{ $order->client->lastname }}</h6>
                                                </div>
                                                <span class="mb-0 fs-13 text-muted">
                                                    @if ($order->order_type == 'shipping')
                                                        <span
                                                            class="badge badge-primary badge-pill">{{ $order->order_type }}</span>
                                                    @else
                                                        <span class="badge badge-info badge-pill">{{ $order->order_type }}
                                                        </span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 col-sm-3">
                                        <div class="text-right">
                                            <span class="font-weight-semibold fs-16 number-font">{{ $order->total }}
                                                {{ $order->currency }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach


                </div>
            </div>
        </div>

        <div class="col-xl-4  col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between">
                        <div>
                            <p class=" mb-1 fs-14">Clients</p>
                            <h2 class="mb-0"><span class="number-font1">{{ $all_clients }}</span><span
                                    class="ml-2 text-muted fs-11"><span class="text-success"><i
                                            class="fa fa-caret-up"></i>
                                        {{ $this_month_clients }}</span> this month</span></h2>

                        </div>
                        <span class="text-primary fs-35 dash1-iocns bg-primary-transparent border-primary"><i
                                class="las la-users"></i></span>
                    </div>
                    <div class="d-flex mt-4">
                        <div>
                            <span class="text-muted fs-12 mr-1">Last Month</span>
                            <span class="number-font fs-12"><i
                                    class="fa fa-caret-up mr-1 text-success"></i>{{ $last_month_clients }}</span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between">
                        <div>
                            <p class=" mb-1 fs-14">Sales</p>
                            <h2 class="mb-0"><span class="number-font1">{{ $total_incum }}
                                    {{ $currency }}</span><span class="ml-2 text-muted fs-11"><span
                                        class="text-success"><i class="fa fa-caret-up"></i>
                                        {{ $today_incum }} {{ $currency }}</span> Today</span></h2>
                        </div>
                        <span class="text-secondary fs-35 dash1-iocns bg-secondary-transparent border-secondary"><i
                                class="las la-hand-holding-usd"></i></span>
                    </div>
                    <div class="d-flex mt-4">
                        <div>
                            <span class="text-muted fs-12 mr-1">Last Day</span>
                            <span class="number-font fs-12"><i
                                    class="fa fa-caret-up mr-1 text-success"></i>{{ $yesterday_incum }}
                                {{ $currency }}</span>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Row-3 -->

    <!--Row-->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Top Product Sales Overview</h3>
                    <div class="card-options">
                        <a href="" class="option-dots" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fe fe-more-horizontal fs-20"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="">Today</a>
                            <a class="dropdown-item" href="">Last Week</a>
                            <a class="dropdown-item" href="">Last Month</a>
                            <a class="dropdown-item" href="">Last Year</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter text-nowrap mb-0 table-striped table-bordered border-top">
                            <thead class="">
                                <tr>
                                    <th>Product</th>
                                    <th>Sold</th>
                                    <th>Likes</th>
                                    <th>Stock</th>
                                    <th>Amount</th>
                                    <th>Stock Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($top_products as $product)
                                    <tr>
                                        <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                                src="{{ url(env('PATH_PRODUCTS_TMB')) }}/{{ $product->product->media[0]->media ?? '' }}"
                                                alt="media1">
                                            {{ $product->product->title }}
                                        </td>
                                        <td><span class="badge badge-primary">{{ $product->orders }}</span></td>
                                        <td>05</td>
                                        <td>112</td>
                                        <td class="number-font">{{ $product->total }} {{ $currency }}</td>
                                        <td><i class="fa fa-check mr-1 text-success"></i> In Stock</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End row-->

    </div>
    </div>
    <!-- End app-content-->
    </div>
@endsection
@section('js')
    <!--INTERNAL Peitychart js-->
    {{-- <script src="{{URL::asset('assets/plugins/peitychart/jquery.peity.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/peitychart/peitychart.init.js')}}"></script>

<!--INTERNAL Apexchart js-->
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>

<!--INTERNAL ECharts js-->
<script src="{{URL::asset('assets/plugins/echarts/echarts.js')}}"></script>

<!--INTERNAL Chart js -->
<script src="{{URL::asset('assets/plugins/chart/chart.bundle.js')}}"></script>
<script src="{{URL::asset('assets/plugins/chart/utils.js')}}"></script>

<!-- INTERNAL Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>

<!--INTERNAL Moment js-->
<script src="{{URL::asset('assets/plugins/moment/moment.js')}}"></script>

<!--INTERNAL Index js-->
<script src="{{URL::asset('assets/js/index1.js')}}"></script> --}}

    <script src="{{ URL::asset('assets/plugins/morris/raphael-min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/morris/morris.js') }}"></script>

    <!-- INTERNAl Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- INTERNAl Chart js -->
    <script src="{{ URL::asset('assets/plugins/chart/chart.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/chart/chart.extension.js') }}"></script>

    <!-- INTERNAl Widgets js-->
    <script src="{{ URL::asset('assets/js/widgets.js') }}"></script>



    <script>
        $(document).ready(function() {

            var views = <?php echo json_encode($view_week); ?>;
            var weekdays = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];

            new Morris.Line({
                element: 'morrisLine1',
                data: Object.values(views),
                xkey: 'd',
                ykeys: ['store', 'product', 'orders'],
                xLabels: 'day',
                xLabelFormat: function(d) {
                    return weekdays[d.getDay()];
                },
                labels: ['Store', 'Products', 'Orders'],
                lineColors: ['#9400D3', '#FF1493', '#00BFFF'],
                lineWidth: 1,
                ymax: 'auto 10',
                gridTextSize: 11,
                hideHover: 'auto',
                resize: true
            });


            $(".sparkline_new").sparkline(<?php echo json_encode(array_values($orders['all'])); ?>, {
                type: 'bar',
                height: 50,
                width: 250,
                barWidth: 5,
                barSpacing: 7,
                colorMap: {
                    '9': '#a1a1a1'
                },
                barColor: '#45aaf2'
            });

            $(".sparkline_pending").sparkline(<?php echo json_encode(array_values($orders['pending'])); ?>, {
                type: 'bar',
                height: 50,
                width: 250,
                barWidth: 5,
                barSpacing: 7,
                colorMap: {
                    '9': '#a1a1a1'
                },
                barColor: '#705ec8'
            });

            $(".sparkline_confirm").sparkline(<?php echo json_encode(array_values($orders['confirmed'])); ?>, {
                type: 'bar',
                height: 50,
                width: 250,
                barWidth: 5,
                barSpacing: 7,
                colorMap: {
                    '9': '#a1a1a1'
                },
                barColor: '#2dce89'
            });
            $(".sparkline_declined").sparkline(<?php echo json_encode(array_values($orders['declined'])); ?>, {
                type: 'bar',
                height: 50,
                width: 250,
                barWidth: 5,
                barSpacing: 7,
                colorMap: {
                    '9': '#a1a1a1'
                },
                barColor: '#ef4b4b'
            });



        });
    </script>
@endsection
