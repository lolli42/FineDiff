<?php

namespace cogpowered\FineDiff\Tests\Diff;

use cogpowered\FineDiff\Diff;
use cogpowered\FineDiff\Granularity\Word;
use cogpowered\FineDiff\Parser\Parser;
use cogpowered\FineDiff\Render\Html;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    public function testSetAndGetParser()
    {
        $parser = new Parser(new Word());
        $subject = new Diff();
        $subject->setParser($parser);
        self::assertEquals($parser, $subject->getParser());
    }

    public function testSetAndGetRenderer()
    {
        $renderer = new Html();
        $subject = new Diff();
        $subject->setRenderer($renderer);
        self::assertEquals($renderer, $subject->getRenderer());
    }

    /**
     * @todo: Consider dropping diff->get/setGranularity() over diff->getParser()->getGranularity()
     */
    public function testSetAndGetGranularity()
    {
        $parser = new Parser(new Word());
        $subject = new Diff();
        $subject->setParser($parser);
        $granularity = new Word();
        $subject->setGranularity($granularity);
        self::assertSame($granularity, $subject->getGranularity());
        self::assertSame($granularity, $subject->getParser()->getGranularity());
    }
}
