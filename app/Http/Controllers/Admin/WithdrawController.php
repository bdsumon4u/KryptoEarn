<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;
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
        Withdraw::query()
            ->with('user')
            ->where('status', 'pending')
            ->get()
            ->each(fn ($withdraw) => $withdraw->user->earningPocket()->balanceFloat < $withdraw->amount ? $withdraw->delete() : null);

        if (request()->ajax()) {
            return DataTables::of(Withdraw::query())->toJson();
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
            Column::make('actions')
                ->title('Actions')
                ->searchable(false)
                ->orderable(false)
                ->render('function() {
                    return this.status === `pending` ? `<a class="btn btn-success btn-sm w-100" href="/withdraws/${this.id}/edit">Edit</a>` : null;
                }')
                ->footer('Actions')
                ->exportable(false)
                ->printable(false),
        ])->parameters([
            'order' => [
                0, // here is the column number
                'desc'
            ],
        ]);

        return view('admin.withdraws.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $withdraw = $withdraw->load('user');
        $balance = $withdraw->user->earningPocket()->balanceFloat;
        return view('admin.withdraws.edit', compact('withdraw', 'balance'));
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
        if (($user = $withdraw->user)->earningPocket()->balanceFloat < $withdraw->amount) {
            return back()->with('error', 'Withdraw Amount Can\'t Be Greater Than Your Earning Balance.');
        }

        $user->earningPocket()->withdrawFloat($withdraw->amount, [
            'name' => 'Withdraw Via ' . $withdraw->gatewayName,
        ]);

        $withdraw->update(['status' => 'completed']);

        return redirect()->action([static::class, 'index'])->with('success', 'Withdraw Complete.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdraw $withdraw)
    {
        $withdraw->delete();

        return back()->with('success', 'Withdraw Request Deleted.');
    }
}
