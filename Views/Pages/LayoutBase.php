<?php

namespace Maestro\Admin\Views\Pages;

use Livewire\Component;

class LayoutBase extends Component
{
    /**
     * Exibe a view do componente
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin::components.base-view');
    }
}