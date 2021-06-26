<?php

namespace App\Http\Controllers;

use App\Mail\WithdrawRequestMail;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of(request()->user()->withdraws())->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'trx_id', 'name' => 'trx_id', 'title' => 'Trx Id'],
            Column::make('gateway')
                ->title('Gateway')
                ->searchable(true)
                ->orderable(true)
                ->render('function(){
                    return this.gateway.toLowerCase().replace(/-/g, \' \').replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                }')
                ->footer('Gateway')
                ->exportable(true)
                ->printable(true),
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'],
            ['data' => 'charge', 'name' => 'charge', 'title' => 'Charge'],
            ['data' => 'receivable', 'name' => 'receivable', 'title' => 'Receivable'],
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

        return view('user.withdraws.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = request()->user();

        if (!$user->is_partner) {
            if (($now = now(config('app.timezone'))) && !$now->isMonday() && !$now->isFriday()) {
                return back()->with('error', 'Today Is Neither Monday Nor Friday.');
            }

            if (($withdraw = $user->withdraws()->latest('id')->first()) && $withdraw->created_at->addDay()->isPast()) {
                return back()->with('error', 'You Can\'t Withdraw More Than Once Within 24H.');
            }
        }

        $gateway = array_merge(Arr::get($user->extra ?? [], 'gateway', [
            'addresses' => [
                'perfect_money' => '',
                'bitcoin' => '',
                'payeer' => '',
            ],
            'updated_at' => now()->toDateTimeString(),
        ]));

        return view('user.withdraws.create', compact('user', 'gateway'));
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
        $user = $request->user();

        if (!Hash::check($data['password'], $user->password)) {
            return back()->with('error', 'Incorrect Password');
        }

        if (!$user->is_gateway_safe) {
            return back()->with('error', 'You\'ve Updated Your Payment Info Recently. Withdraw Request Can\'t Be Taken.');
        }

        if ($user->earningPocket()->balanceFloat < $user->membership->plan->minimum_withdraw) {
            return back()->with('error', 'Insufficient Balance.');
        }

        if ($user->earningPocket()->balanceFloat < $data['amount']) {
            $data['amount'] = $user->earningPocket()->balanceFloat;
        }

        $withdraw = $user->withdraws()->create($data + [
            'trx_id' => $this->trxId(),
            'receivable' => $data['amount'] - $data['charge'],
        ]);

        Mail::send(new WithdrawRequestMail($withdraw->refresh()));

        return redirect()->action([static::class, 'index'])->with('success', 'Received Withdrawal Request.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function show(Withdraw $withdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdraw $withdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdraw $withdraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdraw $withdraw)
    {
        //
    }

    private function processData(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required',
            'password' => 'required',
            'gateway' => 'required',
        ]);

        $charge = config('gateway.withdraw.'.$data['gateway'].'.fixed_charge', 0)
            + $data['amount'] * config('gateway.withdraw.'.$data['gateway'].'.percent_charge', 0) / 100;
        $data['charge'] = round($charge, 2);

        return $data;
    }

    private function trxId($times = 5)
    {
        while ($times--) {
            $trx_id = Str::random(12);
            if (! Withdraw::firstWhere(compact('trx_id'))) {
                return $trx_id;
            }
        }
    }
}
