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

            $table->string('city', 60)
                ->nullable()
                ->after('address');

            $table->string('road_no', 25)
                ->after('city');

            $table->string('postal_code', 25)
                ->after('road_no');

            $table->string('language', 25)
                ->after('postal_code');

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
            $table->dropColumn('road_no');
            $table->dropColumn('postal_code');
            $table->dropColumn('language');
            $table->dropColumn('country');
            $table->dropColumn('timezone');
        });
    }
};
