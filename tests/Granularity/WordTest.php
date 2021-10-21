<?php

namespace cogpowered\FineDiff\Tests\Granularity;

use cogpowered\FineDiff\Delimiters;
use cogpowered\FineDiff\Granularity\Granularity;
use cogpowered\FineDiff\Granularity\GranularityInterface;
use cogpowered\FineDiff\Granularity\Word;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    /**
     * @var Word
     */
    private $character;

    private $delimiters = [
        Delimiters::PARAGRAPH,
        Delimiters::SENTENCE,
        Delimiters::WORD,
    ];

    public function setUp(): void
    {
        $this->character = new Word();
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
