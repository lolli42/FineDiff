<?php

namespace cogpowered\FineDiff\Tests\Diff;

use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Parser\Opcodes;
use cogpowered\FineDiff\Parser\Parser;
use cogpowered\FineDiff\Render\Html;
use Mockery;
use cogpowered\FineDiff\Diff;
use PHPUnit\Framework\TestCase;

class DependencyInjectTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testGetGranularity()
    {
        // Dummy to make phpunit not mark this test risky
        self::assertTrue(true);

        $character = Mockery::mock(Character::class);
        $character->shouldReceive('justTesting')->once();

        $diff = new Diff($character);
        $granularity = $diff->getGranularity();

        $granularity->justTesting();
    }

    public function testGetRenderer()
    {
        // Dummy to make phpunit not mark this test risky
        self::assertTrue(true);

        $html = Mockery::mock(Html::class);
        $html->shouldReceive('justTesting')->once();

        $diff = new Diff(null, $html);
        $renderer = $diff->getRenderer();

        $renderer->justTesting();
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
        // Dummy to make phpunit not mark this test risky
        self::assertTrue(true);

        $parser = Mockery::mock(Parser::class);
        $parser->shouldReceive('justTesting')->once();

        $diff = new Diff(null, null, $parser);
        $parser = $diff->getParser();

        $parser->justTesting();
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
