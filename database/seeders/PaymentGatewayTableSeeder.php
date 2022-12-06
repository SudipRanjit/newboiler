<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Webifi\Models\Booking\PaymentGateway;
use Illuminate\Support\Facades\DB;

class PaymentGatewayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      app(PaymentGateway::class)->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1');

      $data = [
        'title' => "Paypal"
        ];
  
        PaymentGateway::create($data);
        
        $data = [
            'title' => "Stripe"
            ];
      
        PaymentGateway::create($data);

        $data = [
            'title' => "Pay with Finance"
            ];
      
        PaymentGateway::create($data);
    }
}
