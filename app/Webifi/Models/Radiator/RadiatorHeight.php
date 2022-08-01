<?php

namespace App\Webifi\Models\Radiator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiatorHeight extends Model
{
  use HasFactory;
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'height',
    'user_id'
  ];
}
