<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRadiatorPriceIdToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            //
            
            $table->integer('radiator_price_id')->default(null)->nullable()->after('radiator_length_id');
            $table->float('radiator_btu')->default(null)->nullable()->after('radiator_price_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            //
            $table->dropColumn('radiator_price_id');
            $table->dropColumn('radiator_btu');

        });
    }
}
