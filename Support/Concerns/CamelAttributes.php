<?php

namespace Maestro\Admin\Support\Concerns;

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

        return ($value) ? $value : $this->getAttributes($key);
    }

    /**
     * Tenta retornar um valor de um atributo escrito em camel case.
     *
     * @param mixed $key
     * @return string|null
     */
    private function getCamelAttribute(mixed $key) : ?string
    {
        return $this[$key] ?? null;
    }
    
    /**
     * Tenta retornar um valor de um atributo escrito em snake case.
     *
     * @param mixed $key
     * @return string|null
     */
    private function getSnakeCase(mixed $key)  : ?string
    {
        $field = Str::snake($key); 

        return $this[$field] ?? null;
    }
}