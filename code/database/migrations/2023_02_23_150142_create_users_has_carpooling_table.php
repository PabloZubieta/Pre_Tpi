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
        Schema::create('users_has_carpooling', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_confirm');
            //$table->foreign('users_id')->references('id')->on('users');
            //$table->foreign('carpooling_id')->references('id')->on('carpooling');
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
        Schema::dropIfExists('users_has_carpooling');
    }
};
