<?php

namespace Maestro\Admin\Views\Pages;

use Livewire\Attributes\Url;
use Maestro\Admin\Views\MaestroView;
use Maestro\Admin\Support\Concerns\WithPaginationComponent;

class MaestroIndex extends MaestroView
{
    use WithPaginationComponent;
    
    /**
     * Campo de busca para filtrar registros na tabela de usuarios
     *
     * @var string
     */
    #[Url(as: 'q', except: '')]
    public string $search = '';

    /**
     * Quantidade de registros que será exibido por página.
     *
     * @var integer
     */
    public int $perPage = 10;

    /**
     * Se houver alguma consulta sendo executada na página de 
     * index, deve retornar para a primeira página em caso de 
     * paginação.   
     *
     * @return void
     */
    public function resetSearch() : void
    {
        if ($this->search != null) {
            $this->resetPage();
        }
    }
}