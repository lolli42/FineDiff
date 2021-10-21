<?php

namespace cogpowered\FineDiff\Tests\Delimiters;

use cogpowered\FineDiff\Delimiters;
use PHPUnit\Framework\TestCase;

class ConstantsTest extends TestCase
{
    public function testParagraphConstant()
    {
        self::assertEquals(Delimiters::PARAGRAPH, "\n\r");
    }

    public function testSentenceConstant()
    {
        self::assertEquals(Delimiters::SENTENCE, ".\n\r");
    }

    public function testWordConstant()
    {
        self::assertEquals(Delimiters::WORD, " \t.\n\r");
    }

    public function testCharacterConstant()
    {
        self::assertEquals(Delimiters::CHARACTER, '');
    }
}
