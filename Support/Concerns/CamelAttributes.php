<?php

namespace Maestro\Admin\Support\Concerns;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait CamelAttributes 
{
    /**
     * Converte os campos escritos em snake case para camel case.
     *
     * @param string $key
     * @return void
     */
    public function __get(mixed $key) 
    {           
        $value = $this->getCamelAttribute($key);
        
        if ($value) return $value;        
               
        $value = $this->getSnakeCase($key);
        
        if ($value) return $value;
        
        $key = Str::snake($key);

        return $this->getLaravelModelAttribute($key);    
    }

    /**
     * Tenta retornar um valor de um atributo escrito em camel case.
     *
     * @param mixed $key
     * @return string|null
     */
    private function getCamelAttribute(mixed $key) 
    {
        if (isset($this[$key])) return $this[$key];

        return property_exists($this, $key) ? $this[$key] : null;
    }
    
    /**
     * Tenta retornar um valor de um atributo escrito em snake case.
     *
     * @param mixed $key
     * @return string|null
     */
    private function getSnakeCase(mixed $key) : mixed
    {
        $field = Str::snake($key); 

        if (isset($this[$field])) return $this[$field];

        return property_exists($this, $field) ? $this[$key] : null;        
    }

    private function getLaravelModelAttribute(mixed $key)
    {
        if (! is_a($this, Model::class)) return null;

        $field = Str::snake($key); 

        return $this->getAttribute($field);
    }
}