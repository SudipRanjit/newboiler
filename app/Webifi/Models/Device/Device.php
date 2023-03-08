<?php

namespace App\Webifi\Models\Device;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
  use HasFactory;

  /**
   * Table Name
   * 
   * @var String
   */
  protected $table = "devices";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'device_name',
    'user_id',
    'price',
    'summary',
    'description',
    'image',
    'publish',
    'system',
    'standard',
    'combi',
    's_order'
  ];

  protected $appends = [
    'limited_summary'
  ];

  /**
   * Limited summary
   * 
   * @return String
   */
  public function getLimitedSummaryAttribute() {
    return limitText($this->summary, 20);
  }
}
