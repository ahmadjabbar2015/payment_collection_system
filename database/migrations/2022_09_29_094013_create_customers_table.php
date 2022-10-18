<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('prefix')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile_no');
            $table->string('alt_number')->nullable();
            $table->string('email');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('address')->nullable();
            $table->string('business')->nullable();
            $table->string('business_description')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
