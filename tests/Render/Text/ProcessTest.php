<?php

namespace FineDiffTests\Render\Text;

use Mockery as m;
use cogpowered\FineDiff\Render\Text;
use PHPUnit\Framework\TestCase;

class ProcessTest extends TestCase
{
    public function setUp(): void
    {
        $this->text = new Text;
    }

    public function tearDown(): void
    {
        m::close();
    }

    public function testInvalidOpcode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->text->process('Hello worlds', 123);
    }

    public function testProcessWithString()
    {
        $html = $this->text->process('Hello worlds', 'c5i:2c6d');

        $this->assertEquals($html, 'Hello2 world');
    }

    public function testProcess()
    {
        $opcodes = m::mock('cogpowered\FineDiff\Parser\Opcodes');
        $opcodes->shouldReceive('generate')->andReturn('c5i:2c6d')->once();

        $html = $this->text->process('Hello worlds', $opcodes);

        $this->assertEquals($html, 'Hello2 world');
    }
}