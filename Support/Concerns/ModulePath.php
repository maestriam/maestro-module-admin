<?php

namespace Maestro\Admin\Support\Concerns;

trait ModulePath
{
    /**
     * Retorna o caminho da fonte especificada,se baseando no módulo. 
     *
     * @param string $path
     * @return string
     */
    protected function modulePath(string $path) : string 
    {
        return module_path($this->moduleName, $path);
    }
}