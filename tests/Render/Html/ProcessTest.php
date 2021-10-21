<?php

namespace cogpowered\FineDiff\Tests\Render\Html;

use cogpowered\FineDiff\Parser\Opcodes;
use Mockery;
use cogpowered\FineDiff\Render\Html;
use PHPUnit\Framework\TestCase;

class ProcessTest extends TestCase
{
    public function setUp(): void
    {
        $this->html = new Html;
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testProcess()
    {
        $opcodes = Mockery::mock(Opcodes::class);
        $opcodes->shouldReceive('generate')->andReturn('c5i:2c6d')->once();

        $html = $this->html->process('Hello worlds', $opcodes);

        self::assertEquals($html, 'Hello<ins>2</ins> world<del>s</del>');
    }
}