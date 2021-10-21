<?php

namespace cogpowered\FineDiff\Tests\Parser\Operations;

use cogpowered\FineDiff\Parser\Operations\Copy;
use cogpowered\FineDiff\Parser\Operations\OperationInterface;
use PHPUnit\Framework\TestCase;

class CopyTest extends TestCase
{
    public function testImplementsOperationInterface()
    {
        $replace = new Copy(10);
        self::assertTrue(is_a($replace, OperationInterface::class));
    }

    public function testGetFromLen()
    {
        $copy = new Copy(10);
        self::assertEquals($copy->getFromLen(), 10);
    }

    public function testGetToLen()
    {
        $copy = new Copy(342);
        self::assertEquals($copy->getToLen(), 342);
    }

    public function testGetOpcode()
    {
        $copy = new Copy(1);
        self::assertEquals($copy->getOpcode(), 'c');

        $copy = new Copy(24);
        self::assertEquals($copy->getOpcode(), 'c24');
    }

    public function testIncrease()
    {
        $copy = new Copy(25);

        self::assertEquals($copy->increase(5), 30);
        self::assertEquals($copy->increase(10), 40);
        self::assertEquals($copy->increase(64), 104);
    }
}
