<x-admin-layout>@push('styles')
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
                <form method="POST" class="theme-form mega-form" action="{{ route($balance < $withdraw->amount ? 'withdraws.destroy' : 'withdraws.update', $withdraw) }}">
                    @csrf
                    @method($balance < $withdraw->amount ? 'DELETE' : 'PATCH')
                    @if($errors->any())
                        <div class="card-header">
                            <x-validation-errors />
                        </div>
                    @endif
                    <div class="card-body">
                        <h6>User Information</h6>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Name</label>
                                    <input class="form-control" type="text" placeholder="User Name" name="name" value="{{ $withdraw->user->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Balance</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" placeholder="User Balance" name="balance" value="{{ $balance }}" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Receivable</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" placeholder="Receivable" name="receivable" value="{{ $withdraw->receivable }}" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text">$</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-4 mb-4">
                            <h6>Gateway Information</h6>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="col-form-label">Gateway Name</label>
                                    <input type="text" class="form-control" name="gateway_name" id="gateway-name" value="{{ $withdraw->gatewayName }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="col-form-label">Gateway Address</label>
                                    <input type="text" class="form-control" name="gateway_address" id="gateway-address" value="{{ $withdraw->gateway_address }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end p-3">
                        @if($balance < $withdraw->amount)
                            <button class="btn btn-danger">DELETE</button>
                        @elseif($withdraw->status === 'completed')
                            <a href="{{ route('withdraws.index') }}" class="btn btn-warning">Back</a>
                        @else
                            <button class="btn btn-success">Paid</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
