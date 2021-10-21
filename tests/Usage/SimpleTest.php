<?php

namespace cogpowered\FineDiff\Tests\Usage;

use cogpowered\FineDiff\Diff;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Granularity\Paragraph;
use cogpowered\FineDiff\Granularity\Sentence;
use cogpowered\FineDiff\Granularity\Word;
use cogpowered\FineDiff\Render\Html;
use cogpowered\FineDiff\Render\Text;
use PHPUnit\Framework\TestCase;

class SimpleTest extends TestCase
{
    /**
     * Helper method to retrieve fixture file content.
     */
    protected function getFile($file)
    {
        $txt = file_get_contents(__DIR__ . '/Resources/' . $file . '.txt');
        $txt = explode('==========', $txt);

        $from    = trim($txt[0]);
        $to      = trim($txt[1]);
        $opcodes = trim($txt[2]);
        $html    = trim($txt[3]);

        return [$from, $to, $opcodes, $html];
    }

    public function testInsertCharacterGranularity()
    {
        list($from, $to, $opcodes, $html) = $this->getFile('character/simple');

        $diff = new Diff(new Character());
        $generated_opcodes = $diff->getOpcodes($from, $to);

        // Generate opcodes
        self::assertEquals($generated_opcodes, $opcodes);

        // Render to text from opcodes
        $render = new Text();
        self::assertEquals($render->process($from, $generated_opcodes), $to);

        // Render to html from opcodes
        $render = new Html();
        self::assertEquals($render->process($from, $generated_opcodes), $html);

        // Render
        self::assertEquals($diff->render($from, $to), $html);
    }

    public function testInsertWordGranularity()
    {
        list($from, $to, $opcodes, $html) = $this->getFile('word/simple');

        $diff = new Diff(new Word());
        $generated_opcodes = $diff->getOpcodes($from, $to);

        // Generate opcodes
        self::assertEquals($generated_opcodes, $opcodes);

        // Render to text from opcodes
        $render = new Text();
        self::assertEquals($render->process($from, $generated_opcodes), $to);

        // Render to html from opcodes
        $render = new Html();
        self::assertEquals($render->process($from, $generated_opcodes), $html);

        // Render
        self::assertEquals($diff->render($from, $to), $html);
    }

    public function testInsertSentenceGranularity()
    {
        list($from, $to, $opcodes, $html) = $this->getFile('sentence/simple');

        $diff = new Diff(new Sentence());
        $generated_opcodes = $diff->getOpcodes($from, $to);

        // Generate opcodes
        self::assertEquals($generated_opcodes, $opcodes);

        // Render to text from opcodes
        $render = new Text();
        self::assertEquals($render->process($from, $generated_opcodes), $to);

        // Render to html from opcodes
        $render = new Html();
        self::assertEquals($render->process($from, $generated_opcodes), $html);

        // Render
        self::assertEquals($diff->render($from, $to), $html);
    }

    public function testInsertParagraphGranularity()
    {
        list($from, $to, $opcodes, $html) = $this->getFile('paragraph/simple');

        $diff = new Diff(new Paragraph());
        $generated_opcodes = $diff->getOpcodes($from, $to);

        // Generate opcodes
        self::assertEquals($generated_opcodes, $opcodes);

        // Render to text from opcodes
        $render = new Text();
        self::assertEquals($render->process($from, $generated_opcodes), $to);

        // Render to html from opcodes
        $render = new Html();
        self::assertEquals($render->process($from, $generated_opcodes), $html);

        // Render
        self::assertEquals($diff->render($from, $to), $html);
    }
}
