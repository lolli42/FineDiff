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

namespace cogpowered\FineDiff\Tests\Granularity;

use cogpowered\FineDiff\Delimiters;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Granularity\GranularityInterface;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    #[Test]
    public function instanceImplementsClasses(): void
    {
        $subject = new Character();
        self::assertInstanceOf(\Countable::class, $subject);
        self::assertInstanceOf(\ArrayAccess::class, $subject);
        self::assertInstanceOf(GranularityInterface::class, $subject);
    }

    #[Test]
    public function getDelimitersReturnsDelimiters(): void
    {
        self::assertEquals(
            [Delimiters::PARAGRAPH, Delimiters::SENTENCE, Delimiters::WORD, Delimiters::CHARACTER],
            (new Character())->getDelimiters()
        )
        ;
    }

    #[Test]
    public function isCountable(): void
    {
        self::assertCount(4, new Character());
    }

    #[Test]
    public function setAndGetDelimiters(): void
    {
        $delimiters = [['one'], ['two']];
        $subject = new Character();
        $subject->setDelimiters($delimiters);
        self::assertEquals($delimiters, $subject->getDelimiters());
    }

    #[Test]
    public function arrayAccess(): void
    {
        $subject = new Character();
        self::assertSame(Delimiters::SENTENCE, $subject[1]);
        $subject[1] = Delimiters::PARAGRAPH;
        self::assertSame(Delimiters::PARAGRAPH, $subject[1]);
        unset($subject[1]);
        self::assertCount(3, $subject);
    }
}
