<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaction_id')->unsigned();
            $table->integer('amount');
            $table->string('method')->comment('card or cash');
            $table->string('card_transaction_number')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_type')->nullable();
            $table->string('card_holder_name')->nullable();
            $table->string('card_month')->nullable();
            $table->string('card_year')->nullable();
            $table->string('card_security')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->bigInteger('created_by');
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
        Schema::dropIfExists('transaction_payments');
    }
}
