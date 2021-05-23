<?php

namespace App\Http\Controllers\Admin;

use App\Charts\TransactionReport;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Membership;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $credits;
    private $debits;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $tab = $request->get('tab', 'weekly');

        $transactionReport = $this->transactionReport($tab);
        $credits = array_sum($this->credits);
        $debits = array_sum($this->debits);
        $remains = $credits - $debits;

        return view('admin.dashboard', compact('tab', 'transactionReport', 'credits', 'debits', 'remains') + [
            'total_deposits' => cache()->remember('deposits:total', 5 * 60, function () {
                return Deposit::whereStatus('completed')->sum('amount') / 100;
            }),
            'total_withdraws' => cache()->remember('withdraws:total', 5 * 60, function () {
                return Withdraw::whereStatus('completed')->sum('amount') / 100;
            }),
            'total_users' => cache()->remember('users:total', 5 * 60, function () {
                return User::count();
            }),
            'premium_users' => cache()->remember('users:premium', 5 * 60, function () {
                return Membership::query()->where('type', 'premium')->count();
            }),
        ]);
    }

    private function transactionReport($tab)
    {
        $this->credits = cache()->remember('credits:'.$tab, 5 * 60, function () use ($tab) {
            return $this->getTransactionForTab($tab, Deposit::whereStatus('completed'));
        });
        $this->debits = cache()->remember('debits:'.$tab, 5 * 60, function () use ($tab) {
            return $this->getTransactionForTab($tab, Withdraw::whereStatus('completed'));
        });

        $transactionReport = new TransactionReport();
        $transactionReport->labels(array_keys($this->credits));
        $transactionReport->dataset('Deposit USD', 'line', array_values($this->credits))
            ->color('blue');
        $transactionReport->dataset('Withdraw USD', 'line', array_values($this->debits))
            ->color('red');


        return $transactionReport;
    }

    private function getTransactionForTab($tab, $query)
    {
        $records = $query#->where('status', 'completed')
            ->when($tab === 'weekly', function ($query) {
                $query->where('created_at', '>', now()->subWeek());
            })
            ->when($tab === 'monthly', function ($query) {
                $query->where('created_at', '>', now()->subMonth());
            })
            ->when($tab === 'yearly', function ($query) {
                $query->where('created_at', '>', now()->subYear());
            })->get()
            ->groupBy(function ($record) use ($tab) {
                if ($tab === 'weekly') {
                    return $record->created_at->day;
                }
                if ($tab === 'monthly') {
                    return $record->created_at->day;
                }
                if ($tab === 'yearly') {
                    return $record->created_at->shortMonthName;
                }
            })
            ->mapWithKeys(function ($val, $key) {
                return [$key => abs(round($val->sum->amount, 2))];
            })->toArray();

        return $this->{'fill'.ucfirst($tab)}($records);
    }

    private function fillWeekly($records)
    {
        $data = array_fill(now()->subWeek()->day + 1, 7, 0);
        foreach ($data as $day => $count) {
            if (now()->get('day') < 7 && $day > ($prevLastDay = now()->subWeek()->lastOfMonth()->day)) {
                unset($data[$day]);
                $day -= $prevLastDay;
                $data[$day] = 0;
            }
            if ($day === now()->get('day')) {
                $data['Today'] = data_get($records, $day, 0);
                unset($data[$day]);
            } else {
                $data[$day] = data_get($records, $day, 0);
            }
        }

        return $data;
    }

    private function fillMonthly($records)
    {
        return collect(array_fill(now()->firstOfMonth()->day, now()->lastOfMonth()->day, 0))
            ->mapWithKeys(function ($val, $key) use ($records) {
                return [$key => data_get($records, $key, 0)];
            })
            ->toArray();
    }

    private function fillYearly($records)
    {
        $firstOfYear = now()->firstOfYear();
        return collect(array_fill(0, 12, 0))
            ->mapWithKeys(function ($val, $key) use ($firstOfYear, $records) {
                $mon = $firstOfYear->copy()->addMonths($key)->shortMonthName;
                return [$mon => data_get($records, $mon, 0)];
            })
            ->toArray();
    }
}
