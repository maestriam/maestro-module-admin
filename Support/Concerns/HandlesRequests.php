<?php

namespace Maestro\Admin\Support\Concerns;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Maestro\Admin\Exceptions\InvalidRequestException;
use Illuminate\Support\Facades\Validator as ValidatorFactory;

trait HandlesRequests 
{
    /**
     * Retorna os dados inseridos pelo usuário na versão objeto.  
     *
     * @param Request|FormRequest|array $input
     * @return object
     */
    protected function toInput(Request|FormRequest|array $input) : object
    {
        $data = is_array($input) ? $input : $input->all();

        return (object) $data;
    }

    /**
     * Verifica se a requisição solicitada é válida.  
     * Em caso de negativo, deve retornar false.
     *
     * @param array|FormRequest $input
     * @return Validator
     */
    public function validator(array|FormRequest $input) : Validator
    {
        $data = is_array($input) ? $input : $input->all();

        $rules = $this->request->rules();

        $messages = $this->request->messages();

        return ValidatorFactory::make($data, $rules, $messages);
    }

    /**
     * Protege da inserção de dados de usuários inválidos 
     * no banco de dados.  
     * Em caso de algum atributo estiver errado, deve disparar
     * uma exception. 
     *
     * @param StoreUserRequest|array $request
     * @return boolean
     */
    protected function guard(array|FormRequest $request) : void
    {
        if ($this->isValid($request)) return;
            
        throw new InvalidRequestException();          
    }
    
    /**
     * Verifica se a requisição solicitada é válida.
     * Em caso de negativo, deve retornar false. 
     *
     * @param array|StoreUserRequest $input
     * @return boolean
     */
    public function isValid(array|FormRequest $input) : bool 
    {
        $validator = $this->validator($input);

        return $validator->fails() ? false : true;
    }
}