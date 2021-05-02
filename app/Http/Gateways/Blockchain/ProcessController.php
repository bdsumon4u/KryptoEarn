<?php

namespace App\Http\Gateways\Blockchain;

use App\Http\Controllers\DepositController;
use App\Models\Deposit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProcessController extends Controller
{
    /*
     * Blockchain Pay Gateway
     */

    public static function process(Deposit $deposit)
    {
        $response = Http::get('https://chain.so/api/v2/get_info/BTC')->json();
        if ($response['status'] === 'success' && $response['data']['price_base'] === 'USD') {
            $btc_amount = round($deposit->payable / $response['data']['price'], 8);

            if ($deposit->btc_amount == 0 || !$deposit->btc_wallet) {
                $blockchain_receive_root = "https://api.blockchain.info/";
                $secret = config('gateway.setup.blockchain.secret');
                $my_xpub = config('gateway.setup.blockchain.xpub_key');
                $my_api_key = config('gateway.setup.blockchain.api_key');
                $invoice_id = $deposit->trx_id;
                $callback_url = route('ipn.'.$deposit->gateway) . "?invoice_id=" . $invoice_id . "&secret=" . $secret;

                $resp = Http::get($blockchain_receive_root . "v2/receive?key=" . $my_api_key . "&callback=" . urlencode($callback_url) . "&xpub=" . $my_xpub);
                $response = json_decode($resp);
                if ($btc_wallet = $response->address ?? '') {
                    $deposit->update(compact('btc_wallet', 'btc_amount'));
                } else {
                    $send['error'] = true;
                    $send['message'] = 'BLOCKCHAIN API HAVING ISSUE. PLEASE TRY LATER. ' . $response->message;
                }
            }

            $send['amount'] = $deposit->btc_amount;
            $send['sendto'] = $deposit->btc_wallet;

            $send['img'] = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl='.$send['sendto'] . "?amount=" . $send['amount'].'&choe=UTF-8';
            $send['currency'] = 'BTC';
            $send['view'] = 'user.payment.crypto';

            return json_encode($send);
        }
    }

    public function ipn(Request $request)
    {
        $value_in_btc = $_GET['value'] / 100000000;
        $deposit = Deposit::where('trx_id', $_GET['invoice_id'])->firstOrFail();
        if ($deposit->btc_amount === $value_in_btc && $_GET['address'] === $deposit->btc_wallet && $_GET['confirmations'] > 2 && $deposit->status === 'pending' && $_GET['secret'] === config('gateway.setup.blockchain.secret')) {
            DepositController::userDataUpdate($deposit, 'Bitcoin');
        }
    }
}
