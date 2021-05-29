<div class="card">
    <div class="card-body">
        <h5> Balance Logs </h5>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Trx ID#</th>
                    <th scope="col">Cause</th>
                    <th scope="col">Amount ($)</th>
                    <th scope="col">Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <th scope="row">{{ $transaction->id }}</th>
                        <td>{{ $transaction->meta['name'] }}</td>
                        <td>{{ $transaction->type === 'deposit' ? '+' : '' }}{{ round($transaction->amountFloat, 2) }}</td>
                        <td>{{ $transaction->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
