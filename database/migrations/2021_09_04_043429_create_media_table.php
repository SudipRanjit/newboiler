<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
  public function up()
  {
    Schema::create('media', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->id();
      $table->string('name');
      $table->string('file_name');
      $table->string('url');
      $table->text('thumbnails');
      $table->unsignedInteger('size')->nullable();
      $table->string('resolution')->nullable();
      $table->timestamps();
    });
  }
}
