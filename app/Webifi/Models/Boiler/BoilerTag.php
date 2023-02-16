<?php

namespace App\Webifi\Models\Boiler;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Webifi\Models\Addon\Addon;

class BoilerTag extends Model
{
  use HasFactory;

  /**
   * Table Name
   * 
   * @var String
   */
  protected $table = "boiler_tags";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'tag_id',
    'boiler_id'
  ];

}
