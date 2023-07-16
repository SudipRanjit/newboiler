<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddonsTableAddTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addons', function (Blueprint $table) {
            $table->boolean('system_boiler')->default(false)->nullable()->after('image');
            $table->boolean('standard_boiler')->default(false)->nullable()->after('image');
            $table->boolean('combi_boiler')->default(false)->nullable()->after('image');
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
            $table->dropColumn('system_boiler');
            $table->dropColumn('standard_boiler');
            $table->dropColumn('combi_boiler');
        });
    }
}
