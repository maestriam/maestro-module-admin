<?php

namespace Maestro\Admin\Views\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Maestro\Admin\Support\Enums\Livewire;
use Maestro\Admin\Support\Concerns\WithAlerts;

class ActionMenu extends Component
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
     * @var integer
     */
    public ?int $id = null;

    /**
     * Rota de edição do recurso
     *
     * @var string
     */
    protected ?string $editRoute;

    /**
     * Rota de visualização do recurso
     *
     * @var string
     */
    protected ?string $viewRoute;

    /**
     * Mensagem do modal de exclusão de recurso.
     *
     * @var string
     */
    public string $modalText;

    /**
     * Título do modal de exclusão de recurso.
     *
     * @var string
     */
    public string $modalTitle;

    /**
     * Texto do toast que será exibido depois da exclusão de recurso.
     *
     * @var string
     */
    public string $toastText;

    /**
     * Título do toast que será exibido depois da exclusão de recurso.
     *
     * @var string
     */
    public string $toastTitle;

    /**
     * Arquivo HTML do componente.
     *
     * @var string
     */
    protected string $view = 'admin::components.action-menu';

    /**
     * {@inheritDoc}
     */
    public function __construct()
    {        
        $this->initModal()
             ->initToast()
             ->initRoutes();
    }

    /**
     * Inicia as propriedades do modal de exclusão.
     *
     * @return self
     */
    protected function initModal() : self
    {
        $this->modalText  = __("$this->module::modals.delete.text");
        $this->modalTitle = __("$this->module::modals.delete.title");

        return $this;
    }

    /**
     * Inicia as propriedades do toast de exclusão.
     *
     * @return self
     */
    protected function initToast() : self
    {
        $this->toastText  = __("$this->module::modals.deleted.text");
        $this->toastTitle = __("$this->module::modals.deleted.title");

        return $this;
    }

    /**
     * Inicia as rotas principais do módulo
     * 
     * @return self
     */
    protected function initRoutes() : self
    {
        $this->editRoute = $this->getRoute('edit');
        $this->viewRoute = $this->getRoute('info');

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
        $id = $this->id ?? ""; 

        $name = sprintf("maestro.%s.%s", $this->module, $action);

        return Route::has($name) ? route($name, $id) : null;
    }

    /**
     * Renderiza o componente.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view($this->view);
    }

    /**
     * Evento executado quando o usuário clica na ação de remover 
     * registro. 
     *
     * @return void
     */
    public function remove() 
    {
        $event = Livewire::ACTION_MENU_ON_DELETE->value .".$this->id";

        $this->confirm($this->modalTitle, $this->modalText, $event);
    }

    /**
     * Exibe um toast de confirmação indicando que o 
     * recurso foi excluído com sucesso.
     *
     * @return void
     */
    protected function deletionToast() : void
    {
        $this->toast($this->toastTitle, $this->toastText);
    }
}