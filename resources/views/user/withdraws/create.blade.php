<x-user-layout>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center" id="myTab">
                        <ul class="nav nav-tabs search-list" id="top-tab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="all-link" data-bs-toggle="tab" data-bs-target="#sectionA" role="tab" aria-selected="true">
                                    <i class="icon-target"></i>AUTO PROCESSORS
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="image-link" data-bs-toggle="tab" data-bs-target="#sectionB" role="tab" aria-selected="false">
                                    <i class="icon-pin"></i>LOCAL PROCESSORS
                                </button>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="video-link" href="/partners" aria-selected="false">
                                    <i class="icon-video-clapper"></i>VIA PARTNERS
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade active show" id="sectionA" role="tabpanel" aria-labelledby="all-link">
                            <div class="row">
                                <div class="col-xl-9 box-col-12">
                                    <x-validation-errors />
                                    <div class="row">
                                        <div class="col-md-4 col-lg-5 col-xs-12 col-sm-6">
                                            <div class="card border shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">PERFECT MONEY</h5>
                                                    <img class="img-responsive"
                                                         style="display: block; margin-left: auto; margin-right: auto; margin-bottom:10px"
                                                         src="{{ asset('cuba/user1/assets/images/gateway/perfect-money.png') }}"
                                                         height="100" width="100" alt="Card image cap">
                                                    @if($gateway['addresses']['perfect_money'])
                                                    <button
                                                        data-bs-toggle="modal" data-bs-target="#depositModal102"
                                                        class="w-100 btn btn-success"
                                                    >SELECT</button>
                                                    @else
                                                        <a
                                                            class="btn btn-info w-100"
                                                            href="/wallet"
                                                        >SET ACCOUNT</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-5 col-xs-12 col-sm-6">
                                            <div class="card border shadow-sm">
                                                <div class="card-body"><h5 class="card-title text-center">BITCOIN</h5>
                                                    <img class="img-responsive"
                                                         style="display: block; margin-left: auto; margin-right: auto; margin-bottom:10px"
                                                         src="{{ asset('cuba/user1/assets/images/gateway/blockchain.png') }}"
                                                         height="100" width="100" alt="Card image cap">
                                                    @if($gateway['addresses']['bitcoin'])
                                                        <button
                                                            data-bs-toggle="modal" data-bs-target="#depositModal105"
                                                            class="w-100 btn btn-success"
                                                        >SELECT</button>
                                                    @else
                                                        <a
                                                            class="btn btn-info w-100"
                                                            href="/wallet"
                                                        >SET ACCOUNT</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-lg-5 col-xs-12 col-sm-6">
                                            <div class="card border shadow-sm">
                                                <div class="card-body"><h5 class="card-title text-center">PAYEER</h5>
                                                    <img class="img-responsive"
                                                         style="display: block; margin-left: auto; margin-right: auto; margin-bottom:10px"
                                                         src="{{ asset('cuba/user1/assets/images/gateway/payeer.png') }}"
                                                         height="100" width="100" alt="Card image cap">
                                                    @if($gateway['addresses']['payeer'])
                                                    <button
                                                        data-bs-toggle="modal" data-bs-target="#depositModal515"
                                                        class="w-100 btn btn-success"
                                                    >SELECT</button>
                                                    @else
                                                        <a
                                                            class="btn btn-info w-100"
                                                            href="/wallet"
                                                        >SET ACCOUNT</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 box-col-12 mt-4">
                                    <div class="info-block"><h6>How to withdraw</h6>
                                        <ol>
                                            <li> Choose your preferred gateway e.g BTC.</li>
                                            <li> Enter the exact amount that you want to withdraw.</li>
                                            <li> Enter your address and confirm</li>
                                            <li> Depending on the method, it will take 0-30 minutes.</li>
                                        </ol>
                                        <div class="star-ratings text-warning">
                                            <ul class="search-info">
                                                <li><i class="icofont icofont-ui-rating"></i><i
                                                        class="icofont icofont-ui-rating"></i><i
                                                        class="icofont icofont-ui-rating"></i><i
                                                        class="icofont icofont-ui-rate-blank"></i><i
                                                        class="icofont icofont-ui-rate-blank"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sectionB" role="tabpanel" aria-labelledby="image-link">
                            <div class="search-links tab-pane fade show active" id="all-links" role="tabpanel"
                                 aria-labelledby="all-link">
                                <div class="row">
                                    <div class="col-xl-10 box-col-12">
                                        <div class="row">
                                            <div class="col-sm-1 col-md-3 col-lg-3 col-xl-4 "></div>
                                            <div class="col-sm-10 col-md-6 col-lg-6 col-xl-6">
                                                <div class="info-block">
                                                    <div class="alert alert-danger outline-2x" role="alert"> We do not
                                                        currently have an active gateway for your country. !
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 box-col-12 mt-4">
                                        <div class="info-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sectionC" role="tabpanel" aria-labelledby="video-link">
                            <div class="row">
                                <div class="col-xl-12"><h6 class="mb-2"> 0 partner processors
                                        found</h6></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="depositModal102" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Withdraw via <strong>PERFECT MONEY</strong></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post" action="{{ route('withdraws.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="automatic" value="automatic">
                        <label class="col-md-12 modal-msg-heading">
                            <strong>WITHDRAWAL AMOUNT</strong><br>
                            <span class="modal-msg">
                                ${{ config('gateway.withdraw.perfect_money.min_amount') }} - ${{ config('gateway.withdraw.perfect_money.max_amount') }} <br>
                                <strong> CHARGES </strong><br>
                                ${{ config('gateway.withdraw.perfect_money.fixed_charge') }} USD + {{ config('gateway.withdraw.perfect_money.percent_charge') }}% <br>
                                <strong> EARNING BALANCE </strong><br>
                                USD : {{ $user->earningPocket()->balanceFloat }}<br>
                                <strong> PERFECT MONEY ACCOUNT </strong><br>
                                <u> {{ $gateway['addresses']['perfect_money'] }} </u>
                            </span>
                        </label>
                        <hr>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text"
                                       id="amount_check102"
                                       name="amount"
                                       class="form-control input-lg"
                                       placeholder=" Enter Amount"
                                       required="">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">USD</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" name="password"
                                       class="form-control input-lg"
                                       id="password"
                                       placeholder=" Enter Your Password"
                                       required="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="gateway" value="perfect-money" class="btn btn-success w-100">
                            WITHDRAW NOW
                        </button>
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="depositModal505" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Withdraw via <strong>BITCOIN</strong></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post" action="{{ route('withdraws.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="automatic" value="automatic">
                        <label class="col-md-12 modal-msg-heading">
                            <strong>WITHDRAWAL AMOUNT</strong><br>
                            <span class="modal-msg">
                                ${{ config('gateway.withdraw.bitcoin.min_amount') }} - ${{ config('gateway.withdraw.bitcoin.max_amount') }} <br>
                                <strong> CHARGES </strong><br>
                                ${{ config('gateway.withdraw.bitcoin.fixed_charge') }} USD + {{ config('gateway.withdraw.bitcoin.percent_charge') }}% <br>
                                <strong> EARNING BALANCE </strong><br>
                                USD : {{ $user->earningPocket()->balanceFloat }}<br>
                                <strong> BITCOIN ADDRESS </strong><br>
                                <u> {{ $gateway['addresses']['bitcoin'] }} </u>
                            </span>
                        </label>
                        <hr>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text"
                                       id="amount_check102"
                                       name="amount"
                                       class="form-control input-lg"
                                       placeholder=" Enter Amount"
                                       required="">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">USD</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" name="password"
                                       class="form-control input-lg"
                                       id="password"
                                       placeholder=" Enter Your Password"
                                       required="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="gateway" value="blockchain" class="btn btn-success w-100">
                            WITHDRAW NOW
                        </button>
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="depositModal515" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Withdraw via <strong>PAYEER</strong></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post" action="{{ route('withdraws.store') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="automatic" value="automatic">
                        <label class="col-md-12 modal-msg-heading">
                            <strong>WITHDRAWAL AMOUNT</strong><br>
                            <span class="modal-msg">
                                ${{ config('gateway.withdraw.payeer.min_amount') }} - ${{ config('gateway.withdraw.payeer.max_amount') }} <br>
                                <strong> CHARGES </strong><br>
                                ${{ config('gateway.withdraw.payeer.fixed_charge') }} USD + {{ config('gateway.withdraw.payeer.percent_charge') }}% <br>
                                <strong> EARNING BALANCE </strong><br>
                                USD : {{ $user->earningPocket()->balanceFloat }}<br>
                                <strong> PAYEER ACCOUNT </strong><br>
                                <u> {{ $gateway['addresses']['payeer'] }} </u>
                            </span>
                        </label>
                        <hr>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text"
                                       id="amount_check102"
                                       name="amount"
                                       class="form-control input-lg"
                                       placeholder=" Enter Amount"
                                       required="">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">USD</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="password" name="password"
                                       class="form-control input-lg"
                                       id="password"
                                       placeholder=" Enter Your Password"
                                       required="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="gateway" value="payeer" class="btn btn-success w-100">
                            WITHDRAW NOW
                        </button>
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-user-layout>
