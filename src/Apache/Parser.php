<?php

namespace TM\ErrorLogParser\Apache;

use TM\ErrorLogParser\AbstractParser;

/**
 * Class Parser
 *
 * @package TM\ErrorLogParser\Apache
 */
class Parser extends AbstractParser
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'apache';
    }

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
