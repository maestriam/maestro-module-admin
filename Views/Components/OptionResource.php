<?php

namespace Maestro\Admin\Views\Components;

use Livewire\Component;
use Livewire\Attributes\On;
use Maestro\Admin\Support\Concerns\WithAlerts;

class OptionResource extends Component
{
    use WithAlerts;

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
    public string $id = "";

    /**
     * Rota de edição do recurso
     *
     * @var string
     */
    protected string $edit;

    /**
     * Rota de visualização do recurso
     *
     * @var string
     */
    protected string $view;

    public function __construct()
    {        
        $this->initRoutes();
    }

    /**
     * Inicia as rotas principais do módulo
     *
     * @return self
     */
    public function initRoutes() : self
    {
        $this->edit = $this->getRoute('edit');
        $this->view = $this->getRoute('view');

        return $this;
    }

    protected function getRoute(string $action) : string
    {
        $route = sprintf("maestro.%s.%s", $this->module, $action);
        
        return route($route, $this->id);
    }

    /**
     * Renderiza a view do menu lateral
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin::components.option-resource');
    }
    
    #[On('admin::option-resource:delete')]
    public function confirmed()
    {
        dd('remove....');
    }

    /**
     * Evento executado quando o usuário clica em remover registro. 
     *
     * @return void
     */
    protected function remove()
    {
        $title =  __('admin::modals.delete.title');
        $text  =  __('admin::modals.delete.text');

        $this->displayDeleteModalComponent($title, $text);
    }
    
    /**
     * Exibe o modal para confirmar a exclusão do registro. 
     *
     * @param string $title
     * @param string $text
     * @return void
     */
    protected function displayDeleteModalComponent(string $title, string $text) 
    {          
        $this->alert('warning', $title, [
            'timer'             => null,
            'toast'             => false,
            'showDenyButton'    => true,
            'showConfirmButton' => true,
            'reverseButtons'    => true,
            'html'              => $text,
            'position'          => 'center',
            'onConfirmed'       => 'admin::option-resource:delete',
            'denyButtonText'    => __('admin::modals.delete.cancel'),
            'confirmButtonText' => __('admin::modals.delete.confirm'),            
        ]);
    }
}