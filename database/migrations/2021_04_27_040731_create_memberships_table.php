<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade');
            $table->foreignId('plan_id')
                ->constrained()
                ->onUpdate('cascade');

            $table->string('type', 10)
                ->default('premium');
            $table->integer('task_limit');
            $table->integer('task_completed')
                ->default(0);
            $table->timestamp('tomorrow')
                ->useCurrent();
            $table->timestamp('valid_till')
                ->nullable();
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
        Schema::dropIfExists('memberships');
    }
}
