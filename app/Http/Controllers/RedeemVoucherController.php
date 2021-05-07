<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RedeemVoucherController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('user.vouchers.redeem', [
                'vouchers' => $request->user()->vouchers()->with('owner')->get(),
            ]);
        }

        $data = $request->validate([
            'code' => 'required|size:12',
        ]);
        $user = $request->user();

        $voucher = $user->vouchers()->where($data)->with('owner')->firstOrFail();

        DB::beginTransaction();
        $user->purchasedPocket()->depositFloat($voucher->amount, [
            'name' => 'Redeem ' . $voucher->owner->username . '\'s Voucher',
        ]);
        $voucher->owner->commissionPocket()->depositFloat($voucher->amount * config('others.voucher_selling_commission', 15) / 100, [
            'name' => 'Selling Voucher To ' . $user->username,
        ]);
        $voucher->delete();
        DB::commit();

        return back()->with('success', 'You\'ve Got $' . $voucher->amount);
    }
}
