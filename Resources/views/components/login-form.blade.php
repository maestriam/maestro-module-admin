<form method="POST"  wire:submit.prevent="submit"  novalidate="">
       
    <x-email-input :model="'email'" :label="__('admin::labels.email')"/>

    <x-password-input :model="'password'" />
    
    <x-submit>{{ __('admin::buttons.login') }}</x-submit>
    
</form>
                