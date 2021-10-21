<?php

namespace cogpowered\FineDiff\Tests\Parser;

use Mockery;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Parser\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function setUp(): void
    {
        $granularity  = new Character;
        $this->parser = new Parser($granularity);
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testInstanceOf()
    {
        $this->assertTrue(is_a($this->parser, 'cogpowered\FineDiff\Parser\ParserInterface'));
    }

    public function testDefaultOpcodes()
    {
        $opcodes = $this->parser->getOpcodes();
        $this->assertTrue(is_a($opcodes, 'cogpowered\FineDiff\Parser\OpcodesInterface'));
    }

    public function testSetOpcodes()
    {
        $opcodes = Mockery::mock('cogpowered\FineDiff\Parser\Opcodes');
        $opcodes->shouldReceive('foo')->andReturn('bar');
        $this->parser->setOpcodes($opcodes);

        $opcodes = $this->parser->getOpcodes();
        $this->assertEquals($opcodes->foo(), 'bar');
    }

    public function testParseBadGranularity()
    {
        $this->expectException(\cogpowered\FineDiff\Exceptions\GranularityCountException::class);
        $granularity = Mockery::mock('cogpowered\FineDiff\Granularity\Character');
        $granularity->shouldReceive('count')->andReturn(0);
        $parser = new Parser($granularity);

        $parser->parse('hello world', 'hello2 worl');
    }

    public function testParseSetOpcodes()
    {
        $opcodes = Mockery::mock('cogpowered\FineDiff\Parser\Opcodes');
        $opcodes->shouldReceive('setOpcodes')->once();
        $this->parser->setOpcodes($opcodes);

        $this->parser->parse('Hello worlds', 'Hello2 world');
    }
}
