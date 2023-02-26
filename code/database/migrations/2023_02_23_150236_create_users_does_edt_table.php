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
        Schema::create('users_does_edt', function (Blueprint $table) {
            $table->id();
            $table->foreign('edt_id')->references('id')->on('edt');
            $table->foreign('users_id')->references('id')->on('users');
            $table->dateTime('starting_hour');
            $table->dateTime('finnishing_hour');
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
        Schema::dropIfExists('users_does_edt');
    }
};