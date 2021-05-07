<x-user-layout>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <ul class="nav nav-tabs search-list" id="top-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active " id="all-link" data-toggle="tab" href="#all-links" role="tab" aria-selected="true">
                                    <i class="icon-target"></i>REDEEM VOUCHER
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="top-tabContent">
                        <div class="search-links tab-pane fade show active " id="all-links" role="tabpanel" aria-labelledby="all-link">
                            <div class="row">
                                <div class="col-xl-12 box-col-12">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <div class="info-block">
                                                <div class="text-center"></div>
                                                <div class="container">
                                                    <div class="form"><h6>Enter voucher code below</h6>
                                                        <form method="POST" action="{{ route('vouchers.redeem') }}" accept-charset="UTF-8" class="theme-form needs-validation" novalidate="">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label class="col-form-label">Voucher Code</label>
                                                                <input class="form-control" value="" required="" name="code" type="text">
                                                            </div>
                                                            <button name="redeem"
                                                                    class="btn btn-primary d-block mx-0 mb-3"
                                                                    type="submit">REDEEM
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="star-ratings">
                                                    Voucher codes summary
                                                    <ul class="search-info">
                                                        <li>Instant processed</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-sm-12 col-md-4">
                                            <h6>Your Vouchers</h6>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Code</th>
                                                        <th>From</th>
                                                        <th>USD</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($vouchers as $voucher)
                                                    <tr>
                                                        <td>{{ $voucher->code }}</td>
                                                        <td>{{ $voucher->owner->username }}</td>
                                                        <td>{{ $voucher->amount }}</td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="3">No Voucher Found.</td>
                                                    </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 box-col-12 mt-4">
                                    <div class="info-block">
                                        <div>
                                            <h6>How to redeem voucher codes</h6>
                                            1. Enter the voucher you received on the form.<br>
                                            2. Click on redeem now.<br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
