<?php

namespace Maestro\Admin\Tests\Feature\Components\SideBarTest;

use Livewire\Livewire;
use Maestriam\Maestro\Support\Maestro;
use Maestro\Admin\Tests\TestCase;
use Maestro\Admin\Views\Components\SideBar;

class SideBarTest extends TestCase
{
    public function testRender()
    {
        Livewire::test(SideBar::class)
                ->assertStatus(200);
    }

    public function testMod()
    {
        $modules = Maestro::modules()->all();

        $test = Livewire::test(SideBar::class);
        
        foreach ($modules as $module) {
            
            $info = $module->info();

            if (! isset($info->visible) || ! $info->visible) continue; 

            $test->assertSee($module->name());
        }
    }
}