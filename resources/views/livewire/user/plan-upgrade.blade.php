<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center"><h4>Choose the package you want to upgrade to </h4><label
                            style="color:red;" id="errors" class="col-form-label"></label>
                        <form wire:submit.prevent="submit" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="col-lg-4 offset-lg-4 ">
                                <select id="selectbasic" wire:model="plan_id" class="form-control btn-square">
                                    <option> Choose</option>
                                    @foreach($plans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                                @if($plan_id)
                                <h2 id="pack_amount">${{ $plans->first(fn ($plan) => $plan->id == $plan_id)->price }}</h2>
                                @endif
                                <label>Preffered payment method</label>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <button type="submit" id="singlebutton" value="purchases" name="purchases"
                                                class="btn btn-primary mb-3">Purchases balance
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <a href="/deposits/create" class="btn btn-primary mb-3">Payment Processor</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!-- Button -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Features</th>
                                @foreach($plans as $plan)
                                    <th>{{ $plan->name }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
{{--                            <tr>--}}
{{--                                <td></td>--}}
{{--                                <td><img style="max-height:100px;"--}}
{{--                                         src="https://entrycaptcha.com/assets/images/packs/OZG6Oy3e0n.png" alt="*"></td>--}}
{{--                                <td><img style="max-height:100px;"--}}
{{--                                         src="https://entrycaptcha.com/assets/images/packs/Dv0Rnx31m3.png" alt="*"></td>--}}
{{--                                <td><img style="max-height:100px;"--}}
{{--                                         src="https://entrycaptcha.com/assets/images/packs/tP1sWTteXR.png" alt="*"></td>--}}
{{--                                <td><img style="max-height:100px;"--}}
{{--                                         src="https://entrycaptcha.com/assets/images/packs/GLdQXE2J1P.png" alt="*"></td>--}}
{{--                                <td><img style="max-height:100px;"--}}
{{--                                         src="https://entrycaptcha.com/assets/images/packs/gp4XFDpcP1.png" alt="*"></td>--}}
{{--                            </tr>--}}
                            <tr>
                                <td> Package amount</td>
                                @foreach($plans as $plan)
                                    <td>${{ $plan->price }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td> Number of tasks</td>
                                @foreach($plans as $plan)
                                    <td>${{ $plan->task_limit }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td> Earning per task</td>
                                @foreach($plans as $plan)
                                    <td>${{ $plan->earning_per_task / 100 }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td> Refferal commision per task(%)</td>
                                @foreach($plans as $plan)
                                    <td>{{ $plan->ref_commission_on_each_task }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td> Refferal upgrade commision(%)</td>
                                @foreach($plans as $plan)
                                    <td>{{ $plan->ref_commission_on_plan_upgrade }}</td>
                                @endforeach
                            </tr>
{{--                            <tr>--}}
{{--                                <td> Maximum refferals</td>--}}
{{--                                @foreach($plans as $plan)--}}
{{--                                    <td>{{ $plan->maximum_referrals }}</td>--}}
{{--                                @endforeach--}}
{{--                            </tr>--}}
                            <tr>
                                <td> Instant Payouts</td>
                                @foreach($plans as $plan)
                                    <td>{{ $plan->instant_payouts ? 'Enabled' : 'Disabled' }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td> Payout days</td>
                                @foreach($plans as $plan)
                                    <td>{{ $plan->payout_days }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td> Minimum Payout</td>
                                @foreach($plans as $plan)
                                    <td>${{ $plan->minimum_withdraw }}</td>
                                @endforeach
                            </tr>
{{--                            <tr>--}}
{{--                                <td> Refferals required for withdrawals</td>--}}
{{--                                @foreach($plans as $plan)--}}
{{--                                    <td>{{ $plan->required_referrals_to_withdraw }}</td>--}}
{{--                                @endforeach--}}
{{--                            </tr>--}}
                            <tr>
                                <td> Package expiry (days)</td>
                                @foreach($plans as $plan)
                                    <td>{{ $plan->validity }}</td>
                                @endforeach
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
