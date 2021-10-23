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

namespace cogpowered\FineDiff\Tests\Parser;

use cogpowered\FineDiff\Exceptions\GranularityCountException;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Granularity\Granularity;
use cogpowered\FineDiff\Parser\Opcodes;
use cogpowered\FineDiff\Parser\OpcodesInterface;
use cogpowered\FineDiff\Parser\Parser;
use cogpowered\FineDiff\Parser\ParserInterface;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /**
     * @test
     */
    public function isInstanceOfParserInterface(): void
    {
        self::assertInstanceOf(ParserInterface::class, new Parser(new Character()));
    }

    /**
     * @test
     */
    public function opcodesIsCreated(): void
    {
        self::assertInstanceOf(OpcodesInterface::class, (new Parser(new Character()))->getOpcodes());
    }

    /**
     * @test
     */
    public function opcodesCanBeSetAndSet(): void
    {
        $opcodes = new Opcodes();
        $subject = new Parser(new Character());
        $subject->setOpcodes($opcodes);
        self::assertSame($opcodes, $subject->getOpcodes());
    }

    /**
     * @test
     */
    public function parseThrowsWithEmptyGranularity(): void
    {
        $this->expectException(GranularityCountException::class);
        $granularity = new class() extends Granularity {
        };
        (new Parser($granularity))->parse('foo', 'bar');
    }
}
