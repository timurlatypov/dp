<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('address_name')->nullable();
	        $table->string('billing_city')->nullable();
	        $table->string('billing_street')->nullable();
	        $table->string('billing_house')->nullable();
	        $table->string('billing_apartment')->nullable();
	        $table->string('billing_entrance')->nullable();
	        $table->string('billing_floor')->nullable();
	        $table->string('billing_comment')->nullable();

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
        Schema::dropIfExists('addresses');
    }
}
