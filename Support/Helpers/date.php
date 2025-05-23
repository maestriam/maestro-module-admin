<?php

use Illuminate\Support\Carbon;

/**
 * Retorna uma determinada data no formato dd/mm/YYYY H:m:s.  
 * Caso não seja informado o valor da data, retorna a data atual.
 *
 * @param string|null $date
 * @return string
 */
function ddmmYYYY(
    ?string $date = null, 
    bool $hour = true, 
    bool $secs = false
) : string {

    $date ??= Carbon::now('America/Sao_Paulo');

    $pattern  = $hour ? "d/m/Y H:i" : "d/m/Y";
    $pattern .= $secs ? ":s" : "";
    return date($pattern, strtotime($date));
}


/**
 * Retorna uma data do formato americano (d/m/Y H:i) 
 * para o fomato europeu (Y-m-d H:i).   
 * Caso a data passada não esteja no formato americano, 
 * a função retorna o próprio valor passado.  
 *
 * @param string $date
 * @return void
 */
function Ymd(string $date) : string
{
    $dmYHi  = '/^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}$/';
    $dmYHis = '/^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}$/';

    $pattern =  match (true) {
        (bool) preg_match($dmYHi, $date)  => 'd/m/Y H:i',
        (bool) preg_match($dmYHis, $date) => 'd/m/Y H:i:s',
        default => null,
    };

    if ($pattern == null) return $date; 
    
    $convert = 'Y-m-d H:i';

    return Carbon::createFromFormat($pattern, $date)
                 ->format($convert);
}