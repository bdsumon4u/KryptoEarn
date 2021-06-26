<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Plan;
use App\Models\User;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Builder $builder)
    {
        if (request()->ajax()) {
            $query = Transaction::query()->with(['payable' => function (MorphTo $morphTo) {
                $morphTo->morphWith([Membership::class => ['user']]);
            }]);

            return DataTables::of($query)
                ->addColumn('username', function ($row) {
                    return $row->payable->username;
                })
                ->addColumn('name', function ($row) {
                    return $row->meta['name'];
                })
                ->editColumn('amount', function ($row) {
                    return ['deposit' => '+$', 'withdraw' => '-$']
                        [$row->type] . abs(round($row->amountFloat, 2));
                })
                ->addColumn('datetime', function ($row) {
                    return $row->created_at->formatted(true);
                })
                ->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'username', 'name' => 'username', 'title' => 'User'],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'],
            ['data' => 'datetime', 'name' => 'datetime', 'title' => 'DateTime'],
        ])->parameters([
            'order' => [
                0, // here is the column number
                'desc'
            ],
            'dom' => 'lBf<"table dataTable no-footer table-responsive"t>rip',
        ]);

        return view('admin.reports', compact('html'));
    }
}
