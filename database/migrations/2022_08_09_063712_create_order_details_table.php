<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->bigInteger('order_id');
            $table->bigInteger('product_id')->comment('should be either boiler_id, addon_id, radiator_id or device_id');
            $table->string('product')->comment('should be either Boiler, Addon, Radiator or Device');
            $table->float('price');
            $table->integer('quantity');
            $table->integer('radiator_type_id');
            $table->integer('radiator_height_id');
            $table->integer('radiator_length_id');
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
        Schema::dropIfExists('order_details');
    }
}
