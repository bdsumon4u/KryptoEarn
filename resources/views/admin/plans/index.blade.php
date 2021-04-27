<x-admin-layout>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body row pricing-block">
                    @foreach($plans as $plan)
                    <div class="col-lg-3 col-md-6">
                        <div class="pricingtable shadow">
                            <div class="pricingtable-header">
                                <h3 class="title">{{ $plan->name }}</h3>
                            </div>
                            <div class="price-value"><span class="currency">$</span><span class="amount">{{ $plan->price }}</span></div>
                            <ul class="pricing-content">
                                <li>Daily Limit: {{ $plan->task_limit }} Tasks</li>
                                <li>Validity: {{ $plan->validity }} days</li>
                                <li>Earning Per Task: ${{ $plan->earning_per_task / 100 }}</li>
                                <li>Ref. Commission On Each Task: {{ $plan->ref_commission_on_each_task }}%</li>
                                <li>Ref. Commission On Plan Upgrade: {{ $plan->ref_commission_on_plan_upgrade }}%</li>
                                <li>Minimum Earning: ${{ $plan->validity * $plan->task_limit * $plan->earning_per_task / 100 }}</li>
                                <li>Instant Payouts: {{ $plan->instant_payouts ? 'Enabled' : 'Disabled' }}</li>
                                <li>Minimum Withdraw: ${{ $plan->minimum_withdraw }}</li>
                                <li>Payout Days: {{ $plan->payout_days }}</li>
                                <li>Status: {{ $plan->is_active ? 'Active' : 'Inactive' }}</li>
                            </ul>
                            <div class="pricingtable-signup">
                                <a class="btn btn-primary btn-lg" href="{{ route('plans.edit', $plan) }}">Edit Plan</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
