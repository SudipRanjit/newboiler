<?php

namespace App\Providers;

use App\Webifi\Models\User\User;
use App\Webifi\Models\Category\Category;
use App\Webifi\Models\Brand\Brand;
use App\Webifi\Models\Power\Power;
use App\Webifi\Models\Media\Media;
use App\Webifi\Models\User\Role;
use App\Webifi\Models\Boiler\Boiler;
use App\Webifi\Models\Addon\Addon;
use App\Webifi\Models\Device\Device;
use App\Policies\UserPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\BrandPolicy;
use App\Policies\MediaPolicy;
use App\Policies\RolePolicy;
use App\Policies\PowerPolicy;
use App\Policies\BoilerPolicy;
use App\Policies\AddonPolicy;
use App\Policies\DevicePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
        Category::class => CategoryPolicy::class,
        Media::class => MediaPolicy::class,
        Brand::class => BrandPolicy::class,
        Power::class => PowerPolicy::class,
        Boiler::class => BoilerPolicy::class,
        Addon::class => AddonPolicy::class,
        Device::class => DevicePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
