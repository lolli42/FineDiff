<?php

namespace cogpowered\FineDiff\Tests\Diff;

use cogpowered\FineDiff\Diff;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Granularity\Word;
use cogpowered\FineDiff\Parser\Opcodes;
use cogpowered\FineDiff\Parser\Parser;
use cogpowered\FineDiff\Render\Html;
use Mockery;
use PHPUnit\Framework\TestCase;

class DependencyInjectTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testGetGranularity()
    {
        $character = new Character();
        self::assertSame($character, (new Diff($character))->getGranularity());
    }

    public function testGetRenderer()
    {
        $html = new Html();
        self::assertSame($html, (new Diff(null, $html))->getRenderer());
    }

    public function testRender()
    {
        // Dummy to make phpunit not mark this test risky
        self::assertTrue(true);

        $opcodes = Mockery::mock(Opcodes::class);
        $opcodes->shouldReceive('generate')->andReturn('c12');

        $parser = Mockery::mock(Parser::class);
        $parser->shouldReceive('parse')->andReturn($opcodes);

        $html = Mockery::mock(Html::class);
        $html->shouldReceive('process')->with('hello', $opcodes)->once();

        $diff = new Diff(null, $html, $parser);
        $diff->render('hello', 'hello2');
    }

    public function testGetParser()
    {
        $parser = new Parser(new Word());
        self::assertSame($parser, (new Diff(null, null, $parser))->getParser());
    }

    public function testGetOpcodes()
    {
        // Dummy to make phpunit not mark this test risky
        self::assertTrue(true);

        $parser = Mockery::mock(Parser::class);
        $parser->shouldReceive('parse')->with('foobar', 'eggfooba')->once();

        $diff = new Diff(null, null, $parser);
        $diff->getOpcodes('foobar', 'eggfooba');
    }
}
