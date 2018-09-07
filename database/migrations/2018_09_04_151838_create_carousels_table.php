<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('image_path');
	        $table->string('hex', 6)->nullable();
	        $table->integer('order_id')->nullable();

	        $table->string('title')->nullable();
	        $table->string('title_hex', 6)->nullable();

	        $table->string('body')->nullable();
	        $table->string('body_hex',6)->nullable();

	        $table->string('brand')->nullable();
	        $table->string('button')->nullable();
	        $table->string('link')->default('#');
	        $table->boolean('live')->default(false);
	        $table->timestamp('expired_at')->nullable();
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
        Schema::dropIfExists('carousels');
    }
}
