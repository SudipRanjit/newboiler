<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolTipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_tip', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->text('hot_water_flow')->nullable();
            $table->text('central_heating')->nullable();
            $table->text('warranty')->nullable();
            $table->text('dimension')->nullable();
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
        Schema::dropIfExists('tool_tip');
    }
}
