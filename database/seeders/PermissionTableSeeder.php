<?php

namespace Database\Seeders;

use App\Webifi\Permissions\SettingPermission;
use App\Webifi\StorePermissions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
  /**
     * @var array
     */
    protected $permissions = [
      //\App\Webifi\Permissions\CategoryPermission::class,
      \App\Webifi\Permissions\BrandPermission::class,
      //\App\Webifi\Permissions\PowerPermission::class,
      \App\Webifi\Permissions\AddonPermission::class,
      \App\Webifi\Permissions\BoilerPermission::class,
      \App\Webifi\Permissions\ToolTipPermission::class,
      \App\Webifi\Permissions\DevicePermission::class,
      \App\Webifi\Permissions\UserPermission::class,
      \App\Webifi\Permissions\RadiatorPermission::class,
      \App\Webifi\Permissions\BookingPermission::class,
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');
      DB::table('modules')->truncate();
      DB::table('permissions')->truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS=1');       

      foreach ($this->permissions as $permission){
        StorePermissions::add(app($permission)->store());
      }
    }
}
