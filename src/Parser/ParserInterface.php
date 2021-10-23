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

use cogpowered\FineDiff\Exceptions\GranularityCountException;
use cogpowered\FineDiff\Granularity\GranularityInterface;

interface ParserInterface
{
    /**
     * Creates an instance.
     */
    public function __construct(GranularityInterface $granularity);

    /**
     * Granularity the parser is working with.
     *
     * Default is \cogpowered\FineDiff\Granularity\Character.
     *
     * @return GranularityInterface
     */
    public function getGranularity();

    /**
     * Set the granularity that the parser is working with.
     */
    public function setGranularity(GranularityInterface $granularity);

    /**
     * Get the opcodes object that is used to store all the opcodes.
     *
     * @return OpcodesInterface
     */
    public function getOpcodes();

    /**
     * Set the opcodes object used to store all the opcodes for this parse.
     */
    public function setOpcodes(OpcodesInterface $opcodes);

    /**
     * Generates the opcodes needed to transform one string to another.
     *
     * @param string $from_text
     * @param string $to_text
     * @throws GranularityCountException
     * @return OpcodesInterface
     */
    public function parse($from_text, $to_text);
}
