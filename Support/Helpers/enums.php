<?php

/**
 * Retorna o valor de um determinado enum.  
 * Caso o valor passado como parâmetro seja um texto, 
 * deve retornar ela mesma.  
 * 
 * @param mixed $var
 * @return mixed
 */
function enumval(mixed $var) : mixed 
{
    return match(true) {
        default         => null,
        is_string($var) => $var,
        is_enum($var)   => $var->value,
    };
}

/**
 * Verifica se o objeto passado trata-se de um Enum.
 *
 * @param mixed $value
 * @return boolean
 */
function is_enum(mixed $value) : bool 
{
    return ($value instanceof UnitEnum);
}