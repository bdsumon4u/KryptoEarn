<x-user-layout>
    <div class="row second-chart-list third-news-update">
        <x-pocket-balances :user="$user" />
        <div class="col-xl-12 xl-100 chart_data_left box-col-12">
            <div class="card">
                <div class="card-body">
                    <h6>MY ADDRESSES: </h6>
                    For security, withdrawals are disabled for 1 days after address change.
                    <p>Last Updated At: <strong>{{ \Carbon\Carbon::parse($gateway['updated_at'])->format('d-M-Y -- H:i A') }}</strong></p>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form id="gateway-form" action="{{ route('gateway') }}" method="POST" autocomplete="OFF" action="">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">PERFECT MONEY</label>
                                        <div class="col-sm-8">
                                            <input name="perfect_money" id="102" value="{{ old('perfect_money', $gateway['addresses']['perfect_money']) }}" class="form-control" type="text">
                                            <div style="color:red;" class="danger" id="nameError102"></div>
                                        </div>
                                        <div class="col-sm-2 col-form-label">
                                            <button class="btn btn-primary" type="submit">SAVE</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">BITCOIN</label>
                                        <div class="col-sm-8">
                                            <input name="bitcoin" id="bitcoin-address" value="{{ old('bitcoin' , $gateway['addresses']['bitcoin']) }}" class="form-control" type="text">
                                            <div style="color:red;" class="danger" id="nameError505"></div>
                                        </div>
                                        <div class="col-sm-2 col-form-label">
                                            <button class="btn btn-primary" type="submit">SAVE</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">PAYEER</label>
                                        <div class="col-sm-8">
                                            <input name="payeer" id="515" value="{{ old('payeer', $gateway['addresses']['payeer']) }}" class="form-control" type="text">
                                            <div style="color:red;" class="danger" id="nameError515"></div>
                                        </div>
                                        <div class="col-sm-2 col-form-label">
                                            <button class="btn btn-primary" type="submit">SAVE</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-12 box-col-12">
            <div class="row">
                <div class="col-sm-4 col-xl-4 col-lg-4 box-col-6">
                    <div class="card social-widget-card">
                        <div class="card-body" style="text-align: center; ">
                            <img style="margin:10px;" class="img-fluid" src="{{ asset('cuba/user1/assets/images/others/atm.png') }}" alt=" da">
                            <!-- <i class="fa fa-cloud-download fa-5x"></i> --><br>
                            <a
                                href="/withdraws/create"
                                class=" b-b-light btn btn-secondary btn-sm text-center"> WITHDRAW
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xl-4 col-lg-4 box-col-6">
                    <div class="card social-widget-card">
                        <div class="card-body" style="text-align: center; ">
                            <!-- <i class="fa fa-cloud-upload fa-5x"></i> -->
                            <img style="margin:10px;" class="img-fluid" src="{{ asset('cuba/user1/assets/images/others/upload.png') }}" alt=" da"><br>
                            <a
                                href="/deposits/create"
                                class=" b-b-light btn btn-secondary btn-sm text-center"> DEPOSIT
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xl-4 col-lg-4 box-col-6">
                    <div class="card social-widget-card">
                        <div class="card-body" style="text-align: center; ">
                            <img style="margin:10px;" class="img-fluid" src="{{ asset('cuba/user1/assets/images/others/money-transfer.png') }}" alt=" da"><br>
                            <a
                                href="/wallet/transfer"
                                class=" b-b-light btn btn-secondary btn-sm text-center"> TRANSFER
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-12 box-col-12">
            <div class="card">
                <div class="card-body"><h5> Wallet Logs </h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th style="width:35%" scope="col">Transaction</th>
                                <th scope="col">Action</th>
                                <th scope="col">Wallet Account</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <th scope="row">{{ $transaction->id }}</th>
                                <td>{{ $transaction->meta['name'] }}</td>
                                <td>{{ $transaction->type === 'deposit' ? '+' : '-' }}</td>
                                <td>{{ strtoupper(str_replace('-', ' ', $transaction->wallet->name)) }}</td>
                                <td>${{ round($transaction->amountFloat, 2) }}</td>
                                <td>{{ $transaction->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/wallet-address-validator@0.2.4/dist/wallet-address-validator.min.js"></script>
        <script type="text/javascript">
            document.getElementById('gateway-form').addEventListener('submit', function (ev) {
                ev.preventDefault();
                var btc_address = $("#bitcoin-address").val();

                if (!btc_address.length) {
                    document.getElementById("gateway-form").submit();
                    return true;
                }

                var valid = WAValidator.validate(btc_address, 'BitCoin');
                if (!valid) {
                    $("#nameError505").html("Invalid Bitcoin address!");
                } else {
                    document.getElementById("gateway-form").submit();
                    return true;
                }
            });
        </script>
    @endpush
</x-user-layout>
