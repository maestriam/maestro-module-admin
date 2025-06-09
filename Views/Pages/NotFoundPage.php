<?php

namespace Maestro\Admin\Views\Pages;

use Maestro\Admin\Views\MaestroView;

class NotFoundPage extends MaestroView
{
    /**
     * {@inheritDoc}
     */
    protected string $view = 'admin::pages.not-found';

    public string $pageTitle = 'Pagina não encontrada';

    public function render()
    {
        return $this->renderView($this->view);
    }
}