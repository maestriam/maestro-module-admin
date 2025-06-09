<?php

namespace Maestro\Admin\Support\Concerns;

use UnitEnum;
use Livewire\Livewire;
use Illuminate\Support\Facades\Config;

trait RegistersViews
{
    use ModulePath;

    /**
     * Caminho do diretório raíz onde estão localizados
     * todos os recursos referente a views/resources. 
     *
     * @var string
     */
    protected string $root = 'Views/Resources';

    /**
     * Caminho do diretório raíz onde estão localizados
     * todos os recursos relacionado a tradução. 
     *
     * @var string
     */
    protected string $langSource = 'lang/modules';

    /**
     * Caminho do arquivo de configuração do módulo. 
     *
     * @var string
     */
    protected string $configFile = 'config/config.php';

    /**
     * Evento inicial do service provider. 
     *
     * @return self
     */
    public function init() : self
    {
        $this->registerTranslations()
             ->registerViews()
             ->registerConfig()
             ->registerLivePages()
             ->registerLiveComponents();
        
        return $this;
    }

    /**
     * Registra as páginas desenvolvidas em Livewire do módulo. 
     *
     * @return self
     */
    protected function registerLivePages() : self
    {
        $this->registerLivewire('pages');

        return $this;
    }

    /**
     * Registra os componentes de visualização do módulo
     *
     * @return self
     */
    protected function registerLiveComponents() : self
    {            
        $this->registerLivewire('components');

        return $this;
    }

    /**
     * Registra os arquivos de tradução do módulo. 
     *
     * @return self
     */
    protected function registerTranslations() 
    {
        $resource = $this->getPathFromResource($this->langSource);

        $path = is_dir($resource) ? 
            $resource : $this->getPathFromModule('lang');

        $this->loadTranslationsFrom($path, $this->moduleNameLower);
        
        return $this;
    }

    /**
     * Registra os arquivos de configuração do módulo. 
     *
     * @return self
     */
    protected function registerConfig() : self
    {
        $path = $this->getPathFromModule($this->configFile);
        $conf = config_path($this->moduleNameLower . '.php');

        $this->publishes([ $path => $conf ], 'config');
        $this->mergeConfigFrom($path, $this->moduleNameLower);

        return $this;
    }

    /**
     * Registra o caminho dos arquivos da view onde deverão
     * ser carregados. 
     *
     * @return self
     */
    public function registerViews() : self
    {        
        $group = "$this->moduleNameLower-module-views";        
        $module = $this->getPathFromModule('views');
        
        $resource = $this->getPathFromResource('views/modules');                
        $this->publishes([ $module => $resource ], ['views', $group]);

        $publishable = $this->getPublishableViewPaths($module);
        $this->loadViewsFrom($publishable, $this->moduleNameLower);

        return $this;
    }

    /**
     * Retorna o caminho do diretório/arquivo desejado 
     * baseado no caminho raíz dos recursos dentro do módulo. 
     *
     * @param string $source
     * @return string
     */
    protected function getPathFromModule(string $source) : string
    {
        $path = $this->root . DS . $source;

        return $this->modulePath($path);
    }

    /**
     * Retorna o caminho do diretório/arquivo desejado
     * baseado no caminho raíz de recusos da aplicação Laravel. 
     *
     * @param string $source
     * @return string
     */
    protected function getPathFromResource(string $source) : string
    {
        $path = $source . "/" . $this->moduleNameLower;

        return resource_path($path);
    }

    /**
     * Retorna a lista de caminhos onde arquivos do módulo serão
     * publicados dentro do projeto, junto com o caminho de recurso
     * do módulo. 
     *
     * @return array
     */
    protected function getPublishableViewPaths(string $source): array
    {
        $paths = [];        

        foreach (Config::get('view.paths') as $path) {
            
            $registered = "$path/modules/$this->moduleNameLower";
            
            if (! is_dir($registered)) continue;             
            
            $paths[] = $registered;            
        }

        return array_merge($paths, [ $source ]);
    }

    /**
     * Registra um componente Livewire no sistema. 
     *
     * @param string $prop
     * @return void
     */
    protected function registerLivewire(string $prop) : void 
    {
        if (! $this->hasProperty($prop)) return;
        
        foreach ($this->$prop as $class => $enum) {
            
            $name = enumval($enum);

            Livewire::component($name, $class);
        }

        return;
    }

    /**
     * Verifica se a classe tem determinada propriedade e 
     * se é um array
     *
     * @param string $name
     * @return boolean
     */
    private function hasProperty(string $name) : bool
    {
        return (property_exists($this, $name) && is_array($this->$name));
    }
}