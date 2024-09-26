<?php

namespace Maestro\Admin\Views\Pages;

use Maestro\Admin\Views\MaestroView;

class ServerErrorPage extends MaestroView
{
    public function render()
    {
        return $this->renderView("admin::pages.server-error");
    }
}