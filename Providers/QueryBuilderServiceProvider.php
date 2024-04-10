<?php

namespace Maestro\Admin\Providers;

use App;
use Maestro\Admin\Macros\WhereConcat;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

class QueryBuilderServiceProvider extends ServiceProvider 
{
    /**
     * Bootstrap any application services
     *
     * @return void
     */
    public function boot() {
    }

    /**
     * Register any application services
     *
     * @return void
     */
    public function register() 
    {
        $this->registerWhereConcat();
    }

    /**
     * Register the rankings method for collections
     *
     * @return void
     */
    private function registerWhereConcat() 
    {
        Builder::macro('whereConcat', function ($columns, $operator = '=', $value = null) 
        {
            return WhereConcat::whereConcat($this, $columns, $operator, $value);
        });

        Builder::macro('orWhereConcat', function ($columns, $operator = '=', $value = null) 
        {
            return WhereConcat::orWhereConcat($this, $columns, $operator, $value);
        });
    }
}