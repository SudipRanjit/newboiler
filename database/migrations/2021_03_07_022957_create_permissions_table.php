<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('permissions', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->id();
      $table->string('name');
      $table->string('slug', 190)->unique();
      $table->text('description')->nullable();
      $table->integer('module_id')->unsigned();
      $table->boolean('view_on_sidebar')->default(false);
      $table->string('menu_name')->nullable();
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
    Schema::dropIfExists('permissions');
  }
}
