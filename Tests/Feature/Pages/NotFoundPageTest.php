<?php

use Livewire\Livewire;
use Maestro\Admin\Tests\TestCase;
use Maestro\Admin\Views\Pages\NotFoundPage;

class NotFoundPageTest extends TestCase
{
    public function testRenderComponent()
    {
        Livewire::test(NotFoundPage::class)
            ->assertStatus(200)
            ->assertSee(__('admin::pages.not-found.title'))
            ->assertSee(__('admin::pages.not-found.description'));
    }    
}