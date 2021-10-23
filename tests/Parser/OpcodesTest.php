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

use cogpowered\FineDiff\Exceptions\OperationException;
use cogpowered\FineDiff\Parser\Opcodes;
use cogpowered\FineDiff\Parser\OpcodesInterface;
use cogpowered\FineDiff\Parser\Operations\Copy;
use PHPUnit\Framework\TestCase;

class OpcodesTest extends TestCase
{
    /**
     * @test
     */
    public function isInstanceOfOpcodesInterface(): void
    {
        self::assertInstanceOf(OpcodesInterface::class, new Opcodes());
    }

    /**
     * @test
     */
    public function setOpcodesThrowsExceptionOnInvalidOperation(): void
    {
        $this->expectException(OperationException::class);
        $opcodes = new Opcodes();
        $opcodes->setOpcodes(['test']);
    }

    /**
     * @test
     */
    public function getOpcodesReturnsEmptyOpcodes(): void
    {
        self::assertSame([], (new Opcodes())->getOpcodes());
    }

    /**
     * @test
     */
    public function getOpcodesProcessSimpleOperation(): void
    {
        $copyOperation = new Copy(0);
        $subject = new Opcodes();
        $subject->setOpcodes([$copyOperation]);
        self::assertEquals(['c0'], $subject->getOpcodes());
    }

    /**
     * @test
     */
    public function getOpcodesProcessMultipleOperations(): void
    {
        $copyOperation1 = new Copy(3);
        $copyOperation2 = new Copy(5);
        $subject = new Opcodes();
        $subject->setOpcodes([$copyOperation1, $copyOperation2]);
        self::assertEquals(['c3', 'c5'], $subject->getOpcodes());
    }

    /**
     * @test
     */
    public function generateReturnsOpcode(): void
    {
        $copyOperation1 = new Copy(3);
        $copyOperation2 = new Copy(5);
        $subject = new Opcodes();
        $subject->setOpcodes([$copyOperation1, $copyOperation2]);
        self::assertEquals('c3c5', $subject->generate());
    }

    /**
     * @test
     */
    public function castToString(): void
    {
        $copyOperation1 = new Copy(3);
        $copyOperation2 = new Copy(5);
        $subject = new Opcodes();
        $subject->setOpcodes([$copyOperation1, $copyOperation2]);
        self::assertEquals('c3c5', (string)$subject);
    }
}
