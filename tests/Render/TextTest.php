<?php

declare(strict_types=1);

/*
 * FINE granularity DIFF
 *
 * (c) 2011 Raymond Hill (http://raymondhill.net/blog/?p=441)
 * (c) 2013 Robert Crowe (http://cogpowered.com)
 * (c) 2021 Christian Kuhn
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace cogpowered\FineDiff\Tests\Render;

use cogpowered\FineDiff\Render\Text;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TextTest extends TestCase
{
    #[Test]
    public function processThrowsWithInvalidOpcodes(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        (new Text())->process('Hello worlds', 123);
    }

    #[Test]
    public function processWorksWithSimpleString(): void
    {
        self::assertEquals('Hello2 world', (new Text())->process('Hello worlds', 'c5i:2c6d'));
    }

    #[Test]
    public function callbackReturnsExpectedResults(): void
    {
        $subject = new Text();
        self::assertEquals('Hello', $subject->callback('c', 'Hello', 0, 5));
        self::assertEquals('Hel', $subject->callback('c', 'Hello', 0, 3));
        self::assertEquals('', $subject->callback('d', 'elephant', 0, 100));
        self::assertEquals('', $subject->callback('d', 'elephant', 3, 4));
        self::assertEquals('monkey', $subject->callback('i', 'monkey', 0, 6));
        self::assertEquals('nke', $subject->callback('i', 'monkey', 2, 3));
    }
}
