<?php

namespace cogpowered\FineDiff\Tests\Parser\Operations;

use cogpowered\FineDiff\Parser\Operations\OperationInterface;
use cogpowered\FineDiff\Parser\Operations\Replace;
use PHPUnit\Framework\TestCase;

class ReplaceTest extends TestCase
{
    public function testImplementsOperationInterface()
    {
        $replace = new Replace('hello', 'world');
        self::assertTrue(is_a($replace, OperationInterface::class));
    }

    public function testGetFromLen()
    {
        $replace = new Replace('hello', 'world');
        self::assertEquals($replace->getFromLen(), 'hello');
    }

    public function testGetToLen()
    {
        $replace = new Replace('hello', 'world');
        self::assertEquals($replace->getToLen(), 5);
    }

    public function testGetText()
    {
        $replace = new Replace('foo', 'bar');
        self::assertEquals($replace->getText(), 'bar');
    }

    public function testGetOpcodeSingleTextChar()
    {
        $replace = new Replace(1, 'c');
        self::assertEquals($replace->getOpcode(), 'di:c');

        $replace = new Replace('r', 'c');
        self::assertEquals($replace->getOpcode(), 'dri:c');

        $replace = new Replace('rob', 'c');
        self::assertEquals($replace->getOpcode(), 'drobi:c');
    }

    public function testGetOpcodeLongerTextString()
    {
        $replace = new Replace(1, 'crowe');
        self::assertEquals($replace->getOpcode(), 'di5:crowe');

        $replace = new Replace('r', 'crowe');
        self::assertEquals($replace->getOpcode(), 'dri5:crowe');

        $replace = new Replace('rob', 'crowe');
        self::assertEquals($replace->getOpcode(), 'drobi5:crowe');
    }
}
