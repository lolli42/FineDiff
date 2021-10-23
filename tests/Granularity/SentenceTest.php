<?php

declare(strict_types=1);

namespace cogpowered\FineDiff\Tests\Granularity;

use cogpowered\FineDiff\Delimiters;
use cogpowered\FineDiff\Granularity\GranularityInterface;
use cogpowered\FineDiff\Granularity\Sentence;
use PHPUnit\Framework\TestCase;

class SentenceTest extends TestCase
{
    /**
     * @test
     */
    public function instanceImplementsClasses(): void
    {
        self::assertInstanceOf(\Countable::class, new Sentence());
        self::assertInstanceOf(\ArrayAccess::class, new Sentence());
        self::assertInstanceOf(GranularityInterface::class, new Sentence());
    }

    /**
     * @test
     */
    public function getDelimitersReturnsDelimiters(): void
    {
        self::assertEquals([Delimiters::PARAGRAPH, Delimiters::SENTENCE], (new Sentence())->getDelimiters());
    }
}
