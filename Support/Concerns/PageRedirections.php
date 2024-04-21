<?php

namespace Maestro\Admin\Support\Concerns;

trait PageRedirections
{    
    /**
     * Redireciona para a tela de página não encontrada. 
     *
     * @return mixed
     */
    private function goToPageNotFound() : mixed
    {
        return redirect()->route('maestro.admin.not-found');
    }
}