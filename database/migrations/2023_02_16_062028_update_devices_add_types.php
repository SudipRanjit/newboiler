<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDevicesAddTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->boolean('combi')->default(false)->after('publish');
            $table->boolean('standard')->default(false)->after('publish');
            $table->boolean('system')->default(false)->after('publish');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn('combi');
            $table->dropColumn('standard');
            $table->dropColumn('system');
        });
    }
}
