<?php

namespace Maestro\Admin\Views;

use Livewire\Component;
use Maestro\Users\Database\Models\User;
use Maestro\Users\Support\Facade\Users;

class UserDropDown extends Component
{
    protected $user;

    public string $fullName;

    protected $listeners = ['user_login' => 'initialize'];

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