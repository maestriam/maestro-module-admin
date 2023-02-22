<?php

namespace Maestro\Admin\Views;

use Livewire\Component;

class UserDropDown extends Component
{
    protected $user;

    public string $fullName;

    public string $logout;

    public function mount()
    {
        $this->setUser()->setFullName();
    }

    private function setUser() : self
    {
        $this->user = (object) session('userData');

        return $this;
    }

    private function setFullName() : self
    {
        $name = $this->user->first_name . ' '. $this->user->last_name;

        $this->fullName = $name;

        return $this;
    }

    public function render()
    {
        return view('admin::components.user-dropdown');
    }
}