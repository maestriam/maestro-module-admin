<?php

namespace Maestro\Admin\Views;

use Livewire\Component;
use Illuminate\Contracts\View\View;

abstract class MaestroView extends Component
{
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
    protected string $pageTitle;

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
    public function renderView(array $params = []) : View
    {
        $base = $this->getBaseParams();

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
            'logout' => $this->logoutRoute
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