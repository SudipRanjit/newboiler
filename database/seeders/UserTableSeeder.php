<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Webifi\Models\User\User;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      app(User::class)->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1');

      $data = [
        'name' => "Webifi Admin",
        'email' => "wordpress@webifi.co.uk",
        'password' => "Web(@N@33!99Nn",
        'active' => 1,
        'guard' => 'web',
        ];
  
        User::create($data);  
    }
}
