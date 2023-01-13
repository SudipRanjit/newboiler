<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'cms.layouts.partials._nav','App\Http\ViewComposers\CMSSideBarComposer'
        );
        View::composer(
          'pages.layouts.partials._tooltip', 'App\Http\ViewComposers\ToolTipComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
