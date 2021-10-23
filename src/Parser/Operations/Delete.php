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
 * Generates the opcode for a delete operation.
 */
class Delete implements OperationInterface
{
    /**
     * @var int
     */
    protected $fromLen;

    /**
     * Set the initial length.
     *
     * @param int $len Length of string.
     */
    public function __construct($len)
    {
        $this->fromLen = $len;
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
        return 0;
    }

    /**
     * @inheritdoc
     */
    public function getOpcode()
    {
        if ($this->fromLen === 1) {
            return 'd';
        }

        return "d{$this->fromLen}";
    }
}
