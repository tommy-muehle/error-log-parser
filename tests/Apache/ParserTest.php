<?php

namespace TM\ErrorLogParser\Tests\Apache;

use TM\ErrorLogParser\Apache\Parser;
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
        $this->lines = file(__DIR__ . '/../Fixtures/apache_error.log');
    }

    /**
     * @covers TM\ErrorLogParser\Apache\Parser
     */
    public function testCanParseACorrectLine()
    {
        $object = $this->parser->parse(current($this->lines));

        $this->assertEquals('warn', $object->type);
        $this->assertEquals('193.158.15.243', $object->client);
    }

    /**
     * @covers TM\ErrorLogParser\Apache\Parser
     */
    public function testNotCorrectLineThrowsException()
    {
        $this->setExpectedException(FormatException::class, 'Could not parse error-line for type "apache"!');

        $this->lines = file(__DIR__ . '/../Fixtures/invalid.log');
        $this->parser->parse(current($this->lines));
    }
}
