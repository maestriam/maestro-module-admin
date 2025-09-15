<?php

namespace Maestro\Admin\Services\Providers;

use Livewire\Livewire;
use Maestro\Admin\Views\BaseView;
use Illuminate\Support\ServiceProvider;
use Maestro\Admin\Views\Pages\NotFoundPage;
use Maestro\Admin\Views\Components\SideBar;
use Maestro\Admin\Views\Components\WidgetRow;
use Maestro\Admin\Views\Pages\ServerErrorPage;
use Maestro\Admin\Views\Components\ActionMenu;
use Maestro\Admin\Views\Components\UserDropDown;
use Maestro\Admin\Support\Concerns\RegistersViews;

class ViewServiceProvider extends ServiceProvider
{
    use RegistersViews;

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
    public function boot() : void
    {
        $this->init();
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
        Livewire::component('admin.option-resource', ActionMenu::class);
        
        $this->app['config']['layout'] = 'admin::components.base-view';
    }
}