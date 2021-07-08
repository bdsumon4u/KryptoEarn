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
        $val['m_shop'] = setting('gateway', 'payeer_merchant_id');
        $val['m_orderid'] = $deposit->trx_id;
        $val['m_amount'] = number_format($deposit->payable, 2);
        $val['m_curr'] = $deposit->currency;
        $val['m_desc'] = base64_encode('Pay To '. config('app.name'));
        $val['m_sign'] = strtoupper(hash('sha256', implode(":", [
            $val['m_shop'], $val['m_orderid'], $val['m_amount'], $val['m_curr'], $val['m_desc'], setting('gateway', 'payeer_secret'),
        ])));
        info('Paying Payeer SIGN:', [
            'deposit_id' => $deposit->id,
            'm_sign' => $val['m_sign'],
        ]);
        $send['val'] = $val;
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'get';
        $send['url'] = 'https://payeer.com/merchant';


        return json_encode($send);
    }


    public function ipn(Request $request)
    {
//        info('Payeer IPN', $request->all());
        if (isset($_POST["m_operation_id"], $_POST["m_sign"])) {
            $deposit = Deposit::with('user')->where('trx_id', $_POST['m_orderid'])->firstOrFail();
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
                setting('gateway', 'payeer_secret'),
            ])));

//            info('Receiving Payeer SIGN:', [
//                'deposit_id' => $deposit->id,
//                'm_sign' => $sign_hash,
//            ]);
            if ($_POST["m_sign"] !== $sign_hash) {
                info('SIGN doesn\'t matched.');
                session()->flash('error', 'The digital signature did not matched.');
            } else {
//                info('SIGN matched.');
//                info('Currency:', [$_POST['m_curr'], $deposit->currency]);
//                info('Status:', [$_POST['m_status'], $deposit->status]);
//                info('Amount:', [$_POST['m_amount'], number_format($deposit->payable, 2)]);
                if ($_POST['m_curr'] === $deposit->currency && $_POST['m_status'] === 'success' && $deposit->status === 'pending' && $_POST['m_amount'] >= number_format($deposit->payable, 2)) {
                    DepositController::userDataUpdate($deposit, 'Payeer');
                    info('Status Updated.');
                    session()->flash('success', 'Transaction is successful');
                    ob_end_clean(); exit($_POST['m_orderid'].'|success');
                }

                info('SIGN Matched But Failed.');
                session()->flash('error', 'Payment Failed.');
            }
        } else {
            info('Payment Failed.');
            session()->flash('error', 'Payment Failed.');
        }

        info('Error Occurred.');
        ob_end_clean(); exit($_POST['m_orderid'].'|error');
    }
}
