<?php

namespace App\Webifi\Models\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Webifi\Models\Booking\Order;
use App\Webifi\Models\Radiator\RadiatorType;
use App\Webifi\Models\Radiator\RadiatorHeight;
use App\Webifi\Models\Radiator\RadiatorLength;

class OrderDetail extends Model
{
    use HasFactory;

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'order_id',
    'product_id',
    'product',
    'price',
    'quantity',
    'radiator_type_id',
    'radiator_height_id',
    'radiator_length_id'
  ];

    /**
     * Get the order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the radiator type.
     */
    public function radiator_type()
    {
        return $this->belongsTo(RadiatorType::class);
    }

    /**
     * Get the radiator height.
     */
    public function radiator_height()
    {
        return $this->belongsTo(RadiatorHeight::class);
    }

    /**
     * Get the radiator length.
     */
    public function radiator_length()
    {
        return $this->belongsTo(RadiatorLength::class);
    }
}
