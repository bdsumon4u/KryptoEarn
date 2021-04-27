<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20)->unique();
            $table->integer('price')->unique();
            $table->integer('task_limit')->comment('Daily');
            $table->integer('earning_per_task')->default(0);
            $table->integer('ref_commission_on_each_task')->default(0);
            $table->integer('ref_commission_on_plan_upgrade')->default(0);
            $table->integer('maximum_referrals')->default(-1);
            $table->boolean('instant_payouts')->default(false);
            $table->integer('minimum_withdraw');
            $table->string('payout_days')->nullable();
            $table->integer('required_referrals_to_withdraw')->default(0);
            $table->integer('validity')->comment('Days');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
