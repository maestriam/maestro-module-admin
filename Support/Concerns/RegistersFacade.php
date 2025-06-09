<?php

namespace Maestro\Admin\Support\Concerns;

use Exception;

/**
 * Função auxiliar para registro de facade do módulo.  
 * Deve ser utilizada somente no service provider principal do módulo 
 * e a classe deve possuir o atributo string $facade, 
 * com o nome da classe que deverá ser a origem do facade.  
 * Ex: protected string $facade = MeuFacade::class;
 */
trait RegistersFacade
{
    /**
     * Registra o facade de suporte, para fornecer
     * funcionalidades para outros módulos.
     *     
     * @return self
     */ 
    protected final function registerFacade() : self
    {   
        if (! $this->hasFacadeProperty()) {
            throw new Exception('Facade property not defined. Define your $facade property as string and set the facade class name');
        }
        
        $facade = $this->facade;
        
        $this->app->bind($this->moduleNameLower, function () use($facade) {
            return new $facade();
        });

        return $this;
    }

    /**
     * Verifica se a propriedade $facade
     *
     * @return boolean
     */
    private function hasFacadeProperty() : bool
    {
        $prop = 'facade';

        return (property_exists($this, $prop) && $this->facade != null);
    }
}