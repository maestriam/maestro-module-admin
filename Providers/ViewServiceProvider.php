<?php

namespace Maestro\Admin\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Maestro\Admin\Views\BaseView;
use Maestro\Admin\Views\Components\OptionResource;
use Maestro\Admin\Views\Components\SideBar;
use Maestro\Admin\Views\Components\UserDropDown;
use Maestro\Admin\Views\Pages\NotFoundPage;
use Maestro\Admin\Views\Pages\ServerErrorPage;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Admin';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'admin';

    public function boot()
    {
        $this->registerViews();
        $this->registerPages();
        $this->registerComponents();
    }

    /**
     * Registra as views 
     *
     * @return void
     */
    private function registerPages()
    {        
        Livewire::component('admin.not-found-page', NotFoundPage::class);
        Livewire::component('admin.server-error-page', ServerErrorPage::class);
    }

    public function registerComponents()
    {
        Livewire::component('admin.sidebar', SideBar::class);        
        Livewire::component('admin.base-view', BaseView::class);        
        Livewire::component('admin.user-dropdown', UserDropDown::class);
        Livewire::component('admin.option-resource', OptionResource::class);
        
        $this->app['config']['layout'] = 'admin::components.base-view';
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
}