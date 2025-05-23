<?php

namespace Maestro\Admin\Providers;

use Livewire\Livewire;
use Maestro\Admin\Views\BaseView;
use Illuminate\Support\Facades\Config;
use Maestro\Admin\Views\Pages\NotFoundPage;
use Maestro\Admin\Views\Components\SideBar;
use Maestro\Admin\Views\Pages\ServerErrorPage;
use Maestro\Admin\Views\Components\UserDropDown;
use Maestro\Admin\Support\Abstracts\ViewProvider;
use Maestro\Admin\Views\Components\OptionResource;
use Maestro\Admin\Views\Components\WidgetRow;

class ViewServiceProvider extends ViewProvider
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
     * {@inheritDoc}
     */
    protected string $root = 'Resources';

    /**
     * {@inheritDoc}
     */
    public function boot() : void
    {
        parent::boot();
        $this->registerPages();
        $this->registerComponents();
    }

    /**
     * {@inheritDoc}
     */
    protected function registerPages() : void
    {        
        Livewire::component('admin.not-found-page', NotFoundPage::class);
        Livewire::component('admin.server-error-page', ServerErrorPage::class);
    }

    /**
     * {@inheritDoc}
     */
    protected function registerComponents() : void
    {
        Livewire::component('admin.sidebar', SideBar::class);        
        Livewire::component('admin.base-view', BaseView::class);        
        Livewire::component('admin:widget-row', WidgetRow::class);
        Livewire::component('admin.user-dropdown', UserDropDown::class);
        Livewire::component('admin.option-resource', OptionResource::class);
        
        $this->app['config']['layout'] = 'admin::components.base-view';
    }
}