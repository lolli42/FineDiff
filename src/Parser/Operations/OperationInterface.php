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

interface OperationInterface
{
    /**
     * @return int
     */
    public function getFromLen();

    /**
     * @return int
     */
    public function getToLen();

    /**
     * @return string Opcode for this operation.
     */
    public function getOpcode();
}
