<?php

namespace Maestro\Admin\Tests\Feature\Helpers\Enums;

use Maestro\Admin\Tests\Fixtures\IntEnum;
use Maestro\Admin\Tests\Fixtures\NameEnum;
use Maestro\Admin\Tests\Fixtures\StringEnum;
use Maestro\Admin\Tests\TestCase;

class IsEnumTest extends TestCase
{
    public function testIsEnum()
    {
        $object = (object) ['one' => '1'];

        $this->assertFalse(is_enum(1));
        $this->assertFalse(is_enum('enum'));
        $this->assertFalse(is_enum($object));
        $this->assertTrue(is_enum(IntEnum::ONE));
        $this->assertTrue(is_enum(NameEnum::ONE));
        $this->assertTrue(is_enum(StringEnum::ONE));
    }
}