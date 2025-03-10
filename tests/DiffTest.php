<?php

declare(strict_types=1);

/*
 * FINE granularity DIFF
 *
 * (c) 2011 Raymond Hill (http://raymondhill.net/blog/?p=441)
 * (c) 2013 Robert Crowe (http://cogpowered.com)
 * (c) 2021 Christian Kuhn
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace cogpowered\FineDiff\Tests;

use cogpowered\FineDiff\Diff;
use cogpowered\FineDiff\Granularity\Character;
use cogpowered\FineDiff\Granularity\GranularityInterface;
use cogpowered\FineDiff\Granularity\Paragraph;
use cogpowered\FineDiff\Granularity\Sentence;
use cogpowered\FineDiff\Granularity\Word;
use cogpowered\FineDiff\Parser\Parser;
use cogpowered\FineDiff\Render\Html;
use cogpowered\FineDiff\Render\Text;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class DiffTest extends TestCase
{
    #[Test]
    public function getDefaultInstances(): void
    {
        $diff = new Diff();
        self::assertInstanceOf(Character::class, $diff->getGranularity());
        self::assertInstanceOf(Html::class, $diff->getRenderer());
        self::assertInstanceOf(Parser::class, $diff->getParser());
    }

    #[Test]
    public function instancesFromConstruct(): void
    {
        $character = new Character();
        self::assertSame($character, (new Diff($character))->getGranularity());
        $html = new Html();
        self::assertSame($html, (new Diff(null, $html))->getRenderer());
        $parser = new Parser(new Word());
        self::assertSame($parser, (new Diff(null, null, $parser))->getParser());
    }

    #[Test]
    public function setAndGetParser(): void
    {
        $parser = new Parser(new Word());
        $subject = new Diff();
        $subject->setParser($parser);
        self::assertEquals($parser, $subject->getParser());
    }

    #[Test]
    public function setAndGetRenderer(): void
    {
        $renderer = new Html();
        $subject = new Diff();
        $subject->setRenderer($renderer);
        self::assertEquals($renderer, $subject->getRenderer());
    }

    #[Test]
    public function setAndGetGranularity(): void
    {
        $parser = new Parser(new Word());
        $subject = new Diff();
        $subject->setParser($parser);
        $granularity = new Word();
        $subject->setGranularity($granularity);
        self::assertSame($granularity, $subject->getGranularity());
        self::assertSame($granularity, $subject->getParser()->getGranularity());
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public static function processAndRenderDataProvider(): array
    {
        return [
            'empty strings' => [
                new Character(),
                '',
                '',
                '',
                '',
            ],
            'single word' => [
                new Character(),
                'hello',
                'hello2',
                'c5i:2',
                'hello<ins>2</ins>'
            ],
            'two words #1' => [
                new Character(),
                'hello world',
                'hello2 worlds',
                'c5i:2c6i:s',
                'hello<ins>2</ins> world<ins>s</ins>',
            ],
            'two words #2' => [
                new Character(),
                'hello worlds',
                'hello2 world',
                'c5i:2c6d',
                'hello<ins>2</ins> world<del>s</del>',
            ],
            'character' => [
                new Character(),
                'This is the 1st sentence. Its then carried on into another.'
                . chr(10) . 'This is another paragraph, just to test things further!',
                'This is the 1st sentence. It then carries on into another.'
                . chr(10) . 'This is another paragraph, just to test things further!',
                'c28dc12di:sc73',
                'This is the 1st sentence. It<del>s</del> then carrie<del>d</del><ins>s</ins> on into another.'
                    . chr(10) . 'This is another paragraph, just to test things further!',
            ],
            'word' => [
                new Word(),
                'This is the 1st sentence. Its then carried on into another.'
                . chr(10) . 'This is another paragraph, just to test things further!',
                'This is the 1st sentence. It then carries on into another.'
                . chr(10) . 'This is another paragraph, just to test things further!',
                'c26d4i3:It c5d8i8:carries c72',
                'This is the 1st sentence. <del>Its </del><ins>It </ins>then <del>carried </del><ins>carries </ins>on into another.'
                    . chr(10) . 'This is another paragraph, just to test things further!',
            ],
            'paragraph' => [
                new Paragraph(),
                'This is the 1st sentence. Its then carried on into another.'
                . chr(10) . 'This is another paragraph, just to test things further!',
                'This is the 1st sentence. It then carries on into another.'
                . chr(10) . 'This is another paragraph, just to test things further!',
                'd60i59:This is the 1st sentence. It then carries on into another.'
                    . chr(10) . 'c55',
                '<del>This is the 1st sentence. Its then carried on into another.'
                    . chr(10) . '</del><ins>This is the 1st sentence. It then carries on into another.'
                    . chr(10) . '</ins>This is another paragraph, just to test things further!',
            ],
            'sentence' => [
                new Sentence(),
                'This is the 1st sentence. Its then carried on into another.'
                . chr(10) . 'This is another paragraph, just to test things further!',
                'This is the 1st sentence. It then carries on into another.'
                . chr(10) . 'This is another paragraph, just to test things further!',
                'c25d35i34: It then carries on into another.'
                    . chr(10) . 'c55',
                'This is the 1st sentence.<del> Its then carried on into another.\n</del><ins> It then carries on into another.'
                    . chr(10) . '</ins>This is another paragraph, just to test things further!',
            ],
            'character level with added line' => [
                new Character(),
                'Hello',
                'Hello' . chr(10) . 'World',
                'c5i6:' . chr(10) . 'World',
                'Hello<ins>' . chr(10) . 'World</ins>',
            ],
            'word level with added line' => [
                new Word(),
                'Hello',
                'Hello' . chr(10) . 'World',
                'd5i11:Hello' . chr(10) . 'World',
                '<del>Hello</del><ins>Hello' . chr(10) . 'World</ins>',
            ],
            'paragraph level with added line' => [
                new Paragraph(),
                'Hello',
                'Hello' . chr(10) . 'World',
                'd5i11:Hello' . chr(10) . 'World',
                '<del>Hello</del><ins>Hello' . chr(10) . 'World</ins>',
            ],
            'sentence level with added line' => [
                new Sentence(),
                'Hello',
                'Hello' . chr(10) . 'World',
                'd5i11:Hello' . chr(10) . 'World',
                '<del>Hello</del><ins>Hello' . chr(10) . 'World</ins>',
            ],
            'multibyte character diff #1' => [
                new Character(),
                'tränenüberströmt',
                '',
                'd16',
                '<del>tr&auml;nen&uuml;berstr&ouml;mt</del>'
            ],
            'multibyte character diff #2' => [
                new Character(),
                '',
                'tränenüberströmt',
                'i16:tränenüberströmt',
                '<ins>tr&auml;nen&uuml;berstr&ouml;mt</ins>'
            ],
            'multibyte character diff #3' => [
                new Character(),
                'tränenüberströmt',
                'tränenuebärströmt',
                'c6di2:uecdi:äc7',
                'tr&auml;nen<del>&uuml;</del><ins>ue</ins>b<del>e</del><ins>&auml;</ins>rstr&ouml;mt'
            ],
            'word diff' => [
                new Word(),
                'Hello world',
                'Hello world2',
                'c6d5i6:world2',
                'Hello <del>world</del><ins>world2</ins>'
            ],
            'multibyte word diff #1' => [
                new Word(),
                'Héllo world',
                'Héllo world2',
                'c6d5i6:world2',
                'H&eacute;llo <del>world</del><ins>world2</ins>'
            ],
            'multibyte word #2' => [
                new Word(),
                'Héllò world',
                'Héllò world2',
                'c6d5i6:world2',
                'H&eacute;ll&ograve; <del>world</del><ins>world2</ins>'
            ],
            'html special chars are converted #1' => [
                new Character(),
                'foo<bär>baz',
                'foo<bär>baz',
                'c11',
                'foo&lt;b&auml;r&gt;baz'
            ],
            'html special chars are converted #2' => [
                new Character(),
                'foo<bär>baz',
                'foo<qüx>baz',
                'c4d3i3:qüxc4',
                'foo&lt;<del>b&auml;r</del><ins>q&uuml;x</ins>&gt;baz'
            ],
            'number string #1' => [
                new Character(),
                '123',
                '143',
                'cdi:4c',
                '1<del>2</del><ins>4</ins>3'
            ],
            'number string #2' => [
                new Character(),
                '112233344',
                '113366644',
                'c2d2c2di3:666c2',
                '11<del>22</del>33<del>3</del><ins>666</ins>44'
            ]
        ];
    }

    #[Test]
    #[DataProvider('processAndRenderDataProvider')]
    public function parseAndRender(
        GranularityInterface $granularity,
        string $from,
        string $to,
        string $expectedOpcode,
        string $expectedHtml
    ): void {
        $diff = new Diff($granularity);
        $generated_opcodes = (string)$diff->getOpcodes($from, $to);
        self::assertEquals($expectedOpcode, $generated_opcodes);
        $render = new Text();
        self::assertEquals($to, $render->process($from, $generated_opcodes));
        self::assertEquals($expectedHtml, $diff->render($from, $to));
        $render = new Html();
        self::assertEquals($expectedHtml, $render->process($from, $generated_opcodes));
        self::assertEquals($expectedHtml, $diff->render($from, $to));
    }
}
