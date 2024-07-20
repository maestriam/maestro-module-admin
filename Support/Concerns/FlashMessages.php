<?php

namespace Maestro\Admin\Support\Concerns;

use Illuminate\Support\Facades\Session;

trait FlashMessages
{
    /**
     * Salva uma mensagem na sessão que será apagada 
     * após sua exibição. 
     *
     * @param string $key
     * @param string $message
     * @return void
     */
    public function flashMessage(string $key, string $message) : void
    {
        Session::flash($key, $message);
    }
}