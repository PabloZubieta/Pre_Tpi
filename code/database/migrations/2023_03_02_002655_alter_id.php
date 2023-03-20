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
        //
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('place_id')->nullable()->references('id')->on('places');
            //->constrained();
        });

        Schema::table('users_has_carpooling', function (Blueprint $table) {
            $table->foreignId('users_id')->references('id')->on('users');
            $table->foreignid('carpooling_id')->references('id')->on('carpooling');
        });
        Schema::table('users_does_edt', function (Blueprint $table) {
            $table->foreignid('users_id')->references('id')->on('users');

        });
        Schema::table('carpooling', function (Blueprint $table) {
            $table->foreignId('place_id')->references('id')->on('places');
            $table->foreignid('driver_id')->references('id')->on('users');
        });





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
