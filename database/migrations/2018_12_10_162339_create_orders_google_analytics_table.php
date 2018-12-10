<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersGoogleAnalyticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('orders_ga', function (Blueprint $table) {
		    $table->integer('order_id')->unsigned();
		    $table->string('ga');
		    $table->timestamps();
		    $table->primary(['order_id', 'ga']);
	    });

	    Schema::table('orders_ga', function($table) {
		    $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_ga', function (Blueprint $table) {
            //
        });
    }
}
