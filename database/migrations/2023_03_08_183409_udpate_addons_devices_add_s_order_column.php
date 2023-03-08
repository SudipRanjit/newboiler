<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UdpateAddonsDevicesAddSOrderColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addons', function (Blueprint $table) {
            $table->integer('s_order')->default(0)->nullable()->after('publish');
        });
        Schema::table('devices', function (Blueprint $table) {
            $table->integer('s_order')->default(0)->nullable()->after('publish');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addons', function (Blueprint $table) {
            $table->dropColumn('s_order');
        });
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn('s_order');
        });
    }
}
