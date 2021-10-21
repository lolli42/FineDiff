<?php

namespace cogpowered\FineDiff\Tests\Parser\Operations;

use cogpowered\FineDiff\Parser\Operations\Delete;
use cogpowered\FineDiff\Parser\Operations\OperationInterface;
use PHPUnit\Framework\TestCase;

class DeleteTest extends TestCase
{
    public function testImplementsOperationInterface()
    {
        $replace = new Delete(10);
        self::assertTrue(is_a($replace, OperationInterface::class));
    }

    public function testGetFromLen()
    {
        $delete = new Delete(10);
        self::assertEquals($delete->getFromLen(), 10);
    }

    public function testGetToLen()
    {
        $delete = new Delete(342);
        self::assertEquals($delete->getToLen(), 0);
    }

    public function testGetOpcode()
    {
        $delete = new Delete(1);
        self::assertEquals($delete->getOpcode(), 'd');

        $delete = new Delete(24);
        self::assertEquals($delete->getOpcode(), 'd24');
    }
}
