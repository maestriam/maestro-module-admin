<?php

namespace Maestro\Admin\Views\Base;

use Maestro\Admin\Views\MaestroView;

abstract class MaestroForm extends MaestroView
{
    /**
     * Verifica se o formulário deve ser exibido 
     * no modo edição ou no modo criação.
     *
     * @return boolean
     */
    abstract protected function isEdition() : bool;

    /**
     * Retorna a requisição com os dados vindos do formulário 
     * para a criação/edição do recurso. 
     *
     * @return array
     */
    //abstract protected function getRequest() : array;

    /**
     * Executa a validação dos dados enviado pelo usuário.  
     * Em caso de problema, deve retornar a chave do erro 
     * para a exibição na view. 
     *
     * @param array $request
     * @return mixed
     */
    abstract protected function guard(array $request) : mixed;

    /**
     * Executa a criação de um novo recurso na plataforma.  
     *
     * @param array $request
     * @return void
     */
    abstract protected function create(array $request) : void;

    /**
     * Executa a atualização de um recurso existente na plataforma.  
     *
     * @param array $request
     * @return void
     */
    abstract protected function update(array $request) : void;
}