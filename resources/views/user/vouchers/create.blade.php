<x-user-layout>
    @push('styles')
        <style>
            .input-group-text {
                height: 100%;
            }
        </style>
    @endpush
    <div class="row">
        <div class="col-md-10 offset-md-1 col-lg-6 offset-lg-3">
            <div class="card">
                <form method="POST" class="theme-form mega-form" action="{{ route('vouchers.store') }}">
                    @csrf
                    @if($errors->any())
                        <div class="card-header">
                            <x-validation-errors />
                        </div>
                    @endif
                    <div class="card-body">
                        <h6>Plan Information</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-0">
                                    <label class="col-form-label">Wallet</label>
                                    <select class="form-control" name="pocket" id="pocket">
                                        <option value="earning">Earning</option>
                                        <option value="purchased">Purchased</option>
                                        <option value="commission">Commission</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-0">
                                    <label class="col-form-label">Amount</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" placeholder="Amount" name="amount" value="{{ old('amount') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-0">
                                    <label class="col-form-label">Username</label>
                                    <input class="form-control" type="text" placeholder="Voucher For User" name="username" value="{{ old('username') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end p-3">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-user-layout>
