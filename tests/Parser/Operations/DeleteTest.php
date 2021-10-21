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
        $this->assertTrue(is_a($replace, OperationInterface::class));
    }

    public function testGetFromLen()
    {
        $delete = new Delete(10);
        $this->assertEquals($delete->getFromLen(), 10);
    }

    public function testGetToLen()
    {
        $delete = new Delete(342);
        $this->assertEquals($delete->getToLen(), 0);
    }

    public function testGetOpcode()
    {
        $delete = new Delete(1);
        $this->assertEquals($delete->getOpcode(), 'd');

        $delete = new Delete(24);
        $this->assertEquals($delete->getOpcode(), 'd24');
    }
}
