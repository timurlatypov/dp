<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(true);
            $table->string('banner_desktop');
            $table->string('banner_mobile');
            $table->string('bg_color', 7);
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
        Schema::dropIfExists('banners');
    }
}
