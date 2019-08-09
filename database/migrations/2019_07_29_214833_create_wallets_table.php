<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('owner_id');
            $table->float('wallet_balance',8,2)->default(0.0);
            $table->float('card_bonus',8,2)->default(0.0);
            $table->float('travelling_bonus',8,2)->default(0.0);
            $table->float('monthly_bonus',8,2)->default(0.0);
            $table->float('festival_bonus',8,2)->default(0.0);
            $table->boolean('special')->default(false);
            $table->float('special_bonus',8,2)->default(0.0);
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
        Schema::dropIfExists('wallets');
    }
}
