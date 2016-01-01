<?php

namespace TM\ErrorLogParser;

use TM\ErrorLogParser\Exception\FormatException;

/**
 * Class AbstractParser
 *
 * @package TM\ErrorLogParser
 */
abstract class AbstractParser
{
    /**
     * @return string
     */
    abstract public function getType();

    /**
     * @return array
     */
    abstract public function getPatterns();

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
                throw new FormatException(sprintf('Could not parse error-line for type "%s"!', $this->getType()));
            }

            $object->$key = $matches[1];
        }

        return $object;
    }
}
