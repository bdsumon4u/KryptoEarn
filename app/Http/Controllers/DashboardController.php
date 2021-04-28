<?php

namespace App\Http\Controllers;

use App\Charts\BalanceDivision;
use App\Charts\DirectReferrals;
use App\Charts\WalletReport;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
        $user->load(['wallets', 'transactions.wallet']);
        $referral_count = $user->referred()->count();
        $transactions = $user->transactions()->with('wallet')->latest()->take(5)->get();

        $referred = $this->lastWeek($user->referred(), function ($rows, $day) {
            return [$day => $rows->count()];
        });

        $walletTransaction = $user->transactions()->with('wallet');
        $deposits = $this->lastWeek($walletTransaction->where('type', Transaction::TYPE_DEPOSIT));
        $withdraws = $this->lastWeek($walletTransaction->where('type', Transaction::TYPE_WITHDRAW), null,true);

        $divisions = $user->transactions()->with('wallet')->get()->groupBy(function ($transaction) {
            return ucfirst($transaction->wallet->name);
        })->mapWithKeys(function ($transactions, $wallet) {
            return [$wallet => round($transactions->sum->amountFloat, 2)];
        })->toArray();

        $directReferrals = new DirectReferrals();
        $directReferrals->labels(array_keys($referred));
        $directReferrals->dataset('Direct Referrals', 'line', array_values($referred))
            ->backgroundColor('blue');

        $walletReport = new WalletReport();
        $walletReport->labels(array_keys($deposits));
        $walletReport->dataset('Credit ($)', 'line', array_values($deposits))
            ->color('green');
        $walletReport->dataset('Debit ($)', 'line', array_values($withdraws))
            ->color('red');

        $balanceDivision = new BalanceDivision();
        $balanceDivision->labels(array_keys($divisions));
        $balanceDivision->dataset('Divisions', 'pie', array_values($divisions))
            ->backgroundColor(collect(['red', 'green', 'blue']));

        return view('user.dashboard', compact('user', 'referral_count', 'directReferrals', 'walletReport', 'transactions', 'balanceDivision'));
    }

    private function lastWeek($builder, callable $cb = null, bool $abs = false): array
    {
        $records = $builder->where('created_at', '>', now()->subWeek())->get()
            ->groupBy(function ($user) {
                return $user->created_at->day;
            })->mapWithKeys($cb ?? static function ($rows, $day) use ($abs) {
                $amount = round($rows->sum->amountFloat, 2);
                return [$day => $abs ? abs($amount) : $amount];
            })->toArray();

        $today = now()->day;
        $data = array_fill(now()->subWeek()->day + 1, 7, 0);
        foreach ($data as $day => $count) {
            $data[$day === $today ? 'Today' : $day] = data_get($records, $day, 0);
        }

        return $data;
    }
}
