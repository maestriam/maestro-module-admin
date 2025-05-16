<?php

namespace Maestro\Admin\Tests\Unit\Foundation\PageControl;

use Maestro\Admin\Support\Concerns\ControlsPages;
use Maestro\Admin\Tests\TestCase;

class ClearTest extends TestCase
{
    use ControlsPages;

    public function testClear()
    {
        $control = $this->pageControl()->page('my-page');
             
        $control->embed('widget', 'slot');

        $collection = $control->components();
        
        $this->assertFalse($collection->isEmpty());

        $control->clear();
        
        $collection = $control->components();
        
        $this->assertTrue($collection->isEmpty());
    }
}