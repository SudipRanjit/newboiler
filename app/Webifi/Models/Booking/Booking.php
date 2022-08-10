<?php

namespace App\Webifi\Models\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Webifi\Models\Booking\Order;

class Booking extends Model
{
  use HasFactory;

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'order_id',
    'booking_id',
    'appointment_date',
    'amount',
    'discount',
    'status'
  ];

  /**
   * Get the order.
   */
  public function order()
  {
      return $this->belongsTo(Order::class);
  }

}
