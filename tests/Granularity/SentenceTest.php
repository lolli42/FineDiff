<?php

namespace cogpowered\FineDiff\Tests\Granularity;

use cogpowered\FineDiff\Delimiters;
use cogpowered\FineDiff\Granularity\Granularity;
use cogpowered\FineDiff\Granularity\GranularityInterface;
use cogpowered\FineDiff\Granularity\Sentence;
use PHPUnit\Framework\TestCase;

class SentenceTest extends TestCase
{
    /**
     * @var Sentence
     */
    private $character;

    private $delimiters = array(
        Delimiters::PARAGRAPH,
        Delimiters::SENTENCE,
    );

    public function setUp(): void
    {
        $this->character = new Sentence();
    }

    public function testExtendsAndImplements()
    {
        self::assertTrue(is_a($this->character, Granularity::class));
        self::assertTrue(is_a($this->character, GranularityInterface::class));
        self::assertTrue(is_a($this->character, \ArrayAccess::class));
        self::assertTrue(is_a($this->character, \Countable::class));
    }

    public function testGetDelimiters()
    {
        self::assertEquals($this->character->getDelimiters(), $this->delimiters);
    }
}