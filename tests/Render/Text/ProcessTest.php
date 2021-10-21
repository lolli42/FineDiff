<?php

namespace cogpowered\FineDiff\Tests\Render\Text;

use cogpowered\FineDiff\Parser\Opcodes;
use cogpowered\FineDiff\Render\Text;
use Mockery;
use PHPUnit\Framework\TestCase;

class ProcessTest extends TestCase
{
    /**
     * @var Text
     */
    private $text;

    public function setUp(): void
    {
        $this->text = new Text();
    }

    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testInvalidOpcode()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->text->process('Hello worlds', 123);
    }

    public function testProcessWithString()
    {
        $html = $this->text->process('Hello worlds', 'c5i:2c6d');

        self::assertEquals($html, 'Hello2 world');
    }

    public function testProcess()
    {
        $opcodes = Mockery::mock(Opcodes::class);
        $opcodes->shouldReceive('generate')->andReturn('c5i:2c6d')->once();

        $html = $this->text->process('Hello worlds', $opcodes);

        self::assertEquals($html, 'Hello2 world');
    }
}
