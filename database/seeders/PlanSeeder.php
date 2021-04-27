<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::query()->truncate();

        Plan::insert([
            [
                'name' => 'Startar',
                'price' => 0,
                'task_limit' => 2,
                'earning_per_task' => 60,
                'ref_commission_on_each_task' => 10,
                'ref_commission_on_plan_upgrade' => 20,
                'minimum_withdraw' => 10,
                'validity' => 10,
            ],
            [
                'name' => 'Basic',
                'price' => 15,
                'task_limit' => 3,
                'earning_per_task' => 70,
                'ref_commission_on_each_task' => 10,
                'ref_commission_on_plan_upgrade' => 20,
                'minimum_withdraw' => 20,
                'validity' => 35,
            ],
            [
                'name' => 'Standard',
                'price' => 40,
                'task_limit' => 5,
                'earning_per_task' => 80,
                'ref_commission_on_each_task' => 15,
                'ref_commission_on_plan_upgrade' => 20,
                'minimum_withdraw' => 50,
                'validity' => 95,
            ],
            [
                'name' => 'Super',
                'price' => 100,
                'task_limit' => 8,
                'earning_per_task' => 80,
                'ref_commission_on_each_task' => 20,
                'ref_commission_on_plan_upgrade' => 25,
                'minimum_withdraw' => 80,
                'validity' => 180,
            ],
            [
                'name' => 'Ultra',
                'price' => 150,
                'task_limit' => 12,
                'earning_per_task' => 80,
                'ref_commission_on_each_task' => 20,
                'ref_commission_on_plan_upgrade' => 25,
                'minimum_withdraw' => 80,
                'validity' => 360,
            ],
        ]);
    }
}
