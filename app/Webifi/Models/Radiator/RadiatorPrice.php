<?php

namespace App\Webifi\Models\Radiator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Webifi\Models\Radiator\RadiatorType;
use App\Webifi\Models\Radiator\RadiatorHeight;
use App\Webifi\Models\Radiator\RadiatorLength;

class RadiatorPrice extends Model
{
  use HasFactory;
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'radiator_type_id',
    'radiator_length_id',
    'radiator_height_id',
    'price',
    'btu',
    'user_id',
    'range',
    'watts',
    'publish'
  ];



    /**
     * The radiator type
     */
    public function radiator_type()
    {
        return $this->belongsTo(RadiatorType::class);
    }

    /**
     * The radiator height
     */
    public function radiator_height()
    {
        return $this->belongsTo(RadiatorHeight::class);
    }

    /**
     * The radiator length
     */
    public function radiator_length()
    {
        return $this->belongsTo(RadiatorLength::class);
    }

}
