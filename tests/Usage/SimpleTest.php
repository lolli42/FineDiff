<?php

namespace cogpowered\FineDiff\Tests\Usage;

use cogpowered\FineDiff\Diff;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Granularity\GranularityInterface;
use cogpowered\FineDiff\Granularity\Paragraph;
use cogpowered\FineDiff\Granularity\Sentence;
use cogpowered\FineDiff\Granularity\Word;
use cogpowered\FineDiff\Render\Html;
use cogpowered\FineDiff\Render\Text;
use PHPUnit\Framework\TestCase;

class SimpleTest extends TestCase
{
    public function processAndRenderDataProvider()
    {
        return [
            'character' => [
                new Character(),
                'c28dc12di:sc73',
                'This is the 1st sentence. It<del>s</del> then carrie<del>d</del><ins>s</ins> on into another.'
                    . chr(10) . 'This is another paragraph, just to test things further!'
            ],
            'word' => [
                new Word(),
                'c26d4i3:It c5d8i8:carries c72',
                'This is the 1st sentence. <del>Its </del><ins>It </ins>then <del>carried </del><ins>carries </ins>on into another.'
                    . chr(10) . 'This is another paragraph, just to test things further!'
            ],
            'paragraph' => [
                new Paragraph(),
                'd60i59:This is the 1st sentence. It then carries on into another.'
                    . chr(10) . 'c55',
                '<del>This is the 1st sentence. Its then carried on into another.'
                    . chr(10) . '</del><ins>This is the 1st sentence. It then carries on into another.'
                    . chr(10) . '</ins>This is another paragraph, just to test things further!'
            ],
            'sentence' => [
                new Sentence(),
                'c25d35i34: It then carries on into another.'
                    . chr(10) . 'c55',
                'This is the 1st sentence.<del> Its then carried on into another.\n</del><ins> It then carries on into another.'
                    . chr(10) . '</ins>This is another paragraph, just to test things further!'
            ],
        ];
    }

    /**
     * @dataProvider processAndRenderDataProvider
     * @test
     */
    public function parseAndRender(GranularityInterface $granularity, string $expectedOpcode, string $expectedHtml)
    {
        $from = 'This is the 1st sentence. Its then carried on into another.'
            . chr(10) . 'This is another paragraph, just to test things further!';
        $to = 'This is the 1st sentence. It then carries on into another.'
            . chr(10) . 'This is another paragraph, just to test things further!';

        $diff = new Diff($granularity);
        $generated_opcodes = (string)$diff->getOpcodes($from, $to);
        self::assertEquals($generated_opcodes, $expectedOpcode);
        $render = new Text();
        self::assertEquals((string)$render->process($from, $generated_opcodes), $to);
        self::assertEquals($diff->render($from, $to), $expectedHtml);
        $render = new Html();
        self::assertEquals($render->process($from, $generated_opcodes), $expectedHtml);
        self::assertEquals($diff->render($from, $to), $expectedHtml);
    }
}
