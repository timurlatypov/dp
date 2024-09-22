<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWebpColumnsToBannersTable extends Migration
{
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('banner_desktop_webp')->nullable()->after('banner_desktop');
            $table->string('banner_mobile_webp')->nullable()->after('banner_mobile');
        });
    }

    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('banner_desktop_webp');
            $table->dropColumn('banner_mobile_webp');
        });
    }
}