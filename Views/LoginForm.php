<?php

namespace Maestro\Admin\Views;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Maestro\Admin\Http\Requests\LoginRequest;

class LoginForm extends Component
{
    /**
     * E-mail do usuário para login     
     * 
     * @var string
     */
    public ?string $email = null;

    /**
     * Senha do usuário
     * 
     * @var string
     */
    public ?string $password = null;

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
     * Inicia os atributos
     */
    public function __construct()
    {
        $this->validation = new LoginRequest();
    }

    /**
     * Summary of submit
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function submit()
    {
        $this->guard();

        return redirect()->route($this->route);
    }

    /**
     * Verifica se o formulário de login foi preenchido corretamente.
     * Se sim, deve retornar true.
     * 
     * @return bool
     */
    public function guard() : array 
    {
        $request = $this->request();        
        $rules = $this->validation->rules();        
        $messages = $this->validation->messages();
        
        $validator = Validator::make($request, $rules, $messages);

        return $validator->validate();
    }

    private function request() : array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }

    /**
     * Exibe a view do componente
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('admin::components.login-form');
    }
}