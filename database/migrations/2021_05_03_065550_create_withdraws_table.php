<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->string('trx_id', 12)->unique();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->string('gateway');
            $table->integer('amount');
            $table->integer('charge');
            $table->integer('receivable');
            $table->string('currency', 10)->default('USD');
            $table->string('btc_wallet')->nullable();
            $table->integer('btc_amount')->default(0);
            $table->string('status', 10)
                ->default('pending')
                ->index();
            $table->string('screenshot')->nullable();
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
        Schema::dropIfExists('withdraws');
    }
}
