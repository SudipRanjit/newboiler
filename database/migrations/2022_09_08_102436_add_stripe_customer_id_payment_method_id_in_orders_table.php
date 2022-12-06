<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStripeCustomerIdPaymentMethodIdInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->string('stripe_customer_id')->default(null)->nullable()->after('vendor_transaction_id');
            $table->string('stripe_payment_method_id')->default(null)->nullable()->after('stripe_customer_id');
            $table->string('stripe_setup_intent_id')->default(null)->nullable()->after('stripe_payment_method_id');
            if (Schema::hasColumn('orders', 'card_payment')) {
                Schema::table('orders', function ($table) {
                    $table->dropColumn('card_payment');
                });
            }
            
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('stripe_customer_id');
            $table->dropColumn('stripe_payment_method_id');
            $table->dropColumn('stripe_setup_intent_id');
            
        });
    }
}
