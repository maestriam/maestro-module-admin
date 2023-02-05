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
     * Renderiza o arquivo de view do componente,
     * utilizando o layout base do dashboard Maestro. 
     *
     * @param array $params
     * @return View
     */
    public function renderView(array $params = []) : View
    {
        return view($this->view, $params)->layout($this->base);
    }
}