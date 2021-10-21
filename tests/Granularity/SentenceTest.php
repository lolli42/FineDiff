<?php

namespace FineDiffTests\Granularity;

use cogpowered\FineDiff\Delimiters;
use cogpowered\FineDiff\Granularity\Sentence;
use PHPUnit\Framework\TestCase;

class SentenceTest extends TestCase
{
    protected $delimiters = array(
        Delimiters::PARAGRAPH,
        Delimiters::SENTENCE,
    );

    public function setUp(): void
    {
        $this->character = new Sentence;
    }

    public function testExtendsAndImplements()
    {
        $this->assertTrue(is_a($this->character, 'cogpowered\FineDiff\Granularity\Granularity'));
        $this->assertTrue(is_a($this->character, 'cogpowered\FineDiff\Granularity\GranularityInterface'));
        $this->assertTrue(is_a($this->character, 'ArrayAccess'));
        $this->assertTrue(is_a($this->character, 'Countable'));
    }

    public function testGetDelimiters()
    {
        $this->assertEquals($this->character->getDelimiters(), $this->delimiters);
    }
}