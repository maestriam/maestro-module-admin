<?php

namespace Maestro\Admin\Views\Components;

use Livewire\Component;
use Maestriam\Maestro\Entities\Module;
use Maestriam\Maestro\Support\Maestro;

class SideBar extends Component
{
    /**
     * Nome que será exibido no topo esquerdo.
     * 
     * @var string
     */
    public string $title = 'Blueprint';

    /**
     * Nome abreviado do sistema
     * 
     * @var string
     */
    public string $abbr = 'BP';

    /**
     * Lista de módulos instalados no sistema
     * 
     * @var array
     */
    private array $modules = [];
    
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
            if ($module->name() == 'Admin' || ! $this->isVisible($module)) {
                unset($modules[$i]);
            }
        }

        return $modules;
    }

    /**
     * Verifica se o modulo está permitido para ser exibido no menu.  
     * Se caso a propriedade não estiver definido no arquivo module.json,
     * deve ser exibido por padrão. 
     *
     * @param Module $module
     * @return boolean
     */
    private function isVisible(Module $module) : bool
    {
        $visible = $module->info()->visible ?? true;

        return (! $visible) ? false : true;
    }
}