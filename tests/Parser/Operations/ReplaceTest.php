<?php

declare(strict_types=1);

namespace cogpowered\FineDiff\Tests\Parser\Operations;

use cogpowered\FineDiff\Parser\Operations\OperationInterface;
use cogpowered\FineDiff\Parser\Operations\Replace;
use PHPUnit\Framework\TestCase;

class ReplaceTest extends TestCase
{
    /**
     * @test
     */
    public function instanceImplementsOperationsInterface(): void
    {
        self::assertInstanceOf(OperationInterface::class, new Replace(2, 'world'));
    }

    /**
     * @test
     */
    public function getFromLen(): void
    {
        self::assertEquals(5, (new Replace(5, 'world'))->getFromLen());
    }

    /**
     * @test
     */
    public function testGetText(): void
    {
        self::assertEquals('bar', (new Replace(3, 'bar'))->getText());
    }

    /**
     * @test
     */
    public function getToLen(): void
    {
        self::assertEquals(5, (new Replace(3, 'world'))->getToLen());
    }

    public function getOpcodeDataProvider(): array
    {
        return [
            'replace single char' => [
                1, // toLen
                'c', // text
                'di:c', // delete 1 char, insert c
            ],
            'replace single char with multi chars' => [
                1,
                'crowe',
                'di5:crowe', // delete 1 char, insert crowe
            ],
            'replace multi char with single' => [
                2,
                'c',
                'd2i:c', // delete 2 char, insert c
            ],
            'replace multi char with multi' => [
                2,
                'cr',
                'd2i2:cr', // delete 2 char, insert c
            ],
        ];
    }

    /**
     * @test
     * @dataProvider getOpcodeDataProvider
     */
    public function getOpcode($fromLen, $text, $expected): void
    {
        self::assertSame($expected, (new Replace($fromLen, $text))->getOpcode());
    }
}
