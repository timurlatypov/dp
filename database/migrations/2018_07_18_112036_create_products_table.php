<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
	        $table->increments('id');
	        $table->unsignedInteger('brand_id');
	        $table->unsignedInteger('order_id');
	        $table->string('slug')->unique();
	        $table->string('title_eng')->nullable();
	        $table->string('title_rus')->nullable();
	        $table->unsignedInteger('price');
	        $table->string('image_path')->nullable();
	        $table->string('thumb_path')->nullable();
	        $table->string('ph')->nullable();
	        $table->string('description_short');
	        $table->longText('description_full');
	        $table->string('meta_title')->nullable();
	        $table->string('meta_description')->nullable();
	        $table->string('meta_keywords')->nullable();
	        $table->string('meta_robots')->nullable();
	        $table->boolean('live')->default(false);
	        $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
}
