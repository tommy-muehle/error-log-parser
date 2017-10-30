<?php

namespace TM\ErrorLogParser\Parser;

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
            'type' => '/\[(warn|error|debug|info|crit|emerg|notice|alert)\]/',
            'client' => '~\] \[client ([0-9\.]*)\]~',
            'message' => '/\]+\s+(?!\[)(.*)/',
        ];
    }
}
