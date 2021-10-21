<?php

namespace cogpowered\FineDiff\Tests\Delimiters;

use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    public function testCantInstantiate()
    {
        $class   = new \ReflectionClass('cogpowered\FineDiff\Delimiters');
        $methods = $class->getMethods(\ReflectionMethod::IS_PRIVATE);

        $this->assertTrue(count($methods) >= 1);

        $found = false;

        foreach ($methods as $method) {
            if ($method->name === '__construct') {
                $found = true;
                $this->assertTrue(true);
                break;
            }
        }

        if (!$found) {
            $this->assertTrue(false);
        }
    }
}