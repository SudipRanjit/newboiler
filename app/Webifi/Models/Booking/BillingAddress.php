<?php

namespace App\Webifi\Models\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'first_name',
     'last_name',
     'email',
     'contact_number',
     'address_line_1',
     'address_line_2',
     'address_line_3',
     'city',
     'county',
     'postcode',
     'note'
  ];

}
