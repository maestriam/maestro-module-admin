<?php

namespace Maestro\Admin\Views;

use Livewire\Component;
use Maestro\Users\Support\Facade\Users;

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
        $this->user = Users::auth()->current();

        return $this;
    }

    private function setFullName() : self
    {
        $name = $this->user->firstName . ' '. $this->user->lastName;

        $this->fullName = $name;

        return $this;
    }

    public function render()
    {
        return view('admin::components.user-dropdown');
    }
}