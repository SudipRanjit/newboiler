<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRangeWattsPublishInRadiatorPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('radiator_prices', function (Blueprint $table) {
            //
            $table->string('range')->default(null)->nullable()->after('btu');
            $table->float('watts')->default(null)->nullable()->after('range');
            $table->boolean('publish')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('radiator_prices', function (Blueprint $table) {
            //
            $table->dropColumn('range');
            $table->dropColumn('watts');
            $table->dropColumn('publish');
        });
    }
}
