<?php

namespace cogpowered\FineDiff\Tests\Parser;

use cogpowered\FineDiff\Exceptions\OperationException;
use cogpowered\FineDiff\Parser\OpcodesInterface;
use cogpowered\FineDiff\Parser\Operations\Copy;
use Mockery;
use cogpowered\FineDiff\Parser\Opcodes;
use PHPUnit\Framework\TestCase;

class OpcodesTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testInstanceOf()
    {
        $this->assertTrue(is_a(new Opcodes, OpcodesInterface::class));
    }

    public function testEmptyOpcodes()
    {
        $opcodes = new Opcodes;
        $this->assertEmpty($opcodes->getOpcodes());
    }

    public function testSetOpcodes()
    {
        $operation = Mockery::mock(Copy::class);
        $operation->shouldReceive('getOpcode')->once()->andReturn('testing');

        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array($operation));

        $opcodes = $opcodes->getOpcodes();
        $this->assertEquals($opcodes[0], 'testing');
    }

    public function testNotOperation()
    {
        $this->expectException(OperationException::class);
        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array('test'));
    }

    public function testGetOpcodes()
    {
        $operation_one = Mockery::mock(Copy::class);
        $operation_one->shouldReceive('getOpcode')->andReturn('c5i');

        $operation_two = Mockery::mock(Copy::class);
        $operation_two->shouldReceive('getOpcode')->andReturn('2c6d');

        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array($operation_one, $operation_two));

        $opcodes = $opcodes->getOpcodes();

        $this->assertTrue(is_array($opcodes));
        $this->assertEquals($opcodes[0], 'c5i');
        $this->assertEquals($opcodes[1], '2c6d');
    }

    public function testGenerate()
    {
        $operation_one = Mockery::mock(Copy::class);
        $operation_one->shouldReceive('getOpcode')->andReturn('c5i');

        $operation_two = Mockery::mock(Copy::class);
        $operation_two->shouldReceive('getOpcode')->andReturn('2c6d');

        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array($operation_one, $operation_two));

        $this->assertEquals($opcodes->generate(), 'c5i2c6d');
    }

    public function testToString()
    {
        $operation_one = Mockery::mock(Copy::class);
        $operation_one->shouldReceive('getOpcode')->andReturn('c5i');

        $operation_two = Mockery::mock(Copy::class);
        $operation_two->shouldReceive('getOpcode')->andReturn('2c6d');

        $opcodes = new Opcodes;
        $opcodes->setOpcodes(array($operation_one, $operation_two));

        $this->assertEquals((string)$opcodes, 'c5i2c6d');
        $this->assertEquals((string)$opcodes, $opcodes->generate());
    }
}
