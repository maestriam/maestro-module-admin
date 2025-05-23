<?php

namespace Maestro\Admin\Views\Components;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class WidgetRow extends Component
{
    /**
     * Coleção de componentes que serão renderizadas na linha. 
     *
     * @var Collection
     */
    public Collection $components;

    /**
     * Propriedades compartilhadas do componente pai.
     *
     * @var array
     */
    public array $props = [];

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('admin::components.widget-row');
    }

    /**
     * Retorna a combinação das propriedades compartilhadas 
     * do componente pai com as propriedades passadas diretamente
     * para o widget. 
     *
     * @return array
     */
    #[Computed]
    public function merge(?array $params = []) : array
    {
        return array_merge($this->props, $params);
    }
}