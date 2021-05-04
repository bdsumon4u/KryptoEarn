<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="row second-chart-list third-news-update">
        <div class="col-xl-4 col-lg-12 xl-50 morning-sec box-col-12">
            <div class="card o-hidden profile-greeting">
                <div class="card-body">
                    <div class="media">
                        <div class="badge-groups w-100">
                            <div class="badge f-12"><i class="me-1" style="overflow: initial;" data-feather="clock"></i><span id="txt"></span></div>
                        </div>
                    </div>
                    <div class="greeting-user text-center">
                        <div class="profile-vector"><img class="img-fluid" src="{{ asset('cuba/assets/images/dashboard/welcome.png') }}" alt="Welcome"></div>
                        <h4 class="f-w-600"><span id="greeting">Good Morning</span> <span class="right-circle"><i class="fa fa-check-circle f-14 middle"></i></span></h4>
                        <p><span> Today's earrning is $405 & your sales increase rate is 3.7 over the last 24 hours</span></p>
                        <div class="whatsnew-btn"><a class="btn btn-primary">Whats New !</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 xl-100 dashboard-sec box-col-12">
            <div class="card earning-card">
                <div class="card-body p-0">
                    <div class="row m-0">
                        <div class="col-12 p-0">
                            <div class="chart-right">
                                <div class="row m-0 p-tb">
                                    <div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
                                        <div class="inner-top-left">
                                            <ul class="d-flex list-unstyled">
                                                <li>
                                                    <a class="btn btn-sm px-2 btn-{{ $tab == 'weekly' ? 'light' : 'default' }}" href="{{ route('dashboard', ['tab' => 'weekly']) }}">Weekly</a>
                                                </li>
                                                <li>
                                                    <a class="btn btn-sm px-2 btn-{{ $tab == 'monthly' ? 'light' : 'default' }}" href="{{ route('dashboard', ['tab' => 'monthly']) }}">Monthly</a>
                                                </li>
                                                <li>
                                                    <a class="btn btn-sm px-2 btn-{{ $tab == 'yearly' ? 'light' : 'default' }}" href="{{ route('dashboard', ['tab' => 'yearly']) }}">Yearly</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
                                        <div class="inner-top-right">
                                            <ul class="d-flex list-unstyled justify-content-end">
                                                <li>Deposit</li>
                                                <li>Withdraw</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card-body p-0">
                                            <div class="current-sale-container">
                                                {{ $transactionReport->container() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row border-top m-0">
                                <div class="col-xl-4 ps-0 col-md-6 col-sm-6">
                                    <div class="media p-0">
                                        <div class="media-left"><i class="icofont icofont-crown"></i></div>
                                        <div class="media-body">
                                            <h6>Deposit USD</h6>
                                            <p>${{ $credits }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 col-sm-6">
                                    <div class="media p-0">
                                        <div class="media-left bg-secondary"><i class="icofont icofont-heart-alt"></i></div>
                                        <div class="media-body">
                                            <h6>Withdraw USD</h6>
                                            <p>${{ $debits }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-12 pe-0">
                                    <div class="media p-0">
                                        <div class="media-left"><i class="icofont icofont-cur-dollar"></i></div>
                                        <div class="media-body">
                                            <h6>Remaining USD</h6>
                                            <p>${{ $remains }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="database"></i></div>
                        <div class="media-body"><span class="m-0">Earnings</span>
                            <h4 class="mb-0 counter">6659</h4><i class="icon-bg" data-feather="database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-secondary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                        <div class="media-body"><span class="m-0">Products</span>
                            <h4 class="mb-0 counter">9856</h4><i class="icon-bg" data-feather="shopping-bag"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="message-circle"></i></div>
                        <div class="media-body"><span class="m-0">Messages</span>
                            <h4 class="mb-0 counter">893</h4><i class="icon-bg" data-feather="message-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                        <div class="media-body"><span class="m-0">New User</span>
                            <h4 class="mb-0 counter">45631</h4><i class="icon-bg" data-feather="user-plus"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 xl-100 chart_data_left box-col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row m-0 chart-main">
                        <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                            <div class="media align-items-center">
                                <div class="hospital-small-chart">
                                    <div class="small-bar">
                                        <div class="small-chart flot-chart-container"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="right-chart-content">
                                        <h4>1001</h4><span>Purchase </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                            <div class="media align-items-center">
                                <div class="hospital-small-chart">
                                    <div class="small-bar">
                                        <div class="small-chart1 flot-chart-container"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="right-chart-content">
                                        <h4>1005</h4><span>Sales</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                            <div class="media align-items-center">
                                <div class="hospital-small-chart">
                                    <div class="small-bar">
                                        <div class="small-chart2 flot-chart-container"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="right-chart-content">
                                        <h4>100</h4><span>Sales return</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                            <div class="media border-none align-items-center">
                                <div class="hospital-small-chart">
                                    <div class="small-bar">
                                        <div class="small-chart3 flot-chart-container"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="right-chart-content">
                                        <h4>101</h4><span>Purchase ret</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 xl-50 chart_data_right box-col-12">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body right-chart-content">
                            <h4>$95,900<span class="new-box">Hot</span></h4><span>Purchase Order Value</span>
                        </div>
                        <div class="knob-block text-center">
                            <input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#7366ff" data-bgcolor="#eef5fb" value="60">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 xl-50 chart_data_right second d-none">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="media-body right-chart-content">
                            <h4>$95,000<span class="new-box">New</span></h4><span>Product Order Value</span>
                        </div>
                        <div class="knob-block text-center">
                            <input class="knob1" data-width="50" data-height="70" data-thickness=".3" data-fgcolor="#7366ff" data-linecap="round" data-angleoffset="0" value="60">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('cuba/assets/js/dashboard/default.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
        {!! $transactionReport->script() !!}
    @endpush
</x-admin-layout>
