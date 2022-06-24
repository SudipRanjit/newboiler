<?php

namespace App\Webifi\Models\Addon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
  use HasFactory;

  /**
   * Table Name
   * 
   * @var String
   */
  protected $table = "addons";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'addon_name',
    'user_id',
    'price',
    'summary',
    'description',
    'image',
    'publish'
  ];
}
