<?php

namespace cogpowered\FineDiff\Tests\Diff;

use cogpowered\FineDiff\Diff;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Granularity\Granularity;
use cogpowered\FineDiff\Granularity\GranularityInterface;
use cogpowered\FineDiff\Parser\Parser;
use cogpowered\FineDiff\Parser\ParserInterface;
use cogpowered\FineDiff\Render\Html;
use cogpowered\FineDiff\Render\Renderer;
use cogpowered\FineDiff\Render\RendererInterface;
use PHPUnit\Framework\TestCase;

class DefaultsTest extends TestCase
{
    public function setUp(): void
    {
        $this->diff = new Diff;
    }

    public function testGetGranularity()
    {
        $this->assertTrue(is_a($this->diff->getGranularity(), Character::class));
        $this->assertTrue(is_a($this->diff->getGranularity(), Granularity::class));
        $this->assertTrue(is_a($this->diff->getGranularity(), GranularityInterface::class));
    }

    public function testGetRenderer()
    {
        $this->assertTrue(is_a($this->diff->getRenderer(), Html::class));
        $this->assertTrue(is_a($this->diff->getRenderer(), Renderer::class));
        $this->assertTrue(is_a($this->diff->getRenderer(), RendererInterface::class));
    }

    public function testGetParser()
    {
        $this->assertTrue(is_a($this->diff->getParser(), Parser::class));
        $this->assertTrue(is_a($this->diff->getParser(), ParserInterface::class));
    }
}