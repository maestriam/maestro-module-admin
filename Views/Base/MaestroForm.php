<?php

namespace Maestro\Admin\Views\Base;

use Illuminate\Support\MessageBag;
use Maestro\Admin\Support\Concerns\PageRedirections;
use Maestro\Admin\Views\MaestroView;

class MaestroForm extends MaestroView
{
    use PageRedirections;

    /**
     * Verifica se o formulário deve ser exibido 
     * no modo edição ou no modo criação.
     *
     * @return boolean
     */
    protected function isEdition() : bool
    {
        return false;
    }

    /**
     * Retorna a requisição com os dados vindos do formulário 
     * para a criação/edição do recurso. 
     *
     * @return array
     */
    //protected function getRequest() : array;

    /**
     * Executa a validação dos dados enviado pelo usuário.  
     * Em caso de problema, deve retornar a chave do erro 
     * para a exibição na view. 
     *
     * @param array $request
     * @return mixed
     */
    protected function guard(array $request) : mixed
    {
        if (! method_exists($this, 'creator')) return null;

        $validator = $this->creator()->validator($request);

        if ($validator->fails()) {
            $this->dispatchErrors($validator->errors());
        }

        return $validator->validate();
    }

    protected function dispatchErrors(MessageBag $errors)
    {
        
    }

    /**
     * Executa a criação de um novo recurso na plataforma.  
     *
     * @param array $request
     * @return void
     */
    protected function create(array $request) : void
    {

    }

    /**
     * Executa a atualização de um recurso existente na plataforma.  
     *
     * @param array $request
     * @return void
     */
    protected function update(array $request) : void
    {

    }
}