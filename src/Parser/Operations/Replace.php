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

class Replace implements OperationInterface
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var int
     */
    protected $fromLen;

    /**
     * @param int $fromLen
     * @param string $text
     */
    public function __construct($fromLen, $text)
    {
        $this->fromLen = $fromLen;
        $this->text    = $text;
    }

    /**
     * @inheritdoc
     */
    public function getFromLen()
    {
        return $this->fromLen;
    }

    /**
     * @inheritdoc
     */
    public function getToLen()
    {
        return mb_strlen($this->text);
    }

    /**
     * Get the text the operation is working with.
     *
     * @return string
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
        if ($this->fromLen === 1) {
            $del_opcode = 'd';
        } else {
            $del_opcode = "d{$this->fromLen}";
        }

        $to_len = mb_strlen($this->text);

        if ($to_len === 1) {
            return "{$del_opcode}i:{$this->text}";
        }

        return "{$del_opcode}i{$to_len}:{$this->text}";
    }
}
