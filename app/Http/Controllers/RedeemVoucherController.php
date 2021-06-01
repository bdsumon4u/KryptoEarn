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
        $user = $request->user();
        if ($request->isMethod('GET')) {
            return $user->partner && ($user->partner->status === 'approved')
                ? back()->with('error', 'Partner/Agent Can\'t Redeem Vouchers.')
                :view('user.vouchers.redeem', [
                    'vouchers' => $user->vouchers()->with('owner')->get(),
                ]);
        }

        $data = $request->validate([
            'code' => 'required|size:12',
        ]);

        $voucher = $user->vouchers()->where($data)->with('owner')->firstOrFail();

        if ($voucher->status === 'claimed') {
            return back()->with('error', 'You\'ve Already Claimed This Voucher.');
        }

        DB::beginTransaction();
        $user->purchasedPocket()->depositFloat($voucher->amount, [
            'name' => 'Redeem ' . $voucher->owner->username . '\'s Voucher',
        ]);
        $voucher->owner->commissionPocket()->depositFloat($voucher->amount * config('others.voucher_selling_commission', 15) / 100, [
            'name' => 'Selling Voucher To ' . $user->username,
        ]);
        $voucher->update(['status' => 'claimed']);
        DB::commit();

        return back()->with('success', 'You\'ve Got $' . $voucher->amount);
    }
}
