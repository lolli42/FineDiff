<?php

declare(strict_types=1);

namespace cogpowered\FineDiff\Tests;

use cogpowered\FineDiff\Delimiters;
use PHPUnit\Framework\TestCase;

class DelimitersTest extends TestCase
{
    /**
     * @test
     */
    public function constantsAsExpected(): void
    {
        self::assertEquals("\n\r", Delimiters::PARAGRAPH);
        self::assertEquals(".\n\r", Delimiters::SENTENCE);
        self::assertEquals(" \t.\n\r", Delimiters::WORD);
        self::assertEquals('', Delimiters::CHARACTER);
    }
}
