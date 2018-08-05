<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersProductsFavoritePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_products', function (Blueprint $table) {
	        $table->integer('user_id')->unsigned();
	        $table->integer('product_id')->unsigned();

	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

	        $table->primary(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_products', function (Blueprint $table) {
            //
        });
    }
}
