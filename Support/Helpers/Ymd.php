<?php

use Illuminate\Support\Carbon;

function Ymd(string $date) 
{
    $pattern = 'd/m/Y H:i';
    $convert = 'Y-m-d H:i';
    
    return Carbon::createFromFormat($pattern, $date)
                 ->format($convert);
}