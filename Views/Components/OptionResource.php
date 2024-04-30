<?php

namespace Maestro\Admin\Views\Components;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class OptionResource extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'confirmed'
    ];

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

    public function mount()
    {        
        $this->initRoutes();
    }

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
    
    public function confirmed()
    {
        dd('xxxxx');
    }

    public function remove() 
    {  
        $this->alert('warning', 'Atenção', [
            'text' => 'Deseja realmente excluir este registro?',
            'timer' => null,
            'position' => 'center',
            'toast' => false,
            'showDenyButton' => true,
            'deniedButtonText' => 'Cancelar',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonText' => 'Confirmar',            
        ]);
    }
}