<?php

namespace App\Webifi\Models\Boiler;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Webifi\Models\Addon\Addon;

class Boiler extends Model
{
  use HasFactory;

  /**
   * Table Name
   * 
   * @var String
   */
  protected $table = "boilers";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'boiler_name',
    'user_id',
    'addon_id',
    'price',
    'brand',
    'category',
    'power_range',
    'type',
    'discount',
    'summary',
    'description',
    'in_stock',
    'sku',
    'image',
    'gallery',
    'publish',
    'latest',
    'popular',
    'measurements',
    'height',
    'width',
    'depth',
    'warranty',
    'boiler_type',
    'fuel_type',
    'solar_compatibility',
    'flow_rate',
    'central_heating_output',
    'hot_water_output',
    'effiency_rating',
  ];

    /**
     * The addon that belong to the boiler.
     */
    public function addon()
    {
        return $this->belongsTo(Addon::class);
    }

    /**
     * The addons that belong to the boiler.
     */
    public function addons()
    {
        return $this->belongsToMany(Addon::class, 'boiler_addons')->withTimestamps();
    }

    
    /**
     * The tags that belong to the boiler.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'boiler_tags')->withTimestamps();
    }

    /**
     * The features that belong to the boiler.
     */
    public function features()
    {
        return $this->belongsToMany(BoilerFeature::class, 'boiler_features_pivot')->withTimestamps();
    }
}
