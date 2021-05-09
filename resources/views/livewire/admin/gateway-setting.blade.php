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
                        <input class="form-control" type="text" placeholder="Wallet ID" wire:model.defer="perfect_money_wallet_id" value="{{ old('perfect_money.wallet_id') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="col-form-label">Passphrase</label>
                        <input class="form-control" type="text" placeholder="Passphrase" wire:model.defer="perfect_money_passphrase" value="{{ old('perfect_money.passphrase') }}">
                    </div>
                </div>
                <hr class="mt-4 mb-4">
                <h6 class="pb-3 mb-0">Blockchain</h6>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="col-form-label">Secret</label>
                        <input class="form-control" type="text" placeholder="Secret" wire:model.defer="blockchain_secret" value="{{ old('blockchain.secret') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="col-form-label">xPub Key</label>
                        <input class="form-control" type="text" placeholder="xPub Key" wire:model.defer="blockchain_xpub_key" value="{{ old('blockchain.xpub_key') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="col-form-label">API Key</label>
                        <input class="form-control" type="text" placeholder="API Key" wire:model.defer="blockchain_api_key" value="{{ old('blockchain.api_key') }}">
                    </div>
                </div>
                <hr class="mt-4 mb-4">
                <h6 class="pb-3 mb-0">Payeer</h6>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="col-form-label">Merchant ID</label>
                        <input class="form-control" type="text" placeholder="Merchant ID" wire:model.defer="payeer_merchant_id" value="{{ old('payeer.merchant_id') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="col-form-label">Secret</label>
                        <input class="form-control" type="text" placeholder="Secret" wire:model.defer="payeer_secret" value="{{ old('payeer.secret') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end p-3">
            <button class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
