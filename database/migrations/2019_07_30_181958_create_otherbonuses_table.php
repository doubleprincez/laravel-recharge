<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherbonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otherbonuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('card_bonus');
            $table->string('travelling_bonus');
            $table->string('monthly_bonus');
            $table->string('festival_bonus');
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
        Schema::dropIfExists('otherbonuses');
    }
}
