<?php

namespace Maestro\Admin\Support\Concerns;

use Jantinnerezo\LivewireAlert\Enums\Position;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

trait WithAlerts
{
    /**
     * Exibe um modal de confirmação para executar 
     * uma determinada operação.  
     * Caso o usuário confirme a operação, o modal irá disparar 
     * um evento que deverá ser escutado pelo componente executor. 
     *
     * @param string $title
     * @param string $message
     * @param string $onConfirmed
     * @param array $options
     * @return void
     */
    public function confirm(
        string $title,
        string $message,
        string $onConfirmed, 
        array $options = []
    ) : void {

        $event = 'dispatchEvent';

        $options['reverseButtons'] = true;

        $denyButton = $options['denyButtonText'] ?? 
                      __('admin::modals.confirm.cancel');

        $confirmButton = $options['confirmButtonText'] ?? 
                         __('admin::modals.confirm.confirm');

        LivewireAlert::title($title)
                     ->warning()
                     ->asConfirm()
                     ->html($message)
                     ->withOptions($options)                 
                     ->onConfirm($event, ['event' => $onConfirmed])
                     ->position(Position::Center)
                     ->withDenyButton($denyButton)
                     ->withConfirmButton($confirmButton)
                     ->show();
    }

    /**
     * Exibe um modal de confirmação para executar 
     * uma determinada operação.  
     * Caso o usuário confirme a operação, o modal irá disparar 
     * um evento que deverá ser escutado pelo componente executor. 
     *
     * @deprecated Deve usar a função confirm.
     * @param string $onConfirmed
     * @param string $text
     * @return void
     */
    public function showConfirm(
        string $onConfirmed, 
        string $title,
        string $message,
        array $options = []
    ) : void {

        $this->confirm($title, $message, $onConfirmed, $options);
    }

    /**
     * Exibe um toast na tela de acordo com o título e o texto informado.  
     * Caso o tipo do toast não seja informado, por padrão será exibido um 
     * toast de sucesso.
     *
     * @deprecated Deve usar a função toast.
     * @return void
     */
    public function showToast(
        string $text, 
        string $title = '', 
        string $type = 'success'
    ) : void {
        $this->toast($title, $text);
    }

    /**
     * Exibe um toast na tela de acordo com o título e o texto informado.  
     * Caso o tipo do toast não seja informado, por padrão será exibido um 
     * toast de sucesso.
     *
     * @param string $title
     * @param string $text
     * @return void
     */
    public function toast(string $title, string $text)
    {
        LivewireAlert::title($title)
                     ->text($text)
                     ->success()
                     ->toast()
                     ->position('bottom-end')
                     ->show();
    }

    /**
     * Dispara o evento para o componente designado.
     *
     * @param array $options
     * @return void
     */
    public function dispatchEvent(array $options = []) : void
    {
        $this->dispatch($options['event']);
    }
}