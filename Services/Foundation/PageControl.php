<?php

namespace Maestro\Admin\Services\Foundation;

use UnitEnum;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class PageControl
{
    protected string $pageName;

    /**
     * Define o nome da página que será manipulada. 
     *
     * @param string $name
     * @return self
     */
    public function page(string $name) : self
    {
        $this->pageName = $name;

        return $this;
    }

    /**
     * Insere um componente para ser renderizado dentro 
     * de uma determinada página, de acordo com o nome do seu slot
     * e seu parâmetros necessários.  
     * É possível indicar se trata de um componente livewire ou não.    
     *
     * @param string $component
     * @param string $slot
     * @param array $with
     * @return void
     */
    public function embed(
        UnitEnum|string $component,  
        UnitEnum|string $slot, 
        array $with = [],
        bool $livewire = true
    ) : void {
        
        $slot = is_string($slot) ? 
            $slot : $slot->value;
        
        $component = (is_string($component)) ? 
            $component : $component->value;
        
        $value = (object) [
            'name'     => $component,
            'params'   => $with,
            'livewire' => $livewire 
        ];
     
        $key = $this->key($slot);

        $components = $this->components($slot)->add($value);

        Session::put($key, $components);
    }

    /**
     * Remove os componentes inseridos dinâmicamente 
     * de uma determinada página.   
     * Caso não seja fornecido o nome do slot que deve ser limpo, 
     * irá remover TODOS os componentes de TODOS slots da página. 
     *
     * @param string|null $slot
     * @return void
     */
    public function clear(?string $slot = null) : void
    {
        $key = $this->key($slot);

        Session::forget($key);
    }

    /**
     * Retorna a lista de componentes vinculados à uma página. 
     *
     * @param string|null $slot
     * @return Collection
     */
    public function components(?string $slot = null) : Collection
    {
        $key = $this->key($slot);
        
        $components = Session::get($key) ?? [];

        return collect($components);
    }

    /**
     * Retorna o nome da chave para resgatar 
     * os componentes registrados.  
     *
     * @param string|null $slot
     * @return string
     */
    private function key(?string $slot = null) : string
    {
        return $slot == null ? 
            $this->pageName : "$this->pageName.$slot";
    }
}