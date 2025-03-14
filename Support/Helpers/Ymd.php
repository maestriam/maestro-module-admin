<?php

use Illuminate\Support\Carbon;

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
    $check = '/^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}$/';

    if (! preg_match($check, $date)) return $date; 

    $pattern = 'd/m/Y H:i';
    $convert = 'Y-m-d H:i';
    
    return Carbon::createFromFormat($pattern, $date)
                 ->format($convert);
}