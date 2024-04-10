<?php

namespace Maestro\Admin\Tests\Unit\Macros;

use Exception;
use Tests\TestCase;
use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;

class WhereConcatTest extends TestCase {

    /** @var \Illuminate\Database\Connection|\PHPUnit\Framework\MockObject\MockObject */
    protected $connection;

    protected function setUp(): void 
    {
        parent::setUp();

        $this->connection = $this->createPartialMock(Connection::class, [
            'getDriverName'
        ]);
    }

    public function testFailsInvalidDriver() 
    {
        $this->connection->method('getDriverName')
            ->willReturn('invalid_driver');

        $this->expectException(Exception::class);
        $builder = new Builder($this->connection);
        $builder->whereConcat(['first', 'last'], '=', 'Hello World');
    }

    public function testWhereConcatSqlite() 
    {
        $this->connection->method('getDriverName')
            ->willReturn('sqlite');

        $builder = new Builder($this->connection);
        $builder->whereConcat(['first', 'last'], '=', 'Hello World');

        $wheres = $builder->wheres;
        $this->assertCount(1, $wheres);
        $this->assertEquals('raw', $wheres[0]['type']);
        $this->assertEquals("`first` || ' ' || `last` = ?", $wheres[0]['sql']);
        $this->assertEquals('and', $wheres[0]['boolean']);
    }

    public function testWhereConcatMySql() 
    {
        $this->connection->method('getDriverName')
            ->willReturn('mysql');

        $builder = new Builder($this->connection);
        $builder->whereConcat(['first', 'last'], '=', 'Hello World');

        $wheres = $builder->wheres;
        $this->assertCount(1, $wheres);
        $this->assertEquals('raw', $wheres[0]['type']);
        $this->assertEquals("CONCAT(`first`, ' ', `last`) = ?", $wheres[0]['sql']);
        $this->assertEquals('and', $wheres[0]['boolean']);
    }

    public function testOrWhereConcatSqlite() 
    {
        $this->connection->method('getDriverName')
            ->willReturn('sqlite');

        $builder = new Builder($this->connection);
        $builder->orWhereConcat(['first', 'last'], '=', 'Hello World');

        $wheres = $builder->wheres;
        $this->assertCount(1, $wheres);
        $this->assertEquals('raw', $wheres[0]['type']);
        $this->assertEquals("`first` || ' ' || `last` = ?", $wheres[0]['sql']);
        $this->assertEquals('or', $wheres[0]['boolean']);
    }

    public function testOrWhereConcatMySql() 
    {
        $this->connection->method('getDriverName')
            ->willReturn('mysql');

        $builder = new Builder($this->connection);
        $builder->orWhereConcat(['first', 'last'], '=', 'Hello World');

        $wheres = $builder->wheres;
        $this->assertCount(1, $wheres);
        $this->assertEquals('raw', $wheres[0]['type']);
        $this->assertEquals("CONCAT(`first`, ' ', `last`) = ?", $wheres[0]['sql']);
        $this->assertEquals('or', $wheres[0]['boolean']);
    }
}