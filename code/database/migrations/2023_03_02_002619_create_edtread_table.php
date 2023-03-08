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
        Schema::create('edtread', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('duree',4)->nullable();
            $table->string('frequence',3)->nullable();
            $table->string('professeur',50)->nullable();
            $table->string('abrev',3)->nullable();
            $table->string('codemat',15)->nullable();
            $table->string('classe',350)->nullable();
            $table->tinyInteger('jour',3)->nullable();
            $table->tinyInteger('heure',4)->nullable();
            $table->string('semaines',50)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edtread');
    }
};
