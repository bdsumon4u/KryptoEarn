<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class WithdrawFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Withdraw::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $data['amount'] = $this->faker->numberBetween(100, 1000);
        $data['gateway'] = ['perfect-money', 'blockchain', 'payeer'][random_int(0, 2)];
        $charge = config('gateway.withdraw.'.$data['gateway'].'.fixed_charge', 0)
            + $data['amount'] * config('gateway.withdraw.'.$data['gateway'].'.percent_charge', 0) / 100;
        $data['charge'] = round($charge, 2);
        $data['receivable'] = $data['amount'] - $data['charge'];

        return array_merge($data, [
            'user_id' => User::query()->inRandomOrder()->firstOrFail()->getKey(),
            'trx_id' => Str::random(12),
        ]);
    }
}
