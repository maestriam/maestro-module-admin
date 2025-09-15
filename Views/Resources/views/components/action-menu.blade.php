<div class="table-links">
    <a  href="{{ $this->viewRoute }}">{{ __('admin::buttons.view') }}</a>    
    <div class="bullet"></div>
    
    <a href="{{ $this->editRoute }}">{{ __('admin::buttons.edit') }}</a>    
    <div class="bullet"></div>
    
    <a href="#" wire:click="remove()" class="text-danger">
        {{ __('admin::buttons.delete') }}
    </a>
</div>