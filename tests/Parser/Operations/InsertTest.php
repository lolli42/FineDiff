<?php
declare(strict_types=1);

namespace cogpowered\FineDiff\Tests\Parser\Operations;

use cogpowered\FineDiff\Parser\Operations\Insert;
use cogpowered\FineDiff\Parser\Operations\OperationInterface;
use PHPUnit\Framework\TestCase;

class InsertTest extends TestCase
{
    /**
     * @test
     */
    public function instanceImplementsOperationsInterface(): void
    {
        self::assertInstanceOf(OperationInterface::class, new Insert('foo'));
    }

    /**
     * @test
     */
    public function getFromLenFromDefault(): void
    {
        self::assertEquals(0, (new Insert('hello world'))->getFromLen());
    }

    /**
     * @test
     */
    public function testGetToLenFromConstruct(): void
    {
        self::assertEquals(11, (new Insert('hello world'))->getToLen());
    }

    /**
     * @test
     */
    public function getTextFromConstruct(): void
    {
        self::assertEquals('foobar', (new Insert('foobar'))->getText());
    }

    /**
     * @test
     */
    public function getOpcode(): void
    {
        self::assertEquals('i:C', (new Insert('C'))->getOpcode());
        self::assertEquals('i4:blue', (new Insert('blue'))->getOpcode());
    }
}
