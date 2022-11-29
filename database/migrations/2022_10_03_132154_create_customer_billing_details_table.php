<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_billing_details', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->integer('billing_cycle_renew')->comment('in days');
            $table->float('due_amount');
            $table->float('total_amount');
            $table->integer('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('service_id')->nullable();
            // $table->foreign('service_id')->references('id')->on('services');

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
        Schema::dropIfExists('customer_billing_details');
    }
}
