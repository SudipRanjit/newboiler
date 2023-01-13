<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBoilersTableAddLatest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('boilers', function (Blueprint $table) {
        $table->integer('latest')->default(false)->nullable()->after('publish');
        $table->integer('popular')->default(false)->nullable()->after('publish');
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
        $table->dropColumn('latest');
        $table->dropColumn('popular');
      });
    }
}
