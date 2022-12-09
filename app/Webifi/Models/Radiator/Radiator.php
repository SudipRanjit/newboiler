<?php

namespace App\Webifi\Models\Radiator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiator extends Model
{
  use HasFactory;
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'radiator_name',
    'user_id',
    'summary',
    'description',
    'image',
    'publish'
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
    return limitText($this->summary, 30);
  }
}
