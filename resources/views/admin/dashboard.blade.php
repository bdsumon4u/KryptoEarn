<x-admin-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="row second-chart-list third-news-update">
        <div class="col-xl-4 col-lg-12 xl-50 morning-sec box-col-12">
            <h5>Totals:</h5>
            <div class="row">
                <div class="col-12">
                    <div class="card o-hidden">
                        <div class="bg-secondary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                                <div class="media-body"><span class="m-0">Deposits</span>
                                    <h4 class="mb-0 counter">${{ $total_deposits }}</h4><i class="icon-bg" data-feather="shopping-bag"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="message-circle"></i></div>
                                <div class="media-body"><span class="m-0">Withdraws</span>
                                    <h4 class="mb-0 counter">${{ $total_withdraws }}</h4><i class="icon-bg" data-feather="message-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                                <div class="media-body"><span class="m-0">Total Users</span>
                                    <h4 class="mb-0 counter">{{ $total_users }}</h4><i class="icon-bg" data-feather="user-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card o-hidden">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="database"></i></div>
                                <div class="media-body"><span class="m-0">Premium Users</span>
                                    <h4 class="mb-0 counter">{{ $premium_users }}</h4><i class="icon-bg" data-feather="database"></i>
                                </div>
                            </div>
                        </div>
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
    </div>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
        {!! $transactionReport->script() !!}
    @endpush
</x-admin-layout>
