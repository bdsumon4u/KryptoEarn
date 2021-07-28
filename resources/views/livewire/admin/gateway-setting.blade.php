<form wire:submit.prevent="submit" method="POST" class="theme-form mega-form">
    @csrf
    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div class="text-danger">
                    <x-jet-validation-errors />
                </div>
            @endif
            <h6>Perfect Money</h6>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="col-form-label">Wallet ID</label>
                        <input class="form-control" type="text" placeholder="Wallet ID" wire:model.defer="perfect_money_wallet_id" value="{{ old('perfect_money_wallet_id') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="col-form-label">Passphrase</label>
                        <input class="form-control" type="text" placeholder="Passphrase" wire:model.defer="perfect_money_passphrase" value="{{ old('perfect_money_passphrase') }}">
                    </div>
                </div>
            </div>
            <strong>Deposit Config</strong>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Minimum Amount</label>
                        <input class="form-control" type="text" wire:model.defer="perfect_money_deposit_min_amount" value="{{ old('perfect_money_deposit_min_amount') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Maximum Amount</label>
                        <input class="form-control" type="text" wire:model.defer="perfect_money_deposit_max_amount" value="{{ old('perfect_money_deposit_max_amount') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Fixed Charge</label>
                        <input class="form-control" type="text" wire:model.defer="perfect_money_deposit_fixed_charge" value="{{ old('perfect_money_deposit_fixed_charge') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Percent Charge</label>
                        <input class="form-control" type="text" wire:model.defer="perfect_money_deposit_percent_charge" value="{{ old('perfect_money_deposit_percent_charge') }}">
                    </div>
                </div>
            </div>
            <strong>Withdraw Config</strong>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Minimum Amount</label>
                        <input class="form-control" type="text" wire:model.defer="perfect_money_withdraw_min_amount" value="{{ old('perfect_money_withdraw_min_amount') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Maximum Amount</label>
                        <input class="form-control" type="text" wire:model.defer="perfect_money_withdraw_max_amount" value="{{ old('perfect_money_withdraw_max_amount') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Fixed Charge</label>
                        <input class="form-control" type="text" wire:model.defer="perfect_money_withdraw_fixed_charge" value="{{ old('perfect_money_withdraw_fixed_charge') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Percent Charge</label>
                        <input class="form-control" type="text" wire:model.defer="perfect_money_withdraw_percent_charge" value="{{ old('perfect_money_withdraw_percent_charge') }}">
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-4">
{{--            <div class="row">--}}
{{--                <h6 class="pb-3 mb-0">Blockchain</h6>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="mb-3">--}}
{{--                        <label class="col-form-label">Secret</label>--}}
{{--                        <input class="form-control" type="text" placeholder="Secret" wire:model.defer="blockchain_secret" value="{{ old('blockchain_secret') }}">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="mb-3">--}}
{{--                        <label class="col-form-label">xPub Key</label>--}}
{{--                        <input class="form-control" type="text" placeholder="xPub Key" wire:model.defer="blockchain_xpub_key" value="{{ old('blockchain_xpub_key') }}">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="mb-3">--}}
{{--                        <label class="col-form-label">API Key</label>--}}
{{--                        <input class="form-control" type="text" placeholder="API Key" wire:model.defer="blockchain_api_key" value="{{ old('blockchain_api_key') }}">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <hr class="mt-4 mb-4">--}}
            <h6>Coinbase</h6>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="col-form-label">API Key</label>
                        <input class="form-control" type="text" placeholder="Wallet ID" wire:model.defer="coinbase_api_key" value="{{ old('coinbase_api_key') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="col-form-label">Secret</label>
                        <input class="form-control" type="text" placeholder="Passphrase" wire:model.defer="coinbase_secret" value="{{ old('coinbase_secret') }}">
                    </div>
                </div>
            </div>
            <strong>Deposit Config</strong>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Minimum Amount</label>
                        <input class="form-control" type="text" wire:model.defer="coinbase_deposit_min_amount" value="{{ old('coinbase_deposit_min_amount') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Maximum Amount</label>
                        <input class="form-control" type="text" wire:model.defer="coinbase_deposit_max_amount" value="{{ old('coinbase_deposit_max_amount') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Fixed Charge</label>
                        <input class="form-control" type="text" wire:model.defer="coinbase_deposit_fixed_charge" value="{{ old('coinbase_deposit_fixed_charge') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Percent Charge</label>
                        <input class="form-control" type="text" wire:model.defer="coinbase_deposit_percent_charge" value="{{ old('coinbase_deposit_percent_charge') }}">
                    </div>
                </div>
            </div>
            <strong>Withdraw Config</strong>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Minimum Amount</label>
                        <input class="form-control" type="text" wire:model.defer="coinbase_withdraw_min_amount" value="{{ old('coinbase_withdraw_min_amount') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Maximum Amount</label>
                        <input class="form-control" type="text" wire:model.defer="coinbase_withdraw_max_amount" value="{{ old('coinbase_withdraw_max_amount') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Fixed Charge</label>
                        <input class="form-control" type="text" wire:model.defer="coinbase_withdraw_fixed_charge" value="{{ old('coinbase_withdraw_fixed_charge') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Percent Charge</label>
                        <input class="form-control" type="text" wire:model.defer="coinbase_withdraw_percent_charge" value="{{ old('coinbase_withdraw_percent_charge') }}">
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-4">
            <div class="row">
                <h6 class="pb-3 mb-0">Payeer</h6>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="col-form-label">Merchant ID</label>
                        <input class="form-control" type="text" placeholder="Merchant ID" wire:model.defer="payeer_merchant_id" value="{{ old('payeer_merchant_id') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="col-form-label">Secret</label>
                        <input class="form-control" type="text" placeholder="Secret" wire:model.defer="payeer_secret" value="{{ old('payeer_secret') }}">
                    </div>
                </div>
            </div>
            <strong>Deposit Config</strong>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Minimum Amount</label>
                        <input class="form-control" type="text" wire:model.defer="payeer_deposit_min_amount" value="{{ old('payeer_deposit_min_amount') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Maximum Amount</label>
                        <input class="form-control" type="text" wire:model.defer="payeer_deposit_max_amount" value="{{ old('payeer_deposit_max_amount') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Fixed Charge</label>
                        <input class="form-control" type="text" wire:model.defer="payeer_deposit_fixed_charge" value="{{ old('payeer_deposit_fixed_charge') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Percent Charge</label>
                        <input class="form-control" type="text" wire:model.defer="payeer_deposit_percent_charge" value="{{ old('payeer_deposit_percent_charge') }}">
                    </div>
                </div>
            </div>
            <strong>Withdraw Config</strong>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Minimum Amount</label>
                        <input class="form-control" type="text" wire:model.defer="payeer_withdraw_min_amount" value="{{ old('payeer_withdraw_min_amount') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Maximum Amount</label>
                        <input class="form-control" type="text" wire:model.defer="payeer_withdraw_max_amount" value="{{ old('payeer_withdraw_max_amount') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Fixed Charge</label>
                        <input class="form-control" type="text" wire:model.defer="payeer_withdraw_fixed_charge" value="{{ old('payeer_withdraw_fixed_charge') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="col-form-label">Percent Charge</label>
                        <input class="form-control" type="text" wire:model.defer="payeer_withdraw_percent_charge" value="{{ old('payeer_withdraw_percent_charge') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end p-3">
            <button class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
