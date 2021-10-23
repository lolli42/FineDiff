<?php

declare(strict_types=1);

/**
 * FINE granularity DIFF
 *
 * Computes a set of instructions to convert the content of
 * one string into another.
 *
 * Originally created by Raymond Hill (https://github.com/gorhill/PHP-FineDiff), brought up
 * to date by Cog Powered (https://github.com/cogpowered/FineDiff).
 *
 * @copyright Copyright 2011 (c) Raymond Hill (http://raymondhill.net/blog/?p=441)
 * @copyright Copyright 2013 (c) Robert Crowe (http://cogpowered.com)
 * @link https://github.com/cogpowered/FineDiff
 * @version 0.0.1
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
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
