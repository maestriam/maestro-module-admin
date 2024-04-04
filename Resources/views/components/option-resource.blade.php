<div class="table-links">

    <a  href="{{ route($module + '.view', $id) }}">{{ __('admin::buttons.view') }}</a>    
    <div class="bullet"></div>
    
    <a href="{{ route($module + '.edit', $id) }}">{{ __('admin::buttons.edit') }}</a>    
    <div class="bullet"></div>
    
    <a href="#" wire:click="remove({{$id}})" class="text-danger">{{ __('admin::buttons.delete') }}</a>

</div>