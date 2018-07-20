<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lines', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('order_id')->nullable();
	        $table->string('image_path')->nullable();
	        $table->string('slug')->unique();
	        $table->string('name');
	        $table->string('description')->nullable();
	        $table->longText('body')->nullable();
            $table->timestamps();
        });

	    Schema::table('lines', function($table) {
		    $table->integer('brand_id')->unsigned();
		    $table->foreign('brand_id')
			    ->references('id')
			    ->on('brands')
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
        Schema::dropIfExists('lines');
    }
}
