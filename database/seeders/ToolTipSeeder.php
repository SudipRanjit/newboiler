<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Webifi\Models\Boiler\ToolTip;
use Illuminate\Support\Facades\DB;

class ToolTipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      app(ToolTip::class)->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1');

      $data = [
        'id' => 1,
        'hot_water_flow' => "",
        'central_heating' => "",
        'warranty' => "",
        'dimension' => ""
        ];
  
        ToolTip::create($data);  
    }
}
