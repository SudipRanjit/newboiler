<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->bigInteger('order_id');
            $table->string('booking_id')->comment('system generated unique token to display in invoice and reports');
            $table->date('appointment_date');
            $table->float('amount');
            $table->float('discount')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0 = ongoing, 1 = completed, 2 = canceled');
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
        Schema::dropIfExists('bookings');
    }
}
