<?php

namespace Maestro\Admin\Views\Pages;

use Maestro\Admin\Views\Pages\MaestroView;

class NotFoundPage extends MaestroView
{
    /**
     * {@inheritDoc}
     */
    protected string $view = 'admin::pages.not-found';

    /**
     * Título da página exibida na barra de título do navegador.
     *
     * @var string
     */
    public string $pageTitle = 'Pagina não encontrada';

    /**
     * Renderiza o layout da página.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return $this->renderView($this->view);
    }
}