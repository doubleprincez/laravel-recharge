<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialUserBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_user_bonuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unique()->unsigned();
            $table->integer('recharge_bonus')->default(10);
            $table->integer('data_bonus')->default(10);
            $table->integer('cable_bonus')->default(10);
            $table->integer('electricity_bonus')->default(10);
            $table->integer('referrer_bonus')->default(10);
            $table->integer('top_up')->default(10);
            $table->integer('wallet_to_wallet')->default(10);
            $table->integer('activation_bonus')->default(10);
            $table->softDeletes();
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
        Schema::dropIfExists('special_user_bonuses');
    }
}
