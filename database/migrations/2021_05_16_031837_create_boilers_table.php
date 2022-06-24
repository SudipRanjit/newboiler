<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoilersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('boilers', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->id();
      $table->string('boiler_name');
      $table->integer('user_id');
      $table->float('price');
      $table->integer('addon_id')->nullable();
      $table->integer('brand')->nullable();
      $table->integer('category')->nullable();
      $table->integer('power_range')->nullable();
      $table->integer('type')->nullable();
      $table->float('discount')->default(0)->nullable();
      $table->text('summary')->default(null)->nullable();
      $table->text('description')->default(null)->nullable();
      $table->integer('in_stock')->default(0)->nullable();
      $table->string('sku')->default(null)->nullable();
      $table->string('image')->default('no-image.png')->nullable();
      $table->text('gallery')->default(null)->nullable();
      $table->boolean('publish')->default(false);
      $table->string('measurements')->nullable();
      $table->string('warranty')->nullable();
      $table->string('boiler_type')->nullable();
      $table->string('fuel_type')->nullable();
      $table->string('solar_compatibility')->nullable();
      $table->string('flow_rate')->nullable();
      $table->string('central_heating_output')->nullable();
      $table->string('hot_water_output')->nullable();
      $table->string('effiency_rating')->nullable();
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
    Schema::dropIfExists('products');
  }
}
