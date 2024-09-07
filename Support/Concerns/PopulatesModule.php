<?php

namespace Maestro\Admin\Support\Concerns;

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
    public function populate(int $quantity = 100) : array
    {
        $collection = [];

        for ($i=0; $i < $quantity; $i++) { 
            $collection[] = $this->model();
        }

        return $collection;
    }
}