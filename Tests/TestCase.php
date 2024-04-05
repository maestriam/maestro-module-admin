<?php

namespace Maestro\Admin\Tests;

use Tests\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Maestro\Users\Support\Facade\Users;
use Illuminate\Foundation\Testing\WithFaker;

class TestCase extends BaseTestCase
{
    use WithFaker;

    /**
     * Executa os preparativos para a execução dos testes
     *
     * @return TestCase
     */
    protected function start() : TestCase
    {
        return $this->up();        
    }
    
    /**
     * Executa os preparativos para o encerramento dos testes      
     *
     * @return TestCase
     */
    protected function finish() : TestCase
    {
        return $this->down();
    }

    /**
     * Executa os migrates dos módulos de Accounts e Users 
     * para a execução dos testes.  
     *
     * @return self
     */
    protected function up() : TestCase
    {
        Artisan::call('maestro:migrate Accounts');
        Artisan::call('maestro:migrate Users');

        return $this;
    }
    
    /**
     * Faz o rollback dos módulos de Accounts e Users
     * para o encerramento dos testes.
     *
     * @return TestCase
     */
    protected function down() : TestCase
    {
        Artisan::call('maestro:rollback Users');
        Artisan::call('maestro:rollback Accounts');

        return $this;
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