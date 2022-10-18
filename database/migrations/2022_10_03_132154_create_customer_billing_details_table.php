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
            $table->integer('product_id')->nullable();
            $table->integer('service_id')->nullable();


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
