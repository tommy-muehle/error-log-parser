<?php

namespace TM\ErrorLogParser\Tests;

use TM\ErrorLogParser\Parser;
use TM\ErrorLogParser\Exception\FormatException;

/**
 * Class ParserTest
 *
 * @package TM\ErrorLogParser\Tests\Apache
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * @covers TM\ErrorLogParser\Parser
     */
    public function testCanParseACorrectApacheErrorLogLine()
    {
        $parser = new Parser(Parser::TYPE_APACHE);
        $lines = file(__DIR__ . '/Fixtures/apache_error.log');

        $object = $parser->parse(current($lines));

        $this->assertEquals('warn', $object->type);
        $this->assertEquals('193.158.15.243', $object->client);
    }

    /**
     * @covers TM\ErrorLogParser\Parser
     */
    public function testCanParseACorrectNginxErrorLogLine()
    {
        $parser = new Parser(Parser::TYPE_NGINX);
        $lines = file(__DIR__ . '/Fixtures/nginx_error.log');

        $object = $parser->parse(current($lines));

        $this->assertEquals('error', $object->type);
        $this->assertEquals('86.186.86.232', $object->client);
        $this->assertEquals('hotelpublisher.com', $object->server);
    }

    /**
     * @covers TM\ErrorLogParser\Parser
     */
    public function testNotCorrectLineThrowsException()
    {
        $this->setExpectedException(FormatException::class, 'Could not parse error-line with "TM\ErrorLogParser\Parser\ApacheParser"!');

        $lines = file(__DIR__ . '/Fixtures/invalid.log');
        $parser = new Parser(Parser::TYPE_APACHE);

        $parser->parse(current($lines));
    }
}
