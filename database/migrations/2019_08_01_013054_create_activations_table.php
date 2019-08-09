<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('installment')->default(false);
            $table->float('amount')->nullable();
            $table->float('balance')->nullable();
            $table->string('customer_code')->nullable();
            $table->string('reference');
            $table->string('transaction_id')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('paid_at');
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
        Schema::dropIfExists('activations');
    }
}
