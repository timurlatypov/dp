<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersYandexMetrikaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('orders_ym', function (Blueprint $table) {
		    $table->integer('order_id')->unsigned();
		    $table->string('ym');
		    $table->timestamps();
		    $table->primary(['order_id', 'ym']);
	    });

	    Schema::table('orders_ym', function($table) {
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
        Schema::table('orders_ym', function (Blueprint $table) {
            //
        });
    }
}
