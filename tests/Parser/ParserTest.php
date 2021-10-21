<?php

namespace cogpowered\FineDiff\Tests\Parser;

use cogpowered\FineDiff\Exceptions\GranularityCountException;
use cogpowered\FineDiff\Parser\Opcodes;
use cogpowered\FineDiff\Parser\OpcodesInterface;
use cogpowered\FineDiff\Parser\ParserInterface;
use Mockery;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Parser\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /**
     * @var Parser
     */
    private $parser;

    public function setUp(): void
    {
        $this->parser = new Parser(new Character());
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testInstanceOf()
    {
        self::assertTrue(is_a($this->parser, ParserInterface::class));
    }

    public function testDefaultOpcodes()
    {
        $opcodes = $this->parser->getOpcodes();
        self::assertTrue(is_a($opcodes, OpcodesInterface::class));
    }

    public function testSetOpcodes()
    {
        $opcodes = Mockery::mock(Opcodes::class);
        $opcodes->shouldReceive('foo')->andReturn('bar');
        $this->parser->setOpcodes($opcodes);

        $opcodes = $this->parser->getOpcodes();
        self::assertEquals($opcodes->foo(), 'bar');
    }

    public function testParseBadGranularity()
    {
        $this->expectException(GranularityCountException::class);
        $granularity = Mockery::mock(Character::class);
        $granularity->shouldReceive('count')->andReturn(0);
        $parser = new Parser($granularity);

        $parser->parse('hello world', 'hello2 worl');
    }

    public function testParseSetOpcodes()
    {
        // Dummy to make phpunit not mark this test risky
        self::assertTrue(true);

        $opcodes = Mockery::mock(Opcodes::class);
        $opcodes->shouldReceive('setOpcodes')->once();
        $this->parser->setOpcodes($opcodes);

        $this->parser->parse('Hello worlds', 'Hello2 world');
    }
}
