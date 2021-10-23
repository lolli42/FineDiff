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

namespace cogpowered\FineDiff\Parser\Operations;

/**
 * Generates the opcode for a copy operation.
 */
class Insert implements OperationInterface
{
    /**
     * @var string
     */
    protected $text;

    /**
     * Sets the text that the operation is working with.
     *
     * @param string $text
     */
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * @inheritdoc
     */
    public function getFromLen()
    {
        return 0;
    }

    /**
     * @inheritdoc
     */
    public function getToLen()
    {
        return mb_strlen($this->text);
    }

    /**
     * @inheritdoc
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @inheritdoc
     */
    public function getOpcode()
    {
        $to_len = mb_strlen($this->text);

        if ($to_len === 1) {
            return "i:{$this->text}";
        }

        return "i{$to_len}:{$this->text}";
    }
}
