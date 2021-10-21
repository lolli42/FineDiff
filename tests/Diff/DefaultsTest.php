<?php

namespace cogpowered\FineDiff\Tests\Diff;

use cogpowered\FineDiff\Diff;
use PHPUnit\Framework\TestCase;

class DefaultsTest extends TestCase
{
    public function setUp(): void
    {
        $this->diff = new Diff;
    }

    public function testGetGranularity()
    {
        $this->assertTrue(is_a($this->diff->getGranularity(), 'cogpowered\FineDiff\Granularity\Character'));
        $this->assertTrue(is_a($this->diff->getGranularity(), 'cogpowered\FineDiff\Granularity\Granularity'));
        $this->assertTrue(is_a($this->diff->getGranularity(), 'cogpowered\FineDiff\Granularity\GranularityInterface'));
    }

    public function testGetRenderer()
    {
        $this->assertTrue(is_a($this->diff->getRenderer(), 'cogpowered\FineDiff\Render\Html'));
        $this->assertTrue(is_a($this->diff->getRenderer(), 'cogpowered\FineDiff\Render\Renderer'));
        $this->assertTrue(is_a($this->diff->getRenderer(), 'cogpowered\FineDiff\Render\RendererInterface'));
    }

    public function testGetParser()
    {
        $this->assertTrue(is_a($this->diff->getParser(), 'cogpowered\FineDiff\Parser\Parser'));
        $this->assertTrue(is_a($this->diff->getParser(), 'cogpowered\FineDiff\Parser\ParserInterface'));
    }
}