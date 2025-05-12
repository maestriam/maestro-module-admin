<?php

namespace Maestro\Admin\Support\Concerns;

use Maestriam\Maestro\Foundation\Registers\FileRegister;

trait RegistersDatabase
{
    private function registerSeeds() : self
    {
        $path = module_path($this->moduleName, '/Database/Seeders');

        FileRegister::from($path);

        return $this;
    }

    public function registerMigrations()
    {
        $dir  = 'Database/Migrations';
        $path = module_path($this->moduleName, $dir);

        $this->loadMigrationsFrom($path);
    }
}