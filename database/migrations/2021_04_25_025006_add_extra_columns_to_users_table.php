<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('referrer_id')
                ->after('id')
                ->nullable()
                ->constrained($table->getTable())
                ->onUpdate('cascade');

            $table->string('username', 20)
                ->after('email')
                ->unique();

            $table->string('phone', 20)
                ->unique()
                ->nullable()
                ->after('email');

            $table->string('country', 60)
                ->after('phone');

            $table->string('city', 35)
                ->nullable()
                ->after('country');

            $table->string('address')
                ->nullable()
                ->after('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('referrer_id');
            $table->dropColumn('phone');
            $table->dropColumn('username');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('address');
        });
    }
};
