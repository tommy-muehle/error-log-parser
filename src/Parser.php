<?php

namespace TM\ErrorLogParser;

use TM\ErrorLogParser\Exception\UnknownTypeException;
use TM\ErrorLogParser\Exception\FormatException;
use TM\ErrorLogParser\Parser\AbstractParser;
use TM\ErrorLogParser\Parser\ApacheParser;
use TM\ErrorLogParser\Parser\FormlessParser;
use TM\ErrorLogParser\Parser\NginxParser;

/**
 * Class Parser
 *
 * @package TM\ErrorLogParser
 */
class Parser
{
    const TYPE_APACHE = 'apache';
    const TYPE_NGINX  = 'nginx';
    const TYPE_FORMLESS  = 'formless';

    /**
     * @var AbstractParser
     */
    private $parser;

    /**
     * Parser constructor.
     *
     * @param string $type
     * @throws UnknownTypeException
     */
    public function __construct($type)
    {
        if (self::TYPE_APACHE === $type) {
            $this->parser = new ApacheParser;
        }

        if (self::TYPE_NGINX === $type) {
            $this->parser = new NginxParser;
        }

        if (self::TYPE_FORMLESS === $type) {
            $this->parser = new FormlessParser();
        }

        if (!$this->parser instanceof AbstractParser) {
            throw new UnknownTypeException;
        }
    }

    /**
     * @param string $line
     *
     * @return \stdClass
     * @throws FormatException
     */
    public function parse($line)
    {
        return $this->parser->parse($line);
    }
}
