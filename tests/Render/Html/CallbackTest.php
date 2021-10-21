<?php

namespace cogpowered\FineDiff\Tests\Render\Html;

use cogpowered\FineDiff\Render\Html;
use PHPUnit\Framework\TestCase;

class CallbackTest extends TestCase
{
    /**
     * @var Html
     */
    private $html;

    public function setUp(): void
    {
        $this->html = new Html();
    }

    public function testCopy()
    {
        $output = $this->html->callback('c', 'Hello', 0, 5);
        self::assertEquals($output, 'Hello');

        $output = $this->html->callback('c', 'He&llo', 0, 100);
        self::assertEquals($output, 'He&amp;llo');
    }

    public function testDelete()
    {
        $output = $this->html->callback('d', 'el', 0, 2);
        self::assertEquals($output, '<del>el</del>');

        $output = $this->html->callback('d', 'e&l', 0, 100);
        self::assertEquals($output, '<del>e&amp;l</del>');
    }

    public function testInsert()
    {
        $output = $this->html->callback('i', 'monkey', 0, 6);
        self::assertEquals($output, '<ins>monkey</ins>');

        $output = $this->html->callback('i', 'mon&key', 0, 100);
        self::assertEquals($output, '<ins>mon&amp;key</ins>');
    }
}
