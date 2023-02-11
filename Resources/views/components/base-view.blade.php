<x-base>            
  
  <x-navbar>      
      <x-slot:action>
        <livewire:admin.user-dropdown />
      </x-slot:action>
  </x-navbar>

  <livewire:admin.sidebar />

  {{ $slot }}
      
  <x-footer />  

</x-base>