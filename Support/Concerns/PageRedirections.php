<?php

namespace Maestro\Admin\Support\Concerns;

trait PageRedirections
{    
    /**
     * Redireciona para a tela de página não encontrada. 
     *
     * @return mixed
     */
    protected function pageNotFound() : mixed
    {
        return redirect()->route('maestro.admin.not-found');
    }

    protected function pageServerError()
    {
        return redirect()->route('maestro.admin.server-error');
    }
}