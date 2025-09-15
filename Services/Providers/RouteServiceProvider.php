<?php

namespace Maestro\Admin\Services\Providers;

use Illuminate\Support\Facades\Route;
use Maestro\Admin\Support\Concerns\RegistersRouters;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = 'Maestro\Admin\Http\Controllers';

    /**
     * Diretório onde está os arquivos de rotas. 
     * 
     * @var string
     */
    protected string $dir = '/Http/Routes/';

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

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        $group = $this->getRouteFile('web');

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group($group);
    }

    protected function mapLiveRoutes()
    {
        Route::middleware('web')
            ->namespace('Maestro\Admin\Views')
            ->group(module_path('Admin', '/Http/Routes/live.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        $api = $this->getRouteFile('api');

        Route::middleware('api')
             ->namespace($this->namespace)
             ->group($api)
             ->prefix('api');
    }

    /**
     * Retorna o caminho do arquivo de rotas. 
     * 
     * @param string $name
     * @return string
     */
    protected function getRouteFile(string $name) : string 
    {
        $file = "{$this->dir}{$name}.php";

        return module_path('Admin', $file);
    }
}
