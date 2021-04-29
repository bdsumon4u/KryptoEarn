<div class="col-xl-12 xl-100 chart_data_left box-col-12">
    <div class="card">
        <div class="card-body p-0">
            <div class="row m-0 chart-main">
                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                    <div class="media align-items-center">
                        <div class=""><img src="https://entrycaptcha.com/images/money.png">
                        </div>
                        <div class="media-body">
                            <div class="right-chart-content">
                                <h4>${{ $user->earningPocket()->balanceFloat }}</h4><span>Earning Balance</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                    <div class="media align-items-center">
                        <div class="">
                            <div class="small-bar"><img src="https://entrycaptcha.com/images/contactless.png">
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="right-chart-content">
                                <h4>${{ $user->purchasedPocket()->balanceFloat }}</h4><span>Purchased Balance</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                    <div class="media align-items-center">
                        <div class="">
                            <div class="small-bar"><img
                                    src="https://entrycaptcha.com/images/cost-per-click.png"></div>
                        </div>
                        <div class="media-body">
                            <div class="right-chart-content">
                                <h4>${{ $user->commissionPocket()->balanceFloat }}</h4><span>Commission Balance</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                    <div class="media border-none align-items-center">
                        <div class="">
                            <div class="small-bar"><img src="https://entrycaptcha.com/images/money-bag.png">
                            </div>
                        </div>
                        <div class="media-body">
                            <div class="right-chart-content">
                                <h4>${{ $user->bonusPocket()->balanceFloat }}</h4><span>Bonus Balance</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
