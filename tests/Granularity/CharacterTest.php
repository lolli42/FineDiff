<?php
declare(strict_types=1);

namespace cogpowered\FineDiff\Tests\Granularity;

use cogpowered\FineDiff\Delimiters;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Granularity\GranularityInterface;
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    /**
     * @test
     */
    public function instanceImplementsClasses(): void
    {
        $subject = new Character();
        self::assertInstanceOf(\Countable::class, $subject);
        self::assertInstanceOf(\ArrayAccess::class, $subject);
        self::assertInstanceOf(GranularityInterface::class, $subject);
    }

    /**
     * @test
     */
    public function getDelimitersReturnsDelimiters(): void
    {
        self::assertEquals(
            [Delimiters::PARAGRAPH, Delimiters::SENTENCE, Delimiters::WORD, Delimiters::CHARACTER],
            (new Character())->getDelimiters()
        )
        ;
    }

    /**
     * @test
     */
    public function isCountable(): void
    {
        self::assertCount(4, new Character());
    }

    /**
     * @test
     */
    public function setAndGetDelimiters(): void
    {
        $delimiters = ['one', 'two'];
        $subject = new Character();
        $subject->setDelimiters($delimiters);
        self::assertEquals($delimiters, $subject->getDelimiters());
    }

    /**
     * @test
     */
    public function arrayAccess(): void
    {
        $subject = new Character();
        self::assertSame(Delimiters::SENTENCE, $subject[1]);
        $subject[1] = 'foo';
        self::assertSame('foo', $subject[1]);
        unset($subject[1]);
        self::assertCount(3, $subject);
    }
}
