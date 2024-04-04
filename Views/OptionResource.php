<?php

namespace Maestro\Admin\Views;

use Livewire\Component;

class OptionResource extends Component
{
    /**
     * Renderiza a view do menu lateral
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin::components.option-resource');
    }
}