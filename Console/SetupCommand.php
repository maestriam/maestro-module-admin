<?php

namespace Maestro\Admin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup module configuration.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->setTheme()
             ->enableModules()
             ->installModules();
        
        $this->info('Admin module configurated with successful');      
    }

    /**
     * Instala o tema padrão do projeto Maestro. 
     *
     * @return self
     */
    private function setTheme() : self
    {
        Artisan::call('samurai:publish maestriam/stylus');
        Artisan::call('samurai:use maestriam/stylus');
        Artisan::call('samurai:refresh');  

        return $this;
    }

    /**
     * Habilita o módulo para que possam ser listados no sistema.
     *
     * @todo Atualmente, o projeto está instalando módulos que 
     * não devem ficar no projeto base. Isso deve ser removido 
     * em breve. 
     * @return self
     */
    private function enableModules() : self
    {
        Artisan::call('maestro:enable Admin');
        Artisan::call('maestro:enable Accounts');
        Artisan::call('maestro:enable Users');
        Artisan::call('maestro:enable Companies');
        Artisan::call('maestro:enable Projects');
        Artisan::call('maestro:enable Backlog');
        
        return $this;
    }
    
    /**
     * Executa 
     *
     * @return self
     */
    private function installModules() : self
    {
        Artisan::call('accounts:install');
        Artisan::call('users:setup');
        Artisan::call('companies:setup');
        Artisan::call('projects:setup');
        Artisan::call('backlog:setup');

        return $this;
    }
}