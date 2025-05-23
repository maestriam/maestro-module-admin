<?php

/**
 * Retorna o valor do ID de um determinado valor ou
 * objeto.  
 * Caso o parâmetro seja um objeto, irá tentar retornar 
 * a propriedade ID.  
 * Se for um array, irá tentar extrair o valor do índice ID.  
 * Em caso de não conseguir extrair valor nenhum, 
 * deve retornar null.  
 * 
 * @param mixed $var
 * @return integer|null
 */
function id(mixed $var) : ?int 
{
    return match(true) {
        default         => null,
        is_int($var)    => $var,
        is_enum($var)   => (int) enum_val($var),
        is_object($var) => $var?->id ?? null, 
        is_array($var)  => $var['id'] ?? null,
    };
}