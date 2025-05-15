<?php

namespace Maestro\Admin\Support\Concerns;

use Maestro\Admin\Services\Foundation\PageControl;

trait ControlsPages
{
    /**
     * Retorna um serviço auxiliar para manipulação de páginas 
     * do projeto em tempo de execução. 
     *
     * @return PageControl
     */
    public function pageControl() : PageControl
    {
        return app()->make(PageControl::class);
    }
}