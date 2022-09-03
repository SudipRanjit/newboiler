<?php

namespace App\Webifi\Models\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Webifi\Models\Booking\Order;
use App\Webifi\Models\Radiator\RadiatorType;
use App\Webifi\Models\Radiator\RadiatorHeight;
use App\Webifi\Models\Radiator\RadiatorLength;
use App\Webifi\Models\Boiler\Boiler;
use App\Webifi\Models\Addon\Addon;
use App\Webifi\Models\Radiator\Radiator;
use App\Webifi\Models\Radiator\RadiatorPrice;
use App\Webifi\Models\Device\Device;

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
    'discount',
    'quantity',
    'radiator_type_id',
    'radiator_height_id',
    'radiator_length_id',
    'radiator_price_id',
    'radiator_btu',
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

    /**
     * Get the boiler.
     */
    public function boiler()
    {
        return $this->product=='Boiler'? app(Boiler::class)->where('id',$this->product_id)->first():null;
    }

    /**
     * Get the addon.
     */
    public function addon()
    {
        return $this->product=='Addon'? app(Addon::class)->where('id',$this->product_id)->first():null;
    }

    /**
     * Get the radiator.
     */
    public function radiator()
    {
        return $this->product=='Radiator'? app(Radiator::class)->where('id',$this->product_id)->first():null;
    }

    /**
     * Get the radiator price.
     */
    public function radiator_price()
    {
        return $this->product=='Radiator'? app(RadiatorPrice::class)->where('id',$this->radiator_price_id)->first():null;
    }

    /**
     * Get the device.
     */
    public function device()
    {
        return $this->product=='Device'? app(Device::class)->where('id',$this->product_id)->first():null;
    }
}
