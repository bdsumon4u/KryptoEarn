<?php

namespace App\Http\Gateways\Coinbase;

use App\Http\Controllers\DepositController;
use App\Models\Deposit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /*
     * coinbase Gateway 506
     */

    /**
     * @throws \JsonException
     */
    public static function process($deposit)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.commerce.coinbase.com/charges');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-CC-Api-Key: ' . setting('gateway', 'coinbase_api_key'),
            'X-CC-Version: 2018-03-22',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'name' => auth()->user()->username,
            'description' => 'Hi dear '.auth()->user()->name.', you can pay using Bitcoin to our '.config('app.name').' with the help of Coinbase Commerce.',
            'local_price' => [
                'amount' => $deposit->payable,
                'currency' => $deposit->currency,
            ],
            'metadata' => [
                'trx' => $deposit->trx_id,
            ],
            'pricing_type' => "fixed_price",
            'redirect_url' => route('dashboard'),
            'cancel_url' => route('dashboard')
        ], JSON_THROW_ON_ERROR));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true, 512, JSON_THROW_ON_ERROR);

        if (!isset($data['error'])) {
            $send['redirect'] = true;
            $send['redirect_url'] = $result['data']['hosted_url'];
        } else {
            $send['error'] = true;
            $send['message'] = 'Some Problem Occurred. Try Again';
        }

        $send['view'] = '';
        return json_encode($send, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws \JsonException
     */
    public function ipn()
    {
        $payload = file_get_contents("php://input");
        $response = json_decode($payload, true, 512, JSON_THROW_ON_ERROR);
        $deposit = Deposit::with('user')->where('trx_id', $response['event']['data']['metadata']['trx'])->firstOrFail();
        $headers = apache_request_headers();
        $sentSign = $headers['X-Cc-Webhook-Signature'];
        $sign = hash_hmac('sha256', $payload, setting('gateway', 'coinbase_secret'));
        if (($sentSign === $sign) && $response['event']['type'] === 'charge:confirmed' && $deposit->status === 'pending') {
            DepositController::userDataUpdate($deposit, 'coinbase');
        }
    }
}
