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

use cogpowered\FineDiff\Parser\Operations\Copy;
use cogpowered\FineDiff\Parser\Operations\OperationInterface;
use PHPUnit\Framework\TestCase;

class CopyTest extends TestCase
{
    /**
     * @test
     */
    public function instanceImplementsOperationsInterface(): void
    {
        self::assertInstanceOf(OperationInterface::class, new Copy(10));
    }

    /**
     * @test
     */
    public function getFromLenFromConstruct(): void
    {
        self::assertEquals(10, (new Copy(10))->getFromLen());
    }

    /**
     * @test
     */
    public function getToLenFromContstruct(): void
    {
        self::assertEquals(342, (new Copy(342))->getToLen());
    }

    /**
     * @test
     */
    public function getOpcodes(): void
    {
        self::assertEquals('c', (new Copy(1))->getOpcode());
        self::assertEquals('c24', (new Copy(24))->getOpcode());
    }

    /**
     * @test
     */
    public function increase(): void
    {
        $copy = new Copy(25);
        self::assertEquals(30, $copy->increase(5));
        self::assertEquals(40, $copy->increase(10));
        self::assertEquals(104, $copy->increase(64));
    }
}
