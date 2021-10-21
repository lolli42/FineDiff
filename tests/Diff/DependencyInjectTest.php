<?php

namespace cogpowered\FineDiff\Tests\Diff;

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
        $character = Mockery::mock('cogpowered\FineDiff\Granularity\Character');
        $character->shouldReceive('justTesting')->once();

        $diff = new Diff($character);
        $granularity = $diff->getGranularity();

        $granularity->justTesting();
    }

    public function testGetRenderer()
    {
        $html = Mockery::mock('cogpowered\FineDiff\Render\Html');
        $html->shouldReceive('justTesting')->once();

        $diff = new Diff(null, $html);
        $renderer = $diff->getRenderer();

        $renderer->justTesting();
    }

    public function testRender()
    {
        $opcodes = Mockery::mock('cogpowered\FineDiff\Parser\Opcodes');
        $opcodes->shouldReceive('generate')->andReturn('c12');

        $parser = Mockery::mock('cogpowered\FineDiff\Parser\Parser');
        $parser->shouldReceive('parse')->andReturn($opcodes);

        $html = Mockery::mock('cogpowered\FineDiff\Render\Html');
        $html->shouldReceive('process')->with('hello', $opcodes)->once();


        $diff = new Diff(null, $html, $parser);
        $diff->render('hello', 'hello2');
    }

    public function testGetParser()
    {
        $parser = Mockery::mock('cogpowered\FineDiff\Parser\Parser');
        $parser->shouldReceive('justTesting')->once();

        $diff = new Diff(null, null, $parser);
        $parser = $diff->getParser();

        $parser->justTesting();
    }

    public function testGetOpcodes()
    {
        $parser = Mockery::mock('cogpowered\FineDiff\Parser\Parser');
        $parser->shouldReceive('parse')->with('foobar', 'eggfooba')->once();

        $diff = new Diff(null, null, $parser);
        $diff->getOpcodes('foobar', 'eggfooba');
    }
}
