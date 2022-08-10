<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('payment_gateway_id');
            $table->bigInteger('billing_address_id')->default(null)->nullable();
            $table->string('transaction_id')->comment('system generated unique token to display in invoice and reports');
            $table->string('vendor_token')->comment('stripe, paypal token');
            $table->float('amount');
            $table->float('discount')->default(0);
            $table->float('conversion_charge')->default(0)->comment('charge for converting to a Combi boiler');
            $table->float('moving_boiler_charge')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0 = incomplete, 1 = complete');
            $table->boolean('card_payment')->default(0)->comment('0 = payment not using card, 0 = payment using card');
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
        Schema::dropIfExists('orders');
    }
}
