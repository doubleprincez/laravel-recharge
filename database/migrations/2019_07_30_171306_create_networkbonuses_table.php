<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNetworkbonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('networkbonuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('network_id');
            $table->string('General_name');
            $table->string('bonus%');
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
        Schema::dropIfExists('networkbonuses');
    }
}
