<x-admin-layout>
    @push('styles')
        <style>
            .input-group-text {
                height: 100%;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    @endpush
    <div class="row">
        <div class="col-md-10 offset-md-1 col-lg-6 offset-lg-3">
            <div class="card">
                <form method="POST" class="theme-form mega-form" action="{{ $plan->exists ? route('plans.update', $plan) : route('plans.store') }}">
                    @csrf
                    @method($plan->exists ? 'PATCH' : 'POST')
                    @if($errors->any())
                        <div class="card-header">
                            <x-validation-errors />
                        </div>
                    @endif
                    <div class="card-body">
                        <h6>Plan Information</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Name</label>
                                    <input class="form-control" type="text" placeholder="Plan Name" name="name" value="{{ old('name', $plan->name) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Price</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" placeholder="Plan Price" name="price" value="{{ old('price', $plan->price) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Validity</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" placeholder="Plan Validity" name="validity" value="{{ old('validity', $plan->validity) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">days</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-4 mb-4">
                            <h6 class="pb-3 mb-0">Task Information</h6>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Task Limit</label>
                                    <input class="form-control" type="number" placeholder="Daily Task Limit" name="task_limit" value="{{ old('task_limit', $plan->task_limit) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Earning: Per Task</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" placeholder="Earning Per Task" name="earning_per_task" value="{{ old('earning_per_task', $plan->earning_per_task) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">&cent;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-4 mb-4">
                            <h6 class="pb-3 mb-0">Referral Information</h6>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Maximum</label>
                                    <input class="form-control" type="number" placeholder="Maximum Referrals" name="maximum_referrals" value="{{ old('maximum_referrals', $plan->maximum_referrals) }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Commission: Each Task</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" placeholder="Commission On Each Task" name="ref_commission_on_each_task" value="{{ old('ref_commission_on_each_task', $plan->ref_commission_on_each_task) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Commission: Plan Upgrade</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" placeholder="Commission On Plan Upgrade" name="ref_commission_on_plan_upgrade" value="{{ old('ref_commission_on_plan_upgrade', $plan->ref_commission_on_plan_upgrade) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="col-form-label">Referrals Required To Withdraw</label>
                                    <input class="form-control" type="number" placeholder="Referrals Required To Withdraw" name="required_referrals_to_withdraw" value="{{ old('required_referrals_to_withdraw', $plan->required_referrals_to_withdraw) }}">
                                </div>
                            </div>
                            <hr class="mt-4 mb-4">
                            <h6>Payout Information</h6>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Instant Payouts</label>
                                    <br>
                                    <input type="checkbox" name="instant_payouts" {{ old('instant_payouts', $plan->exists && $plan->instant_payouts) ? 'checked' : '' }} data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Minimum Withdraw</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" placeholder="Minimum Withdraw Amount" name="minimum_withdraw" value="{{ old('minimum_withdraw', $plan->minimum_withdraw) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="col-md-5">--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label class="col-form-label">Payout Days</label>--}}
{{--                                    <input class="form-control" type="text" placeholder="Ex: Mon, Fri, ..." name="payout_days" value="{{ old('payout_days', $plan->payout_days) }}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <div class="card-footer text-end p-3">
                        <input type="checkbox" name="is_active" {{ old('is_active', $plan->exists ? $plan->is_active : true) ? 'checked' : '' }} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    @endpush
</x-admin-layout>
