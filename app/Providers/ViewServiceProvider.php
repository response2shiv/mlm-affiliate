<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'affiliates.dashboard.index',
//            'affiliates.partials.modals._foundation'
        ], 'App\Http\View\Composers\DashboardComposer');

        View::composer(
            'affiliates.sidebar',
            'App\Http\View\Composers\SidebarComposer'
        );

        View::composer(['affiliates.partials.modals._foundation', 'affiliates.partials.modals._checkout'], 'App\Http\View\Composers\HeaderFoundationComposer');

        View::composer('affiliates.tools.training', 'App\Http\View\Composers\DashboardComposer');
    }
}
