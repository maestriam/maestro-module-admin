<?php

namespace Maestro\Admin\Support\Concerns;

use Maestro\Admin\Exceptions\ModelMethodNotExists;

trait PopulatesModule 
{
    /**
     * Gera uma certa quantidade de registros de entidades na base
     * de dados, com a finalidade de testes.  
     * Deve ser executada somente em ambientes de desenvolvimento. 
     *
     * @param integer $quantity
     * @return array
     */
    public function populate(int $quantity = 100, ...$args) : array
    {
        if (! method_exists($this, 'model')) {
            throw new ModelMethodNotExists($this);
        }

        $collection = [];

        for ($i=0; $i < $quantity; $i++) { 
            $collection[] = $this->model($args);
        }

        return $collection;
    }
}