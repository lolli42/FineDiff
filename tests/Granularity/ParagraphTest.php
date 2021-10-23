<?php
declare(strict_types=1);

namespace cogpowered\FineDiff\Tests\Granularity;

use cogpowered\FineDiff\Delimiters;
use cogpowered\FineDiff\Granularity\GranularityInterface;
use cogpowered\FineDiff\Granularity\Paragraph;
use PHPUnit\Framework\TestCase;

class ParagraphTest extends TestCase
{
    /**
     * @test
     */
    public function instanceImplementsClasses(): void
    {
        self::assertInstanceOf(\Countable::class, new Paragraph());
        self::assertInstanceOf(\ArrayAccess::class, new Paragraph());
        self::assertInstanceOf(GranularityInterface::class, new Paragraph());
    }

    /**
     * @test
     */
    public function getDelimitersReturnsDelimiters(): void
    {
        self::assertEquals([Delimiters::PARAGRAPH], (new Paragraph())->getDelimiters());
    }
}
