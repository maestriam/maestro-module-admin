<?php

namespace Maestro\Admin\Views;

use Livewire\Component;

class OptionResource extends Component
{
    /**
     * Nome do módulo que fornecerá as rotas de recursos
     *
     * @var string
     */
    public string $module = "";

    /**
     * Id do recurso 
     *
     * @var string
     */
    public string $resourceId = "";

    /**
     * Rota de edição do recurso
     *
     * @var string
     */
    private string $edit;

    /**
     * Rota de visualização do recurso
     *
     * @var string
     */
    private string $view;

    public function initRoutes()
    {
        $this->edit = $this->getRoute('edit');
        $this->view = $this->getRoute('view');
    }

    private function getRoute(string $action) : string
    {
        $route = sprintf("maestro.%s.%s", $this->module, $action);
        
        return route($route, $this->resourceId);
    }

    /**
     * Renderiza a view do menu lateral
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->initRoutes();

        return view('admin::components.option-resource');
    }

    public function remove() 
    {    
    }
}