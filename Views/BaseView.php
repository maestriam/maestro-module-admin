<?php

namespace Maestro\Admin\Views;

use Livewire\Component;
use Maestro\Admin\Http\Requests\LoginRequest;

class BaseView extends Component
{
    /**
     * Rota que será redirecionado depois do login
     * 
     * @var string
     */
    private string $route = 'maestro.admin.home';

    /**
     * Regras para validação do formulário de Login
     * 
     * @var \Maestro\Admin\Http\Requests\LoginRequest
     */
    private LoginRequest $validation;

    /**
     * Exibe a view do componente
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin::components.base-view');
    }
}