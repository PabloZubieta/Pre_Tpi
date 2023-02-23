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
        Schema::create('carpooling', function (Blueprint $table) {
            $table->id();
            $table->dateTime('carpooling_time');
            $table->tinyInteger('carpooling_3/4');
            $table->tinyInteger('driver_validate');
            $table->foreign('place_id')->references('id')->on('places');
            $table->foreign('driver_id')->references('id')->on('users');
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
        Schema::dropIfExists('carpooling');
    }
};
