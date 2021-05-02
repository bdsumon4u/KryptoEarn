<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->string('trx_id', 12)->unique();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->string('gateway');
            $table->integer('amount');
            $table->integer('charge');
            $table->integer('payable');
            $table->string('currency', 10)->default('USD');
            $table->string('btc_wallet')->nullable();
            $table->integer('btc_amount')->default(0);
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('deposits');
    }
}
