<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\Request;
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
            return DataTables::of(Deposit::query())->toJson();
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

        return view('admin.deposits.index', compact('html'));
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
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function show(Deposit $deposit)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposit $deposit)
    {
        //
    }
}
