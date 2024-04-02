@extends('admin.layouts.master')
@section('css')
    <style>
        #notifications {
            cursor: pointer;
            position: fixed;
            right: 0px;
            z-index: 9999;
            bottom: 0px;
            margin-bottom: 22px;
            margin-right: 15px;
            max-width: 300px;
            text-align: center;
            border-radius: 10px;
        }
    </style>
@endsection
@section('page-header')
    <!--Page header-->
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title mb-0">Dashboard</h4>
        </div>
    </div>
    <!--End Page header-->
@endsection
@section('content')
    <div id="notifications"></div>

    <div class="row">

        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12" style="padding: 0">

            <div class="card overflow-hidden">
                <div class="card-header">
                    <h3 class="card-title">My Apps</h3>
                </div>
                <div class="card-body pb-0" style="padding: 0">
                    @foreach ($apks as $cat)
                        <a href="/admin/cat_change/{{ $cat->id }}">
                            <div class="d-flex ml-2 mt-5 mb-3"
                                @if (session()->get('cat') == $cat->id) style="background-color: #dae0ff;
					border-top-left-radius: 20px;
					border-bottom-left-radius: 20px;cursor:pointer;border-right: 3px solid blue;"
					@else
					style="background-color: #dae0ff;
					border-top-left-radius: 20px;
					border-bottom-left-radius: 20px;cursor:pointer" @endif>
                                <span class="avatar brround avatar-md d-block"
                                    style="background-image: url({{ url('storage/apks/') }}/{{ $cat->image }})"></span>
                                <div class="ml-3 mt-1">
                                    <h6 class="mb-0 font-weight-bold">{{ $cat->title }}</h6>
                                    <small class=""> Wallpappers : {{ $cat->wallpapper_count }}</small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="chart-wrapper overflow-hidden">
                </div>
            </div>
        </div>
        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">

            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <div class="card overflow-hidden">
                        <div class="card-body pb-0">
                            <div class="text-left mb-4">
                                <p class=" mb-1 ">
                                    <i class="fa fa-user mr-1"></i>
                                    Total Users
                                </p>
                                <h2 class="mb-0 font-weight-bold">{{ $total_users }}<span class="fs-12 text-muted">
                                        @if ($users_pregress < 0)
                                            <span class="text-danger mr-1"><i class="fe fe-arrow-down ml-1 "></i>
                                                {{ $users_pregress }}%</span> last month
                                    </span>
                                @else
                                    <span class="text-success mr-1"><i class="fe fe-arrow-up ml-1 "></i>
                                        {{ $users_pregress }}%</span> last month</span>
                                    @endif
                                </h2>
                            </div>
                        </div>
                        <div class="chart-wrapper overflow-hidden">
                            <span class="sparkline_bar13"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <div class="card overflow-hidden">
                        <div class="card-body pb-0">
                            <div class="text-left mb-4">
                                <p class=" mb-1 ">
                                    <i class="fa fa-eye mr-1"></i>
                                    Total Views
                                </p>
                                <h2 class="mb-0 font-weight-bold">{{ $total_views }}<span class="fs-12 text-muted">
                                        @if ($views_pregress < 0)
                                            <span class="text-danger mr-1"><i class="fe fe-arrow-down ml-1 "></i>
                                                {{ $views_pregress }}%</span> last month
                                    </span>
                                @else
                                    <span class="text-success mr-1"><i class="fe fe-arrow-up ml-1 "></i>
                                        {{ $views_pregress }}%</span> last month</span>
                                    @endif
                                </h2>
                            </div>
                        </div>
                        <div class="chart-wrapper overflow-hidden">
                            <span class="analyse_views"></span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ///////////////////////////////////////////////////////////////////////////////? --}}
            <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-12">
                    <div class="card" style="height:95.5%">
                        <div class="card-header">
                            <div class="card-title">Clicks Analyse</div>
                        </div>
                        <div class="card-body">
                            <div class="morris-wrapper-demo" id="morrisLine1"></div>
                            <div class="text-center mt-2">
                                <span class="mr-4"><span class="dot-label" style="background-color:#9400D3 "></span>Store
                                    Clicks</span>
                                <span class="mr-4"><span class="dot-label " style="background-color:#FF1493 "></span>Posts
                                    Clicks</span>
                                <span><span class="dot-label " style="background-color:#00BFFF "></span>Courses
                                    Clicks</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-12">
                    
                   
                 
                </div>
            </div>

            {{-- ////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Wallpapper apk_users Analysis</h3>
                            <div class="card-options">
                                <div class="btn-group p-0">
                                    <button id="read1" class="btn btn-light  btn-sm" onclick="getapk_usersData(7)"
                                        type="button">Week</button>
                                    <button id="read2" class="btn btn-outline-light btn-sm"
                                        onclick="getapk_usersData(30)" type="button">Month</button>
                                    <button id="read3" class="btn btn-outline-light btn-sm"
                                        onclick="getapk_usersData(360)" type="button">Year</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-xl-3 col-6 mb-3">
                                    <p class="mb-1">
                                        <i class="fa fa-user-plus mr-1"></i>
                                        Total apk_users
                                    </p>
                                    <h3 class="mb-0  number-font">{{ $total_apk_users }}
                                        @if ($apk_users_pregress < 0)
                                            <span class="text-danger mr-1 fs-12 "><i class="fe fe-arrow-down ml-1 "></i>
                                                {{ $apk_users_pregress }}%</span></span>
                                        @else
                                            <span class="text-success mr-1 fs-12 "><i class="fe fe-arrow-up ml-1 "></i>
                                                {{ $apk_users_pregress }}%</span></span>
                                        @endif
                                    </h3>
                                </div>
                                {{-- <div class="col-xl-3 col-6 ">
															<p class=" mb-1">Maximum Sales</p>
															<h3 class="mb-0 fs-20 number-font1">$26,197</h3>
															<p class="fs-12 text-muted"><span class="text-success mr-1"><i class="fe fe-arrow-up"></i>0.15%</span>this month</p>
														</div>
														<div class="col-xl-3 col-6">
															<p class=" mb-1">Total Units Sold</p>
															<h3 class="mb-0 fs-20 number-font1">13,876</h3>
															<p class="fs-12 text-muted"><span class="text-danger mr-1"><i class="fe fe-arrow-down"></i>0.8%</span>this month</p>
														</div>
														<div class="col-xl-3 col-6">
															<p class=" mb-1">Maximum Units Sold</p>
															<h3 class="mb-0 fs-20 number-font1">5,876</h3>
															<p class="fs-12 text-muted"><span class="text-success mr-1"><i class="fe fe-arrow-up"></i>0.06%</span>this month</p>
														</div> --}}
                            </div>
                            <div id="echart1" class="chart-tasks chart-dropshadow text-center"></div>
                            <div class="text-center mt-2">
                                <span class="mr-4"><span class="dot-label bg-primary"></span>Total Sales</span>
                                <span><span class="dot-label bg-secondary"></span>Total Units Sold</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Activity</h3>

                        </div>
                        <div class="card-body" style="overflow: auto">
                            <div class="latest-timeline scrollbar3" id="scrollbar3">
                                <ul class="timeline mb-0">
                                    @foreach ($activities as $activity)
                                        <li>
                                            <div class="d-flex "
                                                @if ($activity->type == 'new_apk_user') style="color:#966dff" @endif>
                                                {{ $activity->notification }} :</div>
                                            <p class="text-muted fs-12 mb-0">{{ $activity->content }}</p>
                                            <p class="text-muted fs-12 mb-0">in {{ $activity->app }}</p>
                                            <p class="text-muted fs-12 mb-0">at
                                                {{ $activity->created_at->format('y-m-d h:m') }}</p>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row-2 -->


            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Top Wallpappers Overview</h3>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table
                                    class="table table-vcenter text-nowrap mb-0 table-striped table-bordered border-top">
                                    <thead class="">
                                        <tr>
                                            <th>image</th>
                                            <th>Wallpapper</th>
                                            <th>apk_users</th>
                                            <th>Wallpapper Preview</th>
                                            <th>Wallpapper is finish</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wallpappers as $wallpapper)
                                            <tr>
                                                <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                                        src="{{ url('storage/images/') }}/{{ $wallpapper->image }}"
                                                        alt="Wallpapper"></td>
                                                <td>{{ $wallpapper->title }}</td>
                                                <td class="number-font">{{ $wallpapper->r_nbr }}</td>
                                                <td>{{ $wallpapper->f_nbr }}</td>
                                                <td>{{ $wallpapper->preview_n }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Row-->


        </div>
    </div>



    <!--End row-->
@endsection
@section('js')
    <script src="{{ URL::asset('assets/plugins/morris/raphael-min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/morris/morris.js') }}"></script>
    <script src="{{ URL::asset('assets/js/Notify.js') }}"></script>

    @php $notes = App\Http\Controllers\Admin\NotificationController::getall(); @endphp

    <script>
         var array = {
        apk_user:['fa fa-user-plus', 'background-color:#93ffbe'],
        requist:['fa fa-Wallpapper','background-color:#b6e4fa'],
    };
        var notes = <?php echo json_encode($notes); ?>;
        notes.forEach(pushNot);
        console.log(array);
        function pushNot(note) {
            if (note['iduser'] == null) {
                Notify(note['message'], null, null, array[note['type']][1],array[note['type']][0]);

            }
        }

        var spn = "<span class='pulse'></span>";
        document.getElementById('notea').innerHTML += spn;
    </script>

    {{-- <script src="{{ URL::asset('assets/js/morris.js') }}"></script> --}}
    <script>
        var clicks = <?php echo json_encode($click_week); ?>;
        var weekdays = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];

        new Morris.Line({
            element: 'morrisLine1',
            data: Object.values(clicks),
            xkey: 'd',
            ykeys: ['store', 'post', 'course'],
            xLabels: 'day',
            xLabelFormat: function(d) {
                return weekdays[d.getDay()];
            },
            labels: ['Store', 'Posts', 'Courses'],
            lineColors: ['#9400D3', '#FF1493', '#00BFFF'],
            lineWidth: 1,
            ymax: 'auto 10',
            gridTextSize: 11,
            hideHover: 'auto',
            resize: true
        });


        $(".sparkline_bar13").sparkline(<?php echo json_encode($user_day); ?>, {
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


        $(".analyse_views").sparkline(<?php echo json_encode($view_day); ?>, {
            type: 'bar',
            height: 50,
            width: 250,
            barWidth: 5,
            barSpacing: 7,
            colorMap: {
                '9': '#a1a1a1'
            },
            barColor: 'blue'
        });


        ///////////////////////////////////
        apk_usersShart();

        function apk_usersShart(data_keys = <?php echo json_encode(array_keys($apk_users1)); ?>, data_values = <?php echo json_encode(array_values($apk_users1)); ?>) {
            var chartdata = [{
                    name: 'Total Wallpapper Preview',
                    type: 'line',
                    smooth: true,
                    data: data_values,
                    itemStyle: {
                        normal: {
                            barBorderRadius: [50, 50, 0, 0],
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1, [{
                                        offset: 0,
                                        color: '#fd6f82'
                                    },
                                    {
                                        offset: 1,
                                        color: '#fb1c52'
                                    }
                                ]
                            )
                        }
                    },
                },
                {
                    name: 'Total apk_users',
                    symbolSize: 20,
                    barWidth: 20,
                    type: 'bar',
                    data: data_values,
                    itemStyle: {
                        normal: {
                            barBorderRadius: [50, 50, 0, 0],
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1, [{
                                        offset: 0,
                                        color: '#705ec8'
                                    },
                                    {
                                        offset: 1,
                                        color: '#20c2fa'
                                    }

                                ]
                            )
                        }
                    },
                }
            ];
            var chart = document.getElementById('echart1');
            var barChart = echarts.init(chart);
            var option = {
                grid: {
                    top: '6',
                    right: '0',
                    bottom: '17',
                    left: '25',
                },
                xAxis: {
                    data: data_keys,
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(67, 87, 133, .09)'
                        }
                    },
                    axisLabel: {
                        fontSize: 10,
                        color: '#8e9cad'
                    }
                },
                tooltip: {
                    show: true,
                    showContent: true,
                    alwaysShowContent: true,
                    triggerOn: 'mousemove',
                    trigger: 'axis',
                    axisPointer: {
                        label: {
                            show: false,
                        }
                    }

                },
                yAxis: {
                    splitLine: {
                        lineStyle: {
                            color: 'rgba(67, 87, 133, .09)'
                        }
                    },
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(67, 87, 133, .09)'
                        }
                    },
                    axisLabel: {
                        fontSize: 10,
                        color: '#8e9cad'
                    }
                },
                series: chartdata,
                color: ['#ef6430', '#2205bf']
            };
            barChart.setOption(option);
            /* E-chart */
        }

        function getapk_usersData(date) {

            if (date == 7) {
                $('#read1').removeClass('btn-outline-light');
                $('#read1').addClass('btn-light');

                $('#read2').addClass('btn-outline-light');
                $('#read2').removeClass('btn-light');

                $('#read3').addClass('btn-outline-light');
                $('#read3').removeClass('btn-light');

            } else if (date == 30) {
                $('#read2').removeClass('btn-outline-light');
                $('#read2').addClass('btn-light');

                $('#read1').addClass('btn-outline-light');
                $('#read1').removeClass('btn-light');

                $('#read3').addClass('btn-outline-light');
                $('#read3').removeClass('btn-light');
            } else {
                $('#read3').removeClass('btn-outline-light');
                $('#read3').addClass('btn-light');

                $('#read2').addClass('btn-outline-light');
                $('#read2').removeClass('btn-light');

                $('#read1').addClass('btn-outline-light');
                $('#read1').removeClass('btn-light');
            }
            $.ajax({
                type: 'POST',
                url: '/admin/getapk_usersData',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'date': date
                },
                success: function(data) {
                    apk_usersShart(data["apk_users_key"], data["apk_users_value"])
                }
            });
        }
    </script>
@endsection
