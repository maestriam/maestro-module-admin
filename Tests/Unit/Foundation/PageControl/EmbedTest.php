<?php

namespace Maestro\Admin\Tests\Unit\Foundation\PageControl;

use Illuminate\Support\Collection;
use Maestro\Admin\Support\Concerns\ControlsPages;
use Maestro\Admin\Tests\TestCase;

class EmbedTest extends TestCase
{
    use ControlsPages;

    public function testEmbedComponent()
    {
        $slot   = 'slot';
        $widget = 'my-widget';

        $control = $this->pageControl()->page('my-page');
        $control->embed($widget, $slot);

        $components = $control->components();
        $this->assertInstanceOf(Collection::class, $components[$slot]);

        $config = $components[$slot]->first();

        $this->assertObjectHasProperty('name', $config);
        $this->assertObjectHasProperty('params', $config);
        $this->assertObjectHasProperty('livewire', $config);

        $this->assertTrue($config->livewire);
        $this->assertEquals([], $config->params);
        $this->assertEquals($widget, $config->name);
    }
}