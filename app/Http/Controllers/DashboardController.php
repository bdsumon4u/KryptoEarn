<?php

namespace App\Http\Controllers;

use App\Charts\BalanceDivision;
use App\Charts\DirectReferrals;
use App\Charts\WalletReport;
use App\Models\User;
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
        $user = $request->user()->load(['wallets']);
        $referral_count = $user->referred()->count();

        $transactions = last_week_user_transactions($user)->take(5);
        $directReferrals = $this->directReferrals($user);
        $walletReport = $this->walletReport(last_week_user_transactions($user));
        $balanceDivision = $this->balanceDivision($user);

        return view('user.dashboard', compact('user', 'referral_count', 'directReferrals', 'walletReport', 'transactions', 'balanceDivision'));
    }

    private function directReferrals(User $user): DirectReferrals
    {
        $records = $user->referred()->where('created_at', '>', now()->subWeek())->get()
            ->groupBy(function ($user) {
                return $user->created_at->day;
            })->mapWithKeys(function ($rows, $day) {
                return [$day => $rows->count()];
            })->toArray();

        $data = fill_weekly($records);

        $directReferrals = new DirectReferrals();
        $directReferrals->labels(array_keys($data));
        $directReferrals->dataset('Direct Referrals', 'line', array_values($data))
            ->backgroundColor('blue');

        return $directReferrals;
    }

    public function walletReport($last_week_transactions): WalletReport
    {
        $credits = $this->getLastWeekWalletData($last_week_transactions,Transaction::TYPE_DEPOSIT);
        $debits = $this->getLastWeekWalletData($last_week_transactions,Transaction::TYPE_WITHDRAW);

        $walletReport = new WalletReport();
        $walletReport->labels(array_keys($credits));
        $walletReport->dataset('Credit ($)', 'line', array_values($credits))
            ->color('green');
        $walletReport->dataset('Debit ($)', 'line', array_values($debits))
            ->color('red');

        return $walletReport;
    }

    public function getLastWeekWalletData($last_week_transactions, string $type): array
    {
        $records = $last_week_transactions
            ->filter(function ($transaction) use ($type) {
                return $transaction->type === $type;
            })
            ->groupBy(function ($user) {
                return $user->created_at->day;
            })->mapWithKeys(function ($rows, $day) {
                    return [$day => abs(round($rows->sum->amountFloat, 2))];
                })->toArray();

        return fill_weekly($records);
    }

    private function balanceDivision(User $user): BalanceDivision
    {
        $divisions = $user->transactions()->with('wallet')->get()->groupBy(function ($transaction) {
            return ucfirst($transaction->wallet->name);
        })->mapWithKeys(function ($transactions, $wallet) {
            return [$wallet => round($transactions->sum->amountFloat, 2)];
        })->toArray();

        $balanceDivision = new BalanceDivision();
        $balanceDivision->labels(array_keys($divisions));
        $balanceDivision->dataset('Divisions', 'pie', array_values($divisions))
            ->backgroundColor(collect(['red', 'green', 'blue']));

        return $balanceDivision;
    }
}
