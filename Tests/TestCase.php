<?php

namespace Maestro\Admin\Tests;

use Illuminate\Support\Facades\Artisan;
use Maestro\Users\Support\Facade\Users;
use Tests\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

class TestCase extends BaseTestCase
{
    use WithFaker;

    protected function start() : TestCase
    {
        $this->migrateTables();
        $this->seedTables();
        return $this;
    }
    
    protected function finish()
    {
        $this->rollbackTables();
    }

    protected function migrateTables()
    {
        Artisan::call('maestro:migrate Accounts');
        Artisan::call('maestro:migrate Users');
        // Artisan::call('maestro:migrate Companies');
        // Artisan::call('maestro:migrate Projects');
        // Artisan::call('maestro:migrate Tasks');
        // Artisan::call('maestro:migrate Activities');
    }
    
    protected function seedTables()
    {
        //Artisan::call('maestro:seed Companies');
    }
    
    protected function rollbackTables()
    {
        // Artisan::call('maestro:rollback Activities');
        // Artisan::call('maestro:rollback Tasks');
        // Artisan::call('maestro:rollback Projects');
        // Artisan::call('maestro:rollback Companies');
        Artisan::call('maestro:rollback Users');
        Artisan::call('maestro:rollback Accounts');
    }

    /**
     * Gera um usuário fake e inicia a sessão para a criação dos testes.
     *
     * @return void
     */
    public function initSession() : void
    {
        Users::factory()->login();
    }  
}