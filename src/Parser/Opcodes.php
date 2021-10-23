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

namespace cogpowered\FineDiff\Parser;

use cogpowered\FineDiff\Exceptions\OperationException;
use cogpowered\FineDiff\Parser\Operations\OperationInterface;

/**
 * Holds all the opcodes returned by the parser.
 */
class Opcodes implements OpcodesInterface
{
    /**
     * @var array Individual opcodes.
     */
    protected $opcodes = [];

    /**
     * @inheritdoc
     */
    public function getOpcodes()
    {
        return $this->opcodes;
    }

    /**
     * @inheritdoc
     */
    public function setOpcodes(array $opcodes)
    {
        $this->opcodes = [];

        // Ensure that all elements of the array
        // are of the correct type
        foreach ($opcodes as $opcode) {
            if (!is_a($opcode, OperationInterface::class)) {
                throw new OperationException('Invalid opcode object');
            }

            $this->opcodes[] = $opcode->getOpcode();
        }
    }

    /**
     * @inheritdoc
     */
    public function generate()
    {
        return implode('', $this->opcodes);
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->generate();
    }
}
