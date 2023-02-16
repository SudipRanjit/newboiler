<?php

namespace App\Webifi\Models\Boiler;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Webifi\Models\Addon\Addon;

class Tag extends Model
{
  use HasFactory;

  /**
   * Table Name
   * 
   * @var String
   */
  protected $table = "tags";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'tag'
  ];

}
