<?php

namespace App\View\Components;

use App\Charts\VoucherSells as VoucherSellsChart;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\View\Component;

class VoucherSells extends Component
{
    public User $user;
    public VoucherSellsChart $voucherSells;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $records = Voucher::where('owner_id', $user->id)
            ->where('created_at', '>', now()->subWeek())->get()
            ->groupBy(function ($user) {
                return $user->created_at->day;
            })->mapWithKeys(function ($rows, $day) {
                return [$day => $rows->sum('amount')];
            })->toArray();

        $data = fill_weekly($records);

        $this->voucherSells = new VoucherSellsChart();
        $this->voucherSells->labels(array_keys($data));
        $this->voucherSells->dataset('Voucher Sells', 'line', array_values($data))
            ->backgroundColor('blue');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.voucher-sells');
    }

    public function shouldRender()
    {
        return $this->user->is_partner;
    }
}
