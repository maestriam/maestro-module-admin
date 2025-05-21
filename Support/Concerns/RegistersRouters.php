<?php

namespace Maestro\Admin\Support\Concerns;

use Illuminate\Support\Facades\Route;

trait RegistersRouters
{
    use ModulePath;

    /**
     * Caminho raíz do recurso. 
     *
     * @var string
     */
    protected string $root = 'Http/Routes';

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        $file = $this->getPath('web.php');

        Route::middleware('web')
            ->namespace($this->ctrlNamespace())
            ->group($file);
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
        $file = $this->getPath('api.php');

        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->ctrlNamespace())
            ->group($file);
    }

    protected function mapLiveRoutes()
    {
        $file = $this->getPath('live.php');

        Route::middleware('web')
            ->namespace($this->wireNamespace())
            ->group($file);
    }

    /**
     * Retorna o caminho onde está o arquivo de rota. 
     *
     * @param string $path
     * @return string
     */
    private function getPath(string $path) : string
    {
        $source = $this->root .'/' . $path;

        return $this->modulePath($source);
    }

    /**
     * Retorna o namespace onde é encontrado os controllers 
     * de um determinado módulo. 
     *
     * @return string
     */
    private function ctrlNamespace() : string
    {
        $default = 'Maestro\%s\Http\Controllers';

        return $this->mountNamespace('controllerNamespace', $default);
    }

    /**
     * Retorna o namespace onde é encontrado os componentes livewire 
     * de um determinado módulo. 
     *
     * @return string
     */
    private function wireNamespace() : string
    {
        $default = 'Maestro\%s\Views';

        return $this->mountNamespace('livewireNamespace', $default);
    }

    /**
     * Retorna um determinado namespace de acordo com uma 
     * propriedade específica, implementada no Service Provider de 
     * Router, ou um valor default caso ela não tenha sido implementada. 
     *
     * @param string $prop
     * @param string $default
     * @return string
     */
    private function mountNamespace(
        string $prop, 
        string $default
    ) : string {            
        return (property_exists($this, $prop)) ? 
            $this->$prop : sprintf($default, $this->moduleName);
    }
}