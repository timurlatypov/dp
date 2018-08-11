<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->nullable();
	        $table->string('image_path')->nullable();
	        $table->string('brand_image_path')->nullable();
	        $table->string('slug')->unique();
	        $table->string('name');
	        $table->string('title')->nullable();;
	        $table->longText('description');
	        $table->string('meta_title')->nullable();;
	        $table->string('meta_description')->nullable();;
	        $table->string('meta_keywords')->nullable();;
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
        Schema::dropIfExists('brands');
    }
}
