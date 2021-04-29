<x-user-layout>
    @push('styles')
        @livewireStyles
    @endpush
    <div class="row second-chart-list third-news-update">
        <x-pocket-balances :user="$user"/>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center" id="myTab">
                        <ul class="nav nav-tabs search-list" id="top-tab" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="all-link" data-bs-toggle="tab" data-bs-target="#sectionA" role="tab" aria-selected="true">
                                    <i class="icon-target"></i>Wallet To Wallet
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" id="image-link" data-bs-toggle="tab" data-bs-target="#sectionB" role="tab" aria-selected="false">
                                    <i class="icon-pin"></i>User To User
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade active show" id="sectionA" role="tabpanel" aria-labelledby="all-link">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 offset-md-3">
                                    <div class="info-block">
                                        <div class="text-center"></div>
                                        <div class="container">
                                            <livewire:user.wallet-to-wallet-transfer />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sectionB" role="tabpanel" aria-labelledby="image-link">
                            <div class="search-links tab-pane fade show active" id="all-links" role="tabpanel"
                                 aria-labelledby="all-link">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 offset-md-3">
                                        <div class="info-block">
                                            <div class="text-center"></div>
                                            <div class="container">
                                                <div class="form"><h6>Enter the details</h6>
                                                    <form method="POST"
                                                          action="https://entrycaptcha.com/user/wallet/transfer"
                                                          accept-charset="UTF-8"
                                                          class="theme-form needs-validation"
                                                          autocomplete="off" novalidate=""><input
                                                            name="_token" type="hidden"
                                                            value="gHl39DyQcdNcqKxR5uywKT8TCk38yVQgR17nX1mc">
                                                        <div class="mb-3"><label
                                                                class="col-form-label">Select Source
                                                                Wallet</label><select
                                                                onchange="getval(this);"
                                                                class="form-control"
                                                                name="sender_wallet"
                                                                id="exampleFormControlSelect9">
                                                                <option value="1"> Main balance</option>
                                                                <option value="2"> Purchases balance
                                                                </option>
                                                                <option value="4"> Commision balance
                                                                </option>
                                                            </select></div>
                                                        <img class="d-block mx-auto"
                                                             src="{{ asset('cuba/user1/assets/images/down-arrow.png') }}">
                                                        <div class="mb-3">
                                                            <!-- <label class=col-form-label>To</label> --><select
                                                                class="form-control"
                                                                name="receiver_wallet"
                                                                id="toselect"></select></div>
                                                        <div class="mb-3"><label
                                                                class="col-form-label">Enter
                                                                Amount</label><input type="hidden"
                                                                                     name="form_number"
                                                                                     value="1"><input
                                                                class="form-control" value=""
                                                                required="" name="amount" type="text">
                                                        </div>
                                                        <button name="redeem"
                                                                class="btn btn-primary btn-block"
                                                                type="submit">Transfer
                                                        </button>
                                                    </form>
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
        </div>
    </div>
    @push('scripts')
        @livewireScripts
    @endpush
</x-user-layout>
