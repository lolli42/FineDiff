<?php

namespace cogpowered\FineDiff\Tests\Granularity;

use cogpowered\FineDiff\Delimiters;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Granularity\Granularity;
use cogpowered\FineDiff\Granularity\GranularityInterface;
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    /**
     * @var Character
     */
    private $character;

    private $delimiters = [
        Delimiters::PARAGRAPH,
        Delimiters::SENTENCE,
        Delimiters::WORD,
        Delimiters::CHARACTER,
    ];

    public function setUp(): void
    {
        $this->character = new Character();
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

    public function testSetDelimiters()
    {
        $arr = ['one', 'two'];
        $this->character->setDelimiters($arr);
        self::assertEquals($this->character->getDelimiters(), $arr);
    }

    public function testCountable()
    {
        self::assertEquals(count($this->character), count($this->delimiters));
    }

    public function testArrayAccess()
    {
        // Exists
        for ($i = 0; $i < count($this->delimiters) + 1; $i++) {
            if ($i !== count($this->delimiters)) {
                self::assertTrue(isset($this->character[$i]));
            } else {
                self::assertFalse(isset($this->character[$i]));
            }
        }

        // Get
        for ($i = 0; $i < count($this->delimiters) + 1; $i++) {
            if ($i !== count($this->delimiters)) {
                self::assertEquals($this->character[$i], $this->delimiters[$i]);
            } else {
                self::assertNull($this->character[$i]);
            }
        }

        // Set
        for ($i = 0; $i < count($this->delimiters) + 1; $i++) {
            $rand = rand(0, 1000);

            $this->character[$i] = $rand;
            self::assertEquals($this->character[$i], $rand);
        }

        self::assertEquals(count($this->character), count($this->delimiters) + 1);

        // Unset
        unset($this->character[ count($this->delimiters) ]);
        self::assertEquals(count($this->character), count($this->delimiters));
    }
}
