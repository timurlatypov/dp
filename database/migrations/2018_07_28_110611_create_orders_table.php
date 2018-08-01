<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('order_details');
            $table->enum('order_status', ['Новый', 'В работе', 'Доставлен', 'Отменен']);

            $table->boolean('coupon')->default(false);
            $table->longText('coupon_details')->nullable();

	        $table->integer('user_id')->unsigned()->nullable();
	        $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');

	        $table->string('billing_name')->nullable();
	        $table->string('billing_surname')->nullable();
	        $table->string('billing_phone')->nullable();
	        $table->string('billing_email')->nullable();
	        $table->string('billing_city')->nullable();
	        $table->string('billing_street')->nullable();
	        $table->string('billing_house')->nullable();
	        $table->string('billing_apartment')->nullable();
	        $table->string('billing_entrance')->nullable();
	        $table->string('billing_floor')->nullable();
	        $table->string('billing_comment')->nullable();
	        $table->integer('billing_subtotal')->nullable();
	        $table->integer('billing_delivery')->nullable();
	        $table->integer('billing_total')->nullable();
	        
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
        Schema::dropIfExists('orders');
    }
}
