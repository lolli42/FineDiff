<?php

namespace FineDiffTests\Granularity;

use FineDiffTests\BaseTestCase;
use cogpowered\FineDiff\Delimiters;
use cogpowered\FineDiff\Granularity\Word;

class WordTest extends BaseTestCase
{
    protected $delimiters = array(
        Delimiters::PARAGRAPH,
        Delimiters::SENTENCE,
        Delimiters::WORD,
    );

    public function setUp()
    {
        $this->character = new Word;
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