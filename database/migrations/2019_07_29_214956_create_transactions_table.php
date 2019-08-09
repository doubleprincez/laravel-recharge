<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subscriber_id');
            $table->string('type');
            $table->string('transaction_id')->nullable();
            $table->string('reference');
            $table->string('service_id')->nullable();
            $table->string('service_code')->nullable();
            $table->string('status')->nullable();
            $table->string('service_name')->nullable();
            $table->float('amount',8,2)->default(0);
            $table->dateTime('paid_at')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
