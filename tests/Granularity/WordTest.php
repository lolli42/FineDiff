<?php

namespace cogpowered\FineDiff\Tests\Granularity;

use cogpowered\FineDiff\Delimiters;
use cogpowered\FineDiff\Granularity\GranularityInterface;
use cogpowered\FineDiff\Granularity\Word;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    /**
     * @test
     */
    public function instanceImplementsClasses(): void
    {
        self::assertInstanceOf(\Countable::class, new Word());
        self::assertInstanceOf(\ArrayAccess::class, new Word());
        self::assertInstanceOf(GranularityInterface::class, new Word());
    }

    /**
     * @test
     */
    public function getDelimitersReturnsDelimiters(): void
    {
        self::assertEquals([Delimiters::PARAGRAPH, Delimiters::SENTENCE, Delimiters::WORD], (new Word())->getDelimiters());
    }
}
