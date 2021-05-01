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

            $table->string('address')
                ->nullable()
                ->after('phone');

            $table->string('city', 255)
                ->nullable()
                ->after('address');

            $table->string('country', 60)
                ->after('city');

            $table->string('timezone', 60)
                ->after('country');
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
            $table->dropColumn('username');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('timezone');
        });
    }
};
