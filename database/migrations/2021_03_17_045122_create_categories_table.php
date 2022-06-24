<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('categories', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->id();
      $table->string("category");
      $table->integer("parent")->nullable()->default(0);
      $table->string("slug")->unique();
      $table->boolean("publish")->nullable()->default(true);
      $table->string("type");
      $table->string("boiler_type")->nullable();
      $table->text("description")->nullable();
      $table->string("url")->nullable();
      $table->boolean("show_in_menu")->nullable()->default(false);
      $table->string("icon_light")->nullable()->default("default.png");
      $table->string("icon_dark")->nullable()->default("default.png");
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
    Schema::dropIfExists('categories');
  }
}
