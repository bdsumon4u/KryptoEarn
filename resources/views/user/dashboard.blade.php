<x-user-layout>
    @push('styles')
        <style>
            #maincontainer {
                width:100%;
                height: 100%;
            }
            #leftcolumn {
                float:left;
                display:inline-block;
                width: 100px;
                height: 100%;
            }
            #contentwrapper {
                float:left;
                display:inline-block;
                width: -moz-calc(100% - 100px);
                width: -webkit-calc(100% - 100px);
                width: calc(100% - 100px);
                height: 100%;
            }
        </style>
    @endpush
    <x-slot name="header">Dashboard</x-slot>
    <div class="row ">
        <x-pocket-balances :user="$user" />
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-primary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <i data-feather="activity"></i>
                        </div>
                        <div class="media-body">
                            <a class="btn btn-block btn-success btn-air-success btn-lg mr-3 wow pulse" href="/tasks">Earn</a>
                            <i class="icon-bg" data-feather="activity"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-secondary b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <i data-feather="arrow-up-circle"></i>
                        </div>
                        <div class="media-body">
                            <a class="btn btn-primary btn-air-primary btn-lg mr-3 wow pulse" href="/plans">Upgrade</a>
                            <i class="icon-bg" data-feather="arrow-up-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-success b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <i data-feather="upload"></i>
                        </div>
                        <div class="media-body">
                            <a class="btn btn-block btn-info btn-air-info btn-lg mr-3 wow pulse" href="/deposits/create">Deposit</a>
                            <i class="icon-bg" data-feather="upload"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3 col-lg-6">
            <div class="card o-hidden">
                <div class="bg-info b-r-4 card-body">
                    <div class="media static-top-widget">
                        <div class="align-self-center text-center">
                            <i data-feather="download"></i>
                        </div>
                        <div class="media-body">
                            <a class="btn btn-block btn-secondary btn-air-secondary btn-lg mr-3 wow pulse" href="/withdraws/create">Withdraw</a>
                            <i class="icon-bg" data-feather="download"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 xl-100 chart_data_left box-col-12">
            <div class="card">
                <div class="card-body">
                    <div class="body-bottom">
                        <h6>MY REFFERAL LINK:</h6>
                        <input style="margin-bottom:5px;"
                               value="{{ route('register', ['ref' => request()->user()->username]) }}"
                               class="form-control" readonly=""
                               id="clipboardExample1" type="text" />
                        <div class="row">
                            <div>
                                <div id="maincontainer">
                                    <div id="leftcolumn">
                                        <button class="btn btn-sm btn-primary btn-clipboard" type="button"
                                                data-clipboard-action="copy" data-clipboard-target="#clipboardExample1">
                                            <i class="fa fa-copy"></i>Copy
                                        </button>
                                    </div>
                                    <div id="contentwrapper">
                                        <!-- AddToAny BEGIN -->
                                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                            <a class="a2a_button_facebook"></a>
                                            <a class="a2a_button_twitter"></a>
                                            <a class="a2a_button_email"></a>
                                            <a class="a2a_button_pinterest"></a>
                                            <a class="a2a_button_linkedin"></a>
                                            <a class="a2a_button_reddit"></a>
                                            <a class="a2a_button_google_gmail"></a>
                                            <a class="a2a_button_whatsapp"></a>
                                            <a class="a2a_button_telegram"></a>
                                        </div>
                                        <script async src="https://static.addtoany.com/menu/page.js"></script>
                                        <!-- AddToAny END -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top:5px;" class="row">
                            <div class="col-12">
                                @php($valid_till = request()->user()->valid_till)
                                <div class="alert alert-sm alert-{{ $valid_till->isFuture() ? 'primary' : 'danger' }} dark alert-dismissible fade show" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-clock">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    @if($valid_till->isFuture())
                                        <p>Your Plan Will Be Expired On <strong>{{ $valid_till->formatted('d-M-Y H:i A') }}</strong>.</p>
                                    @else
                                        <p>Your Plan is Expired! Please Upgrade To Continue.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6 box-col-6">
            <div class="card">
                <div class="card-body">
                    <h5>Direct Referrals - {{ $referral_count }}</h5>
                    <!-- Chart's container -->
                    <div>
                        {!! $directReferrals->container() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6 box-col-6">
            <div class="card">
                <div class="card-body">
                    <h5> Wallet Report </h5>
                    <!-- Chart's container -->
                    <div>
                        {!! $walletReport->container() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6 box-col-6">
            <x-balance-log :user="$user" />
        </div>
        <div class="col-sm-12 col-xl-6 box-col-6">
            <div class="card">
                <div class="card-body">
                    <h5>Balances Division <span class="badge badge-pill badge-secondary"> USD </span></h5>
                    <!-- Chart's container -->
                    <div>
                        {!! $balanceDivision->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('cuba/user1/assets/js/clipboard/clipboard.js') }}"></script>
        <script src="{{ asset('cuba/user1/assets/js/clipboard/clipboard-script.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
        {!! $directReferrals->script() !!}
        {!! $walletReport->script() !!}
        {!! $balanceDivision->script() !!}
    @endpush
</x-user-layout>
