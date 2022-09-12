<?php

namespace App\Webifi\Models\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Webifi\Models\Booking\PaymentGateway;
use App\Webifi\Models\Booking\BillingAddress;
use App\Webifi\Models\Booking\OrderDetail;
use App\Webifi\Models\Booking\Booking;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'payment_gateway_id',
    'billing_address_id',
    'transaction_id',
    'vendor_transaction_id',
    'amount',
    'discount',
    'conversion_charge',
    'moving_boiler_charge',
    'moving_boiler_to',
    'status',
    'stripe_customer_id',
    'stripe_payment_method_id',
    'stripe_setup_intent_id',
    'payout_amount'
    ];

    /**
     * Get the payment gateway.
     */
    public function payment_gateway()
    {
        return $this->belongsTo(PaymentGateway::class);
    }

    /**
     * Get the billing address.
     */
    public function billing_address()
    {
        return $this->belongsTo(BillingAddress::class);
    }

    /**
     * Get the booking.
     */
    public function booking()
    {
        return $this->hasOne(Booking::class);
    }

    /**
     * Get the order details for the order.
     */
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }



}
