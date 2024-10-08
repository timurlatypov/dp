<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_category', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();
        });

	    Schema::table('product_category', function (Blueprint $table) {
		    $table->foreign('category_id')
			    ->references('id')
			    ->on('categories')
			    ->onDelete('cascade');
		    $table->foreign('product_id')
			    ->references('id')
			    ->on('products')
			    ->onDelete('cascade');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_category');
    }
}
