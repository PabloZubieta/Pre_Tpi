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
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->string('username',3)->unique();
            $table->string('last_name',50)->nullable();
            $table->string('email',200)->nullable();
            $table->string('password',64)->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('active')->default(0);
            $table->tinyInteger('car_seat')->nullable();
            $table->engine ='innoDB';
            //$table->foreignId('place_id')->references('id')->on('places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
