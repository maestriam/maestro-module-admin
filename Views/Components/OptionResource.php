<?php

namespace Maestro\Admin\Views\Components;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Route;
use Maestro\Admin\Support\Enums\Livewire;
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
    protected ?string $edit;

    /**
     * Rota de visualização do recurso
     *
     * @var string
     */
    protected ?string $view;

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
        $this->view = $this->getRoute('view') ?? $this->getRoute('info');

        return $this;
    }

    /**
     * Retorna uma rota válida de acordo com o nome de 
     * uma ação específica. 
     * Caso a rota não exista, deve retornar nulo.  
     *
     * @param string $action
     * @return ?string
     */
    protected function getRoute(string $action) : ?string
    {
        $name = sprintf("maestro.%s.%s", $this->module, $action);
        
        return Route::has($name) ? route($name, $this->id) : null;
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
    
    #[On(Livewire::OPTION_RESOURCE_ON_DELETE->value)]
    public function confirmed()
    {
        dd('remove....');
    }

    /**
     * Evento executado quando o usuário clica em remover registro. 
     *
     * @return void
     */
    public function remove()
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
            'onConfirmed'       => Livewire::OPTION_RESOURCE_ON_DELETE->value,
            'denyButtonText'    => __('admin::modals.delete.cancel'),
            'confirmButtonText' => __('admin::modals.delete.confirm'),            
        ]);
    }
}