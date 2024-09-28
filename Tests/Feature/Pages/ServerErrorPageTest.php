<?php

namespace Maestro\Admin\Tests\Feature\Pages;

use Livewire\Livewire;
use Maestro\Admin\Tests\TestCase;
use Maestro\Admin\Views\Pages\ServerErrorPage;

class ServerErrorPageTest extends TestCase
{
    public function testRender()
    {
        Livewire::test(ServerErrorPage::class)
            ->assertSeeHtml("<h1>500</h1>")
            ->assertSee(__('admin::pages.server-error.title'))
            ->assertSeeHtml(__('admin::pages.server-error.description'))
            ->assertStatus(200);
    }
}