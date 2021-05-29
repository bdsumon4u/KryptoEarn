<div class="card b-radius--10 overflow-hidden box--shadow1">
    <div class="card-header p-4">
        <strong>Add Fund</strong>
    </div>
    <div class="card-body p-4">
        <x-validation-errors />
        <form method="post" wire:submit.prevent="submit">
            <div class="mb-3">
                <label class="col-form-label">Amount</label>
                <div class="input-group">
                    <input class="form-control" type="text" name="amount" wire:model.defer="amount" value="{{ old('amount') }}">
                    <div class="input-group-append">
                        <span class="input-group-text">$</span>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="col-form-label">Destination</label>
                <div class="input-group">
                    <select name="destination" wire:model.defer="destination" id="destination" class="form-control">
                        @foreach($wallets as $wallet)
                        <option value="{{ $wallet }}">{{ ucfirst($wallet) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="col-form-label">Transaction Name</label>
                <div class="input-group">
                    <input class="form-control" type="text" name="amount" wire:model.defer="name" value="{{ old('name') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-success" wire:loading.attr="disabled">Submit</button>
        </form>
    </div>
</div>
