<?php

namespace Maestro\Admin\Services\Providers;

use Maestro\Admin\Console\SetupCommand;
use Illuminate\Support\ServiceProvider;
use Maestro\Admin\Support\Concerns\HasModuleName;
use Maestro\Admin\Support\Concerns\RegistersFacade;
use Maestro\Admin\Support\Concerns\RegistersDatabase;

class MainServiceProvider extends ServiceProvider
{
    use HasModuleName,
        RegistersFacade,
        RegistersDatabase;

    /**
     * Inicia os eventos do módulo.
     *
     * @return void
     */
    public function boot()
    {   
        $this->registerMigrations();
        $this->registerSeeds();
        $this->registerCommands();
        $this->registerHelpers();
    }

    /**
     * Registra os comandos disponíveis do módulo. 
     *
     * @return void
     */
    public function registerCommands()
    {
        $this->commands([SetupCommand::class]);
    }

    /**
     * Registra os services providers disponíveis do módulo.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(ViewServiceProvider::class);
        $this->app->register(QueryBuilderServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Registra os helpers do módulo. 
     *
     * @return void
     */
    public function registerHelpers()
    {
        $folder = '/Support/Helpers/*.php';
        $helpers = module_path($this->moduleName, $folder);

        foreach (glob($helpers) as $filename){
            require_once($filename);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
