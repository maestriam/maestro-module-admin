<?php

use Illuminate\Support\Carbon;

/**
 * Retorna uma determinada data no formato dd/mm/YYYY H:m:s.
 * Caso não seja informado o valor da data, retorna a 
 * data atual.
 *
 * @param string|null $date
 * @return string
 */
function ddmmYYYY(string $date = null, bool $hour = true) : string {
    $date ??= Carbon::now();
    $pattern = $hour ? "d/m/Y H:i:s" : "d/m/Y";
    return date($pattern, strtotime($date));
}