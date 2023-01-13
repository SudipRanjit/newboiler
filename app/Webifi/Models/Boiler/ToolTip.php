<?php

namespace App\Webifi\Models\Boiler;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Webifi\Models\Addon\Addon;

class ToolTip extends Model
{
  use HasFactory;

  /**
   * Table Name
   * 
   * @var String
   */
  protected $table = "tool_tip";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'hot_water_flow',
    'central_heating',
    'warranty',
    'dimension'
  ];

}
