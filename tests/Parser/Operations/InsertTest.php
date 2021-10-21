<?php

namespace cogpowered\FineDiff\Tests\Parser\Operations;

use cogpowered\FineDiff\Parser\Operations\Insert;
use cogpowered\FineDiff\Parser\Operations\OperationInterface;
use PHPUnit\Framework\TestCase;

class InsertTest extends TestCase
{
    public function testImplementsOperationInterface()
    {
        $replace = new Insert('hello world');
        self::assertTrue(is_a($replace, OperationInterface::class));
    }

    public function testGetFromLen()
    {
        $insert = new Insert('hello world');
        self::assertEquals($insert->getFromLen(), 0);
    }

    public function testGetToLen()
    {
        $insert = new Insert('hello world');
        self::assertEquals($insert->getToLen(), 11);
    }

    public function testGetText()
    {
        $insert = new Insert('foobar');
        self::assertEquals($insert->getText(), 'foobar');
    }

    public function testGetOpcode()
    {
        $insert = new Insert('C');
        self::assertEquals($insert->getOpcode(), 'i:C');

        $insert = new Insert('blue');
        self::assertEquals($insert->getOpcode(), 'i4:blue');
    }
}
