<?php

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
