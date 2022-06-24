<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addons', function (Blueprint $table) {
          $table->engine = 'InnoDB';
          $table->id();
          $table->string('addon_name');
          $table->integer('user_id');
          $table->float('price');
          $table->text('summary')->default(null)->nullable();
          $table->text('description')->default(null)->nullable();
          $table->string('image')->default('no-image.png')->nullable();
          $table->boolean('publish')->default(false);
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
        Schema::dropIfExists('addons');
    }
}
