<?php

namespace Maestro\Admin\Support\Concerns;

use Livewire\WithPagination;

trait WithPaginationComponent
{
    use WithPagination;

    /**
     * Retorna o nome do arquivo de paginação do Livewire
     *
     * @return string
     */
    public function paginationView() : string
    {
        return 'admin::components.pagination';
    }
}