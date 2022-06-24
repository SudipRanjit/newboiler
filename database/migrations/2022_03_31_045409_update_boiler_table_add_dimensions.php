<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBoilerTableAddDimensions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boilers', function (Blueprint $table) {
            $table->string('height')->after('measurements')->nullable();
            $table->string('width')->after('height')->nullable();
            $table->string('depth')->after('width')->nullable();
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boilers', function (Blueprint $table) {
            $table->dropColumn('height');
            $table->dropColumn('width');
            $table->dropColumn('depth');
        });
    }
}
