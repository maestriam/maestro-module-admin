<?php

namespace Maestro\Admin\Support\Concerns;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
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

    /**
     * The attributes that are mass assignable.
     *
     * @var LengthAwarePaginator
     */
    public function paginate($items, $perPage = 5, $page = null, $options = []) : LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        $count = $items->count();
        $slice = $items->forPage($page, $perPage);

        return new LengthAwarePaginator($slice, $count, $perPage, $page, $options);
    }
}