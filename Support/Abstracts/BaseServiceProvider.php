<?php

namespace Maestro\Admin\Support\Abstracts;

use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName;

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower;

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