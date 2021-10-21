<?php

namespace cogpowered\FineDiff\Tests\Render\Text;

use cogpowered\FineDiff\Render\Text;
use PHPUnit\Framework\TestCase;

class CallbackTest extends TestCase
{
    /**
     * @var Text
     */
    private $text;

    public function setUp(): void
    {
        $this->text = new Text();
    }

    public function testCopy()
    {
        $output = $this->text->callback('c', 'Hello', 0, 5);
        self::assertEquals($output, 'Hello');

        $output = $this->text->callback('c', 'Hello', 0, 3);
        self::assertEquals($output, 'Hel');
    }

    public function testDelete()
    {
        $output = $this->text->callback('d', 'elephant', 0, 100);
        self::assertEquals($output, '');

        $output = $this->text->callback('d', "elephant", 3, 4);
        self::assertEquals($output, '');
    }

    public function testInsert()
    {
        $output = $this->text->callback('i', 'monkey', 0, 6);
        self::assertEquals($output, 'monkey');

        $output = $this->text->callback('i', 'monkey', 2, 3);
        self::assertEquals($output, 'nke');
    }
}