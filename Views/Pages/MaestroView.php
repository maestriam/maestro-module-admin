<?php

namespace Maestro\Admin\Views\Pages;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use Maestro\Admin\Support\Concerns\WithAlerts;
use Maestro\Admin\Support\Concerns\FlashMessages;
use Maestro\Admin\Support\Concerns\PageRedirections;

abstract class MaestroView extends Component
{
    use FlashMessages,
        WithAlerts,
        PageRedirections;

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
    protected string $view = '';

    /**
     * Título da página HTML
     *
     * @var string
     */
    public string $pageTitle = "Maestriam Blueprint";

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
     * @param string|null $view
     * @param array $params
     * @return View
     */
    public function renderView(?string $view = null, array $params = []) : View
    {
        $base = $this->getBaseParams();
        
        $params = array_merge($params, $base);    

        return view($view, $params)->layout($this->base, $base);
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