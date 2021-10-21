<?php

namespace cogpowered\FineDiff\Tests\Delimiters;

use cogpowered\FineDiff\Delimiters;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    public function testCantInstantiate()
    {
        $class   = new \ReflectionClass(Delimiters::class);
        $methods = $class->getMethods(\ReflectionMethod::IS_PRIVATE);

        self::assertTrue(count($methods) >= 1);

        $found = false;

        foreach ($methods as $method) {
            if ($method->name === '__construct') {
                $found = true;
                self::assertTrue(true);
                break;
            }
        }

        if (!$found) {
            self::assertTrue(false);
        }
    }
}
