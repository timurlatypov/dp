<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image_path');
            $table->string('link')->nullable();
            $table->integer('sort_order');
            $table->boolean('live')->default(false);
            $table->timestamp('published_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('expired_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('promotions');
    }
}
