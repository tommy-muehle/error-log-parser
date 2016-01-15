<?php

namespace TM\ErrorLogParser\Parser;

/**
 * ParserInterface
 *
 * @package TM\ErrorLogParser\Parser
 */
interface ParserInterface
{
    /**
     * @return array
     */
    public function getPatterns();
}
