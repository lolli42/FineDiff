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

use cogpowered\FineDiff\Parser\Operations\Delete;
use cogpowered\FineDiff\Parser\Operations\OperationInterface;
use PHPUnit\Framework\TestCase;

class DeleteTest extends TestCase
{
    /**
     * @test
     */
    public function instanceImplementsOperationsInterface(): void
    {
        self::assertInstanceOf(OperationInterface::class, new Delete(10));
    }

    /**
     * @test
     */
    public function getFromLenFromConstruct(): void
    {
        self::assertEquals(10, (new Delete(10))->getFromLen());
    }

    /**
     * @test
     */
    public function getToLenFromConstruct(): void
    {
        self::assertEquals(0, (new Delete(342))->getToLen());
    }

    /**
     * @test
     */
    public function getOpcode(): void
    {
        self::assertEquals('d', (new Delete(1))->getOpcode());
        self::assertEquals('d24', (new Delete(24))->getOpcode());
    }
}
