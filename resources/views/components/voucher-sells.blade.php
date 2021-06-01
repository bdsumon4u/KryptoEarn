<div class="card">
    <div class="card-body">
        <h5> Voucher Selling Report For This Week: </h5>
        <!-- Chart's container -->
        <div>
            {!! $voucherSells->container() !!}
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
    {!! $voucherSells->script() !!}
@endpush
