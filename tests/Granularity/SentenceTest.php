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
