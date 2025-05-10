<?php

namespace Maestro\Admin\Support\Concerns;

use Jantinnerezo\LivewireAlert\LivewireAlert;

trait WithAlerts
{
    use LivewireAlert;

    /**
     * Exibe um modal de confirmação para executar 
     * uma determinada operação.  
     * Caso o usuário confirme a operação, o modal irá disparar 
     * um evento que deverá ser escutado pelo componente executor. 
     *
     * @deprecated Deve utilizar showConfirm
     * @param string $confirmation
     * @param string $text
     * @return void
     */
    public function alertConfirm(string $confirmation, string $text) : void
    {
        $this->alert('warning', 'Atenção', [
            'text' => $text,
            'timer' => null,
            'toast' => false,
            'position' => 'center',
            'showDenyButton' => true,
            'reverseButtons'   => true,
            'showConfirmButton' => true,
            'onConfirmed' => $confirmation,
            'deniedButtonText' => 'Cancelar',
            'confirmButtonText' => 'Confirmar',            
        ]);
    }

    /**
     * Exibe um modal de confirmação para executar 
     * uma determinada operação.  
     * Caso o usuário confirme a operação, o modal irá disparar 
     * um evento que deverá ser escutado pelo componente executor. 
     *
     * @param string $onConfirmed
     * @param string $text
     * @return void
     */
    public function showConfirm(
        string $onConfirmed, 
        string $message,
        array $options = [],
    ) : void {

        $denyButton = $options['denyButtonText'] ?? 
                      __('admin::modals.confirm.cancel');

        $confirmButton = $options['confirmButtonText'] ?? 
                         __('admin::modals.confirm.confirm');

        $this->alert('warning', 'Atenção', [
            'timer'             => null,
            'toast'             => false,
            'showDenyButton'    => true,
            'showConfirmButton' => true,
            'reverseButtons'    => true,
            'html'              => $message,
            'position'          => 'center',
            'onConfirmed'       => $onConfirmed,
            'denyButtonText'    => $denyButton,
            'confirmButtonText' => $confirmButton,             
        ]);
    }

    /**
     * Renderiza um toast na tela de acordo com o título e o texto informado.  
     * Caso o tipo do toast não seja informado, por padrão será exibido um 
     * toast de sucesso.  
     * 
     * @deprecated Deve usar showToast
     * @return void
     */
    public function displayToast(string $text, string $title = '', string $type = 'success') 
    {
        $this->toast($type, $title, [
            'timerProgressBar' => true,
            "text"             => $text,
            'position'         => 'bottom-end',
        ]);
    }

    /**
     * Exibe um toast na tela de acordo com o título e o texto informado.  
     * Caso o tipo do toast não seja informado, por padrão será exibido um 
     * toast de sucesso.  
     * 
     * @return void
     */
    public function showToast(
        string $text, 
        string $title = '', 
        string $type = 'success'
    ) : void {
        $this->alert($type, $title, [
            'timerProgressBar' => true,
            "text"             => $text,
            'position'         => 'bottom-end',
        ]);
    }
}