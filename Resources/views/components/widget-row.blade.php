<x-row>
@isset($this->components)
    @foreach($this->components as $component)
        <livewire:is 
            lazy
            :key="$component->name"
            :component="$component->name" 
            :bind="$this->merge($component->params)" />              
    @endforeach
@endif
</x-row>