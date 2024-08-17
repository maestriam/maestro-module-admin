<?php

namespace Maestro\Admin\Views;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Layout;
use Maestro\Admin\Support\Concerns\FlashMessages;

abstract class MaestroView extends Component
{
    use FlashMessages;

    /**
     * Caminho do arquivo-base para exibição do painel.
     *
     * @var string
     */
    protected string $base = 'admin::components.base-view';

    /**
     * Caminho do arquivo de view do componente
     *
     * @var string
     */
    protected string $view;

    /**
     * Título da página HTML
     *
     * @var string
     */
    public string $pageTitle = "Maestro";

    /**
     * Título do card de conteúdo principal. 
     *
     * @var string
     */
    public string $cardTitle;

    /**
     * Rota para fazer logout no sistema. 
     *
     * @var string
     */
    public string $logoutRoute = '';

    public function __construct()
    {
        $route = route('maestro.users.logout');
        
        $this->setLogoutRoute($route);
    }

    /**
     * Renderiza o arquivo de view do componente,
     * utilizando o layout base do dashboard Maestro. 
     *
     * @param array $params
     * @return View
     */
    public function renderView(string $view = null, array $params = []) : View
    {
        $base = $this->getBaseParams();

        $view = $view ?? $this->view;

        $params = array_merge($params, $base);    

        return view($this->view, $params)->layout($this->base, $base);
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    private function getBaseParams() : array
    {
        return [
            'logout'    => $this->logoutRoute,
            'pageTitle' => $this->pageTitle
        ];
    }

    /**
     * Define o caminho de rota de logout do sistema. 
     *
     * @param string $route
     * @return self
     */
    public function setLogoutRoute(string $route) : self
    {
        $this->logoutRoute = $route;

        return $this;
    }
}