<?php

namespace App\Http\Gateways\Payeer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DepositController;
use App\Models\Deposit;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /*
     * Payeer Gateway
     */

    public static function process(Deposit $deposit)
    {
        $val['m_shop'] = config('gateway.setup.payeer.merchant_id');
        $val['m_orderid'] = $deposit->trx_id;
        $val['m_amount'] = $deposit->payable;
        $val['m_curr'] = $deposit->currency;
        $val['m_desc'] = base64_encode('Pay To '. config('app.name'));
        $val['m_sign'] = strtoupper(hash('sha256', implode(":", [
            $val['m_shop'], $val['m_orderid'], $val['m_amount'], $val['m_curr'], $val['m_desc'], config('gateway.setup.peyeer.secret'),
        ])));
        $send['val'] = $val;
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'get';
        $send['url'] = 'https://payeer.com/merchant';


        return json_encode($send);
    }


    public function ipn(Request $request)
    {
        if (isset($_POST["m_operation_id"], $_POST["m_sign"])) {
            $deposit = Deposit::where('trx_id', $_POST['m_orderid'])->firstOrFail();
            $sign_hash = strtoupper(hash('sha256', implode(":", [
                $_POST['m_operation_id'],
                $_POST['m_operation_ps'],
                $_POST['m_operation_date'],
                $_POST['m_operation_pay_date'],
                $_POST['m_shop'],
                $_POST['m_orderid'],
                $_POST['m_amount'],
                $_POST['m_curr'],
                $_POST['m_desc'],
                $_POST['m_status'],
                config('gateway.setup.payeer.secret'),
            ])));

            if ($_POST["m_sign"] !== $sign_hash) {
                session()->flash('error', 'The digital signature did not matched.');
            } else {
                if ($_POST['m_amount'] === $deposit->payable && $_POST['m_curr'] === $deposit->currency && $_POST['m_status'] === 'success' && $deposit->status === 'pending') {
                    DepositController::userDataUpdate($deposit, 'Payeer');
                    session()->flash('success', 'Transaction is successful');
                } else {
                    session()->flash('error', 'Payment Failed.');
                }
            }
        } else {
            session()->flash('error', 'Payment Failed.');
        }

        return redirect()->route('dashboard');
    }
}
