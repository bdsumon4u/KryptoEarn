<div class="form">
    <x-validation-errors />
    <h6>Enter the details</h6>
    <form wire:submit.prevent="submit"
          accept-charset="UTF-8"
          autocomplete="off">
        <div class="mb-3">
            <input
                wire:model="username"
                class="form-control"
                placeholder="Agent's Username"
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
