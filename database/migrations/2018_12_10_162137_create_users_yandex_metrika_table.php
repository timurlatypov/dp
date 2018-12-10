<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersYandexMetrikaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('users_ym', function (Blueprint $table) {
		    $table->integer('user_id')->unsigned();
		    $table->string('ym');
		    $table->timestamps();
		    $table->primary(['user_id', 'ym']);
	    });

	    Schema::table('users_ym', function($table) {
		    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_ym', function (Blueprint $table) {
            //
        });
    }
}
