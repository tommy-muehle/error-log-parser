<?php

namespace TM\ErrorLogParser\Parser;

use TM\ErrorLogParser\Parser\AbstractParser;

/**
 * Class Parser
 *
 * @package TM\ErrorLogParser
 */
class FormlessParser extends AbstractParser
{
    /**
     * @param string $line
     *
     * @return \stdClass
     */
    public function parse($line)
    {
        $object = new \stdClass();

        $object->type = 'info';
        $object->message = $line;

        return $object;
    }

    /**
     * @return array
     */
    public function getPatterns()
    {
        return [];
    }
}
