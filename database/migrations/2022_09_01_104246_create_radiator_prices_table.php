<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiatorPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiator_prices', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('radiator_type_id');
            $table->integer('radiator_height_id');
            $table->integer('radiator_length_id');
            $table->float('price');
            $table->float('btu');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('radiator_prices');
    }
}
