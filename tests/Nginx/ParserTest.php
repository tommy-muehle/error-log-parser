<?php

namespace TM\ErrorLogParser\Tests\Nginx;

use TM\ErrorLogParser\Exception\FormatException;
use TM\ErrorLogParser\Nginx\Parser;

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
     * @var array
     */
    private $lines = [];

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->parser = new Parser();
        $this->lines = file(__DIR__ . '/../Fixtures/nginx_error.log');
    }

    /**
     * @covers TM\ErrorLogParser\Nginx\Parser
     */
    public function testCanParseACorrectLine()
    {
        $object = $this->parser->parse(current($this->lines));

        $this->assertEquals('error', $object->type);
        $this->assertEquals('86.186.86.232', $object->client);
    }

    /**
     * @covers TM\ErrorLogParser\Nginx\Parser
     */
    public function testNotCorrectLineThrowsException()
    {
        $this->setExpectedException(FormatException::class, 'Could not parse error-line for type "nginx"!');

        $this->lines = file(__DIR__ . '/../Fixtures/invalid.log');
        $this->parser->parse(current($this->lines));
    }
}
