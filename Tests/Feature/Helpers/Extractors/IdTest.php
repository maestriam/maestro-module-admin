<?php

namespace Maestro\Admin\Tests\Feature\Helpers\Extractors;

use Maestro\Admin\Tests\TestCase;
use Maestro\Admin\Tests\Fixtures\IntEnum;
use Maestro\Admin\Tests\Fixtures\NameEnum;
use Maestro\Admin\Tests\Fixtures\StringEnum;

class IdTest extends TestCase
{
    public function testWithObject()
    {
        $success  = (object) ['id' => 1];
        $invalid1 = (object) ['no' => 1];
        $invalid2 = (object) ['id' => null];

        $ok = id($success);

        $this->assertNull(id($invalid1));
        $this->assertNull(id($invalid2));
        $this->assertEquals($success->id, $ok);
    }

    public function testWithNumber()
    {
        $success = 202;
        $invalid = 30.233;

        $this->assertNull(id($invalid));
        $this->assertEquals($success, id($success));
    }

    public function testWithArray()
    {
        $success  = ['id' => 1];
        $invalid1 = ['no' => 222];
        $invalid2 = ['id' => null];
        $invalid3 = [['id' => null]];

        $id = id($success);

        $this->assertNull(id($invalid1));
        $this->assertNull(id($invalid2));
        $this->assertNull(id($invalid3));
        $this->assertEquals($success['id'], $id);
    }

    public function testWithEnums()
    {
        $id1 = id(IntEnum::ONE);
        $id2 = id(IntEnum::ONE);
        $id3 = id(NameEnum::ONE);
        
        $this->assertEquals(IntEnum::ONE->value, $id1);
        $this->assertEquals(StringEnum::ONE->value, $id2);
        $this->assertEquals(0, $id3);
    }
}