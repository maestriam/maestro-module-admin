<?php

namespace Maestro\Admin\Views;

use Livewire\Component;

abstract class MaestroView extends Component
{
    protected string $base = 'admin::components.base-view';

    protected string $view;

    protected string $pageTitle;

    public string $cardTitle;

    public function renderView()
    {
        return view($this->view)
                ->layout($this->base);
    }
}