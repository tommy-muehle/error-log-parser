<?php

namespace TM\ErrorLogParser\Parser;

use TM\ErrorLogParser\Exception\FormatException;

/**
 * Class AbstractParser
 *
 * @package TM\ErrorLogParser\Parser
 */
abstract class AbstractParser implements ParserInterface
{
    /**
     * @param string $line
     *
     * @return \stdClass
     * @throws FormatException
     */
    public function parse($line)
    {
        $object = new \stdClass();
        $matches = [];

        foreach ($this->getPatterns() as $key => $pattern) {
            $result = preg_match($pattern, $line, $matches);

            if (1 !== $result) {
                throw new FormatException(sprintf('Could not parse error-line with "%s"!', get_class($this)));
            }

            $object->$key = $matches[1];
        }

        return $object;
    }
}
