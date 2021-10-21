<?php

namespace FineDiffTests;

use PHPUnit\Framework\TestCase;

if (class_exists('PHPUnit_Framework_TestCase')) {
    class BaseTestCase extends \PHPUnit_Framework_TestCase
    {

    }
} else {
    class BaseTestCase extends TestCase
    {

    }
}
