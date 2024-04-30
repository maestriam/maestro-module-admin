<?php

namespace Maestro\Admin\Providers;

use Illuminate\Support\Facades\Config;
use Livewire\Livewire;
use Maestro\Admin\Views\BaseView;
use Illuminate\Support\ServiceProvider;
use Maestro\Admin\Console\SetupCommand;
use Maestro\Admin\Views\Pages\NotFoundPage;
use Maestro\Admin\Views\Components\Sidebar;
use Maestro\Admin\Views\Components\UserDropDown;
use Maestro\Admin\Views\Components\OptionResource;
use Maestriam\Maestro\Foundation\Registers\FileRegister;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Admin';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'admin';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerSeeds();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
        $this->registerComponents();
        $this->registerHelpers();
        $this->registerCommands();
    }

    public function registerComponents()
    {
        Livewire::component('admin.sidebar', Sidebar::class);        
        Livewire::component('admin.base-view', BaseView::class);        
        Livewire::component('admin.user-dropdown', UserDropDown::class);
        Livewire::component('admin.option-resource', OptionResource::class);
        Livewire::component('admin.not-found-page', NotFoundPage::class);
        
        $this->app['config']['layout'] = 'admin::components.base-view';
    }

    public function registerCommands()
    {
        $this->commands([SetupCommand::class]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(QueryBuilderServiceProvider::class);
    }

    /**
     * Registra o arquivo de configuração do módulo. 
     * 
     * @return void
     */
    protected function registerConfig() : void
    {

        $file = 'Resources/config/config.php';
        $path = module_path($this->moduleName, $file);
        
        $target = config_path($this->moduleNameLower . '.php');

        $this->publishes([$path => $target], 'config');
        $this->mergeConfigFrom($path, $this->moduleNameLower);
    }

    public function registerHelpers()
    {
        $folder = '/Support/Helpers/*.php';
        $helpers = module_path($this->moduleName, $folder);

        foreach (glob($helpers) as $filename){
            require_once($filename);
        }
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([$sourcePath => $viewPath], [
            'views', 
            $this->moduleNameLower . '-module-views'
        ]);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
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

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }

    private function registerSeeds() : self
    {
        $path = __DIR__ . '/../Database/Seeders';

        FileRegister::from($path);

        return $this;
    }
}
