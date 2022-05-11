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
        self::assertSame(["\n", "\r"], Delimiters::PARAGRAPH);
        self::assertSame(['.', "\n", "\r"], Delimiters::SENTENCE);
        self::assertSame([' ', "\t", '.', "\n", "\r"], Delimiters::WORD);
        self::assertSame([''], Delimiters::CHARACTER);
    }
}
