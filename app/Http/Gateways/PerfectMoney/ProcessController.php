<?php

namespace App\Http\Gateways\PerfectMoney;

use App\Http\Controllers\DepositController;
use App\Models\Deposit;
use App\Http\Controllers\Controller;

class ProcessController extends Controller
{
    /*
     * Perfect Money Gateway
     */
    public static function process(Deposit $deposit)
    {
        $val['PAYEE_ACCOUNT'] = config('gateway.setup.perfect-money.wallet_id');
        $val['PAYEE_NAME'] = config('app.name');
        $val['PAYMENT_ID'] = $deposit->trx_id;
        $val['PAYMENT_AMOUNT'] = $deposit->payable;
        $val['PAYMENT_UNITS'] = $deposit->currency;

        $val['STATUS_URL'] = action([static::class, 'ipn']);
        $val['PAYMENT_URL'] = route('dashboard');
        $val['PAYMENT_URL_METHOD'] = 'GET';
        $val['NOPAYMENT_URL'] = route('deposits.show', $deposit);
        $val['NOPAYMENT_URL_METHOD'] = 'GET';
        $val['SUGGESTED_MEMO'] = request()->user()->username;
        $val['BAGGAGE_FIELDS'] = 'IDENT';


        $send['val'] = $val;
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'post';
        $send['url'] = 'https://perfectmoney.is/api/step1.asp';


        return json_encode($send);
    }

    public function ipn()
    {
        $deposit = Deposit::where('trx', $_POST['PAYMENT_ID'])->firstOrFail();
        $passphrase = strtoupper(md5(config('gateway.setup.perfect-money.passphrase')));

        define('ALTERNATE_PHRASE_HASH', $passphrase);
        define('PATH_TO_LOG', storage_path('logs'));
        $string =
            $_POST['PAYMENT_ID'] . ':' . $_POST['PAYEE_ACCOUNT'] . ':' .
            $_POST['PAYMENT_AMOUNT'] . ':' . $_POST['PAYMENT_UNITS'] . ':' .
            $_POST['PAYMENT_BATCH_NUM'] . ':' .
            $_POST['PAYER_ACCOUNT'] . ':' . ALTERNATE_PHRASE_HASH . ':' .
            $_POST['TIMESTAMPGMT'];

        $hash = strtoupper(md5($string));
        $hash2 = $_POST['V2_HASH'];

        if ($hash == $hash2) {
            $amo = $_POST['PAYMENT_AMOUNT'];
            $unit = $_POST['PAYMENT_UNITS'];
            $track = $_POST['PAYMENT_ID'];
            if ($unit === $deposit->currency && $amo === $deposit->payable && $deposit->status === 'pending' && $_POST['PAYEE_ACCOUNT'] === config('gateway.setup.perfect-money.wallet_id')) {
                //Update User Data
                DepositController::userDataUpdate($deposit, 'PerfectMoney');
            }
        }
    }
}