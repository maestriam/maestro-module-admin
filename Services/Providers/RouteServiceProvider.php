<?php

namespace Maestro\Admin\Services\Providers;

use Maestro\Admin\Support\Concerns\RegistersRouters;
use Maestro\Admin\Support\Concerns\HasModuleName;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    use HasModuleName,
        RegistersRouters;

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapLiveRoutes();        
    }
}
