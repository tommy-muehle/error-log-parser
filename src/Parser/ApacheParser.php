<?php

namespace TM\ErrorLogParser\Parser;

use TM\ErrorLogParser\Parser\AbstractParser;

/**
 * Class Parser
 *
 * @package TM\ErrorLogParser\Apache
 */
class ApacheParser extends AbstractParser
{
    /**
     * @return array
     */
    public function getPatterns()
    {
        return [
            'date' => '~^\[(.*?)\]~',
            'type' => '~\] \[([a-z]*?)\] \[~',
            'client' => '~\] \[client ([0-9\.]*)\]~',
            'message' => '~\] (.*)$~',
        ];
    }
}
