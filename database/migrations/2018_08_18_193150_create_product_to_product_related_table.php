<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductToProductRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_related', function (Blueprint $table) {
	        $table->integer('product_id')->unsigned();
	        $table->integer('related_id')->unsigned();

	        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
	        $table->foreign('related_id')->references('id')->on('products')->onDelete('cascade');

	        $table->primary(['product_id', 'related_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_related');
    }
}
