<?php

namespace App\Webifi\Models\Quote;

use App\Webifi\Models\Boiler\Boiler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Webifi\Models\Addon\Addon;

class Quote extends Model
{
  use HasFactory;

  /**
   * Table Name
   * 
   * @var String
   */
  protected $table = "quotes";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'boiler',
    'selection',
    'email',
    'total_price',
    'offered_price',
    'contact',
    'saved_url',
    'token',
    'call_requested'
  ];

  /**
   * Quote has one boiler
   */
  public function quoteBoiler()
  {
    return $this->hasOne(Boiler::class, 'id', 'boiler');
  }

}
