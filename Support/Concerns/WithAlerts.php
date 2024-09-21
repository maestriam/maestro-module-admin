<?php

namespace Maestro\Admin\Support\Concerns;

use Jantinnerezo\LivewireAlert\LivewireAlert;

trait WithAlerts
{
    use LivewireAlert;

    public function alertConfirm(string $onConfirmed, string $text)
    {
        $this->alert('warning', 'Atenção', [
            'text' => $text,
            'timer' => null,
            'toast' => false,
            'position' => 'center',
            'showDenyButton' => true,
            'reverseButtons'   => true,
            'showConfirmButton' => true,
            'onConfirmed' => $onConfirmed,
            'deniedButtonText' => 'Cancelar',
            'confirmButtonText' => 'Confirmar',            
        ]);
    }

    /**
     * Renderiza um toast na tela de acordo com o título e o texto informado.  
     * Caso o tipo do toast não seja informado, por padrão será exibido um 
     * toast de sucesso.  
     * @return void
     */
    public function displayToast(string $text, string $title = '', string $type = 'success') 
    {
        $this->alert($type, $title, [
            'timerProgressBar' => true,
            "text"             => $text,
            'position'         => 'bottom-end',
        ]);
    }
}