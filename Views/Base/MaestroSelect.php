<?php

namespace Maestro\Admin\Views\Base;

use Livewire\Component;

class MaestroSelect extends Component
{
    public function getSelected(int $id)
    {
        return ($this->projectId == $id) ? 'selected' : '';
    }

}