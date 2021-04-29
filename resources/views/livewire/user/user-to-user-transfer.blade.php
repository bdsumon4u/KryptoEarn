<div class="form">
    <x-validation-errors />
    <h6>Enter the details</h6>
    <form wire:submit.prevent="submit"
          accept-charset="UTF-8"
          autocomplete="off">
        <div class="mb-3">
            <select
                wire:model="source"
                class="form-control"
            >
                @foreach($wallets as $wallet)
                    <option value="{{ $wallet }}">{{ strtoupper(str_replace('-', ' ', $wallet)) }}</option>
                @endforeach
            </select>
        </div>
        <img class="d-block mx-auto mb-3" src="{{ asset('cuba/user1/assets/images/down-arrow.png') }}">
        <div class="mb-3">
            <input
                wire:model="username"
                class="form-control"
                placeholder="Receiver's Username"
            />
        </div>
        <div class="mb-3">
            <label class="col-form-label">Enter Amount</label>
            <input class="form-control" wire:model="amount" type="text">
        </div>
        <button
            class="btn btn-primary btn-block"
            type="submit">Transfer
        </button>
    </form>
</div>
