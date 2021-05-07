<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherRequest;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        if (request()->ajax()) {
            return DataTables::of(Voucher::where('owner_id', request()->user()->id)->with('user'))->toJson();
        }

        $html = $builder->columns([
            ['data' => 'id', 'name' => 'id', 'title' => 'Id'],
            ['data' => 'code', 'name' => 'code', 'title' => 'Code'],
            ['data' => 'user.username', 'name' => 'user.username', 'title' => 'User'],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'],
            ['data' => 'currency', 'name' => 'currency', 'title' => 'Currency'],
            ['data' => 'user.country', 'name' => 'user.country', 'title' => 'Country'],
        ]);

        return view('user.vouchers.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VoucherRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoucherRequest $request)
    {
        $data = $request->validated();
        $requestedPocket = $request->user()->$request->pocket.'Pocket';

        if ($request->amount < $requestedPocket->balanceFloat) {
            return back()->with('error', 'Insufficient Balance In Your ' . strtoupper($request->pocket) . ' Pocket');
        }

        if ($request->amount < config('others.minimum_voucher_amount', 10)) {
            return back()->with('error', 'Amount Should Be At Least $10.');
        }

        $user = User::query()
            ->where('username', $request->username)
            ->firstOrFail();

        if ($user->country != $request->user()->country) {
            return back()->with('error', $request->username . ' Is Not From Your Country.');
        }

        DB::beginTransaction();
        $user->vouchers()->create($data + [
            'owner_id' => $request->user()->id,
            'code' => $this->code(),
        ]);

        $requestedPocket->withdrawFloat($data['amount'], [
            'name' => 'Voucher For ' . $request->username,
        ]);
        DB::commit();

        return redirect()->action([static::class, 'index'])->with('success', 'Voucher Is Created.');
    }

    private function code($times = 5)
    {
        while ($times--) {
            $code = Str::random(12);
            if (! Voucher::firstWhere(compact('code'))) {
                return $code;
            }
        }
    }
}
