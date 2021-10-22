<?php

namespace cogpowered\FineDiff\Tests\Render;

use cogpowered\FineDiff\Render\Html;
use PHPUnit\Framework\TestCase;

class HtmlTest extends TestCase
{
    /**
     * @test
     */
    public function processWorksWithSimpleString(): void
    {
        self::assertEquals('Hello<ins>2</ins> world<del>s</del>', (new Html())->process('Hello worlds', 'c5i:2c6d'));
    }

    /**
     * @test
     */
    public function callbackReturnsExpectedResults(): void
    {
        $subject = new Html();
        self::assertEquals('Hello', $subject->callback('c', 'Hello', 0, 5));
        self::assertEquals('He&amp;llo', $subject->callback('c', 'He&llo', 0, 100));
        self::assertEquals('<del>el</del>', $subject->callback('d', 'el', 0, 2));
        self::assertEquals('<del>e&amp;l</del>', $subject->callback('d', 'e&l', 0, 100));
        self::assertEquals('<ins>monkey</ins>', $subject->callback('i', 'monkey', 0, 6));
        self::assertEquals('<ins>mon&amp;key</ins>', $subject->callback('i', 'mon&key', 0, 100));
    }
}
