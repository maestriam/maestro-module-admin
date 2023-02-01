<?php

namespace Maestro\Admin\Views;

use Livewire\Component;
use Maestriam\Maestro\Support\Maestro;

class SideBar extends Component
{
    /**
     * Nome que será exibido no topo esquerdo.
     * 
     * @var string
     */
    public string $title = 'Maestro';

    /**
     * Nome abreviado do sistema
     * 
     * @var string
     */
    public string $abbr = 'Ms';

    /**
     * Lista de módulos instalados no sistema
     * 
     * @var array
     */
    public array $modules;
    
    /**
     * Inicia os atributos
     */
    public function __construct()
    {
        $this->modules = $this->getModules();
    }

    /**
     * Renderiza a view do menu lateral
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin::components.sidebar');
    }

    /**
     * Retorna a lista de módulos instalados que devem
     * ser exibidos no menu lateral do sistema.
     * Não deve vincular o próprio módulo de admin. 
     * 
     * @return array
     */
    private function getModules() : array
    {
        $modules = Maestro::modules()->all();

        foreach ($modules as $i => $module) {
            if ($module->name() == 'Admin') {
                unset($modules[$i]);
            }
        }

        return $modules;
    }
}