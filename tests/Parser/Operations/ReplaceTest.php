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

namespace cogpowered\FineDiff\Tests\Parser\Operations;

use cogpowered\FineDiff\Parser\Operations\OperationInterface;
use cogpowered\FineDiff\Parser\Operations\Replace;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ReplaceTest extends TestCase
{
    #[Test]
    public function instanceImplementsOperationsInterface(): void
    {
        self::assertInstanceOf(OperationInterface::class, new Replace(2, 'world'));
    }

    #[Test]
    public function getFromLen(): void
    {
        self::assertEquals(5, (new Replace(5, 'world'))->getFromLen());
    }

    #[Test]
    public function testGetText(): void
    {
        self::assertEquals('bar', (new Replace(3, 'bar'))->getText());
    }

    #[Test]
    public function getToLen(): void
    {
        self::assertEquals(5, (new Replace(3, 'world'))->getToLen());
    }

    /**
     * @return array<string, array<int, int|string>>
     */
    public static function getOpcodeDataProvider(): array
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

    #[Test]
    #[DataProvider('getOpcodeDataProvider')]
    public function getOpcode(int $fromLen, string $text, string $expected): void
    {
        self::assertSame($expected, (new Replace($fromLen, $text))->getOpcode());
    }
}
