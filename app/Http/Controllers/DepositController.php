<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of(request()->user()->deposits())->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'trx_id', 'name' => 'trx_id', 'title' => 'Trx Id'],
            Column::make('gateway')
                ->title('Gateway')
                ->searchable(true)
                ->orderable(true)
                ->render('function(){
                    return this.gateway.toLowerCase().replace(/_/g, \' \').replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                }')
                ->footer('Gateway')
                ->exportable(true)
                ->printable(true),
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'],
            ['data' => 'charge', 'name' => 'charge', 'title' => 'Charge'],
            ['data' => 'payable', 'name' => 'payable', 'title' => 'Payable'],
            ['data' => 'currency', 'name' => 'currency', 'title' => 'Currency'],
            Column::make('status')
                ->title('Status')
                ->searchable(true)
                ->orderable(true)
                ->render('function(){
                    return this.status.toLowerCase().replace(/-/g, \' \').replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                }')
                ->footer('Status')
                ->exportable(true)
                ->printable(true),
        ])->parameters([
            'order' => [
                0, // here is the column number
                'desc'
            ],
            'dom' => 'lBf<"table dataTable no-footer table-responsive"t>rip',
        ]);

        return view('user.deposits.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('user.deposits.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->processData($request);

        $min_amount = setting('gateway', $data['gateway'].'_deposit_min_amount');
        if ($data['amount'] < $min_amount) {
            return back()->withErrors('Amount Must Be At Least $'.$min_amount);
        }

        $deposit = $request->user()->deposits()->create($data + [
            'trx_id' => $this->trxId(),
            'payable' => $data['amount'] + $data['charge'],
        ]);

        return redirect()->action([static::class, 'show'], $deposit)->with('success', 'Ready For The Payment.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function show(Deposit $deposit)
    {
        return view('user.deposits.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposit $deposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposit $deposit)
    {
        if ($deposit->status != 'pending') {
            return redirect()->action([static::class, 'index'])->with('error', 'Invalid Deposit Request.');
        }

//        if ($deposit->method_code >= 1000) {
//            $this->userDataUpdate($deposit);
//            $notify[] = ['success', 'Your deposit request is queued for approval.'];
//            return back()->withNotify($notify);
//        }

        $gatewayDir = implode('', array_map(function ($part) {
            return ucfirst($part);
        }, explode('_', $deposit->gateway)));

        $gatewayNsp = '\\App\\Http\\Gateways\\'.$gatewayDir.'\\ProcessController';

        $data = $gatewayNsp::process($deposit);
        $data = json_decode($data);

        if (isset($data->error, $data->message)) {
            return redirect()->action([static::class, 'index'])->with('error', $data->message);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
//        if(@$data->session){
//            $deposit->btc_wallet = $data->session->id;
//            $deposit->save();
//        }

        return view($data->view, compact('data', 'deposit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposit $deposit)
    {
        $deposit->delete();

        return back()->with('success', 'Payment Is Cancelled.');
    }

    private function processData(Request $request)
    {
        $data = $request->validate([
            'amount' => [
                'required',
            ],
            'gateway' => 'required',
        ]);

        $charge = setting('gateway', $data['gateway'].'_deposit_fixed_charge', 0)
            + $data['amount'] * setting('gateway', $data['gateway'].'_deposit_percent_charge', 0) / 100;
        $data['charge'] = round($charge, 2);

        return $data;
    }

    private function trxId($times = 5)
    {
        while ($times--) {
            $trx_id = Str::random(12);
            if (! Deposit::firstWhere(compact('trx_id'))) {
                return $trx_id;
            }
        }
    }

    public static function userDataUpdate(Model $deposit, $gatewayName): void
    {
        if ($deposit->status === 'pending') {
            $deposit->update(['status' => 'completed']);

            $deposit->user->purchasedPocket()->depositFloat($deposit->amount, [
                'name' => 'Deposit via '.$gatewayName.'.',
            ]);

            //            if ('refCommissionOnDeposit') {
            //                //
            //            }

            info('Deposit Completed.', $deposit->toArray());
            session()->flash('success', 'Deposit Completed.');
        }
    }
}
