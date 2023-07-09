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
    protected $signature = 'admin:init';

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
             ->migrateDatabase()
             ->seedModules(); 
        
        $this->info('Admin module configurated with successful');      
    }

    private function setTheme() : self
    {
        Artisan::call('samurai:publish maestriam/stylus');
        Artisan::call('samurai:use maestriam/stylus');
        Artisan::call('samurai:refresh');  

        return $this;
    }

    private function enableModules() : self
    {
        Artisan::call('module:enable Admin');
        Artisan::call('module:enable Users');
        Artisan::call('module:enable Accounts');

        return $this;
    }

    private function migrateDatabase() : self
    {        
        Artisan::call('maestro:migrate Accounts');
        Artisan::call('maestro:migrate Users');

        return $this;
    }

    private function seedModules() : self
    {
        Artisan::call('maestro:seed Users');

        return $this;
    }
}