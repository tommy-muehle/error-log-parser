<?php

namespace TM\ErrorLogParser\Tests;

use TM\ErrorLogParser\Parser;

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
     * @dataProvider getValidApacheLogFiles
     *
     * @param string $logfile
     */
    public function testCanParseACorrectApacheErrorLogLine($logfile)
    {
        $parser = new Parser(Parser::TYPE_APACHE);
        $lines = file($logfile);

        $object = $parser->parse(current($lines));

        $this->assertEquals('warn', $object->type);
        $this->assertNotNull($object->message);
    }

    /**
     * @dataProvider getInvalidApacheLogFiles
     * @expectedException \TM\ErrorLogParser\Exception\FormatException
     * @expectedExceptionMessageRegExp /The parser only supports the default Log-Format/
     *
     * @param $logfile
     */
    public function testSpecialLogFormatThrowsAnException($logfile)
    {
        $parser = new Parser(Parser::TYPE_APACHE);
        $lines = file($logfile);

        $object = $parser->parse(current($lines));
    }

    /**
     * @dataProvider getValidNginxLogFiles
     *
     * @param string $logfile
     */
    public function testCanParseACorrectNginxErrorLogLine($logfile)
    {
        $parser = new Parser(Parser::TYPE_NGINX);
        $lines = file($logfile);

        $object = $parser->parse(current($lines));

        $this->assertEquals('error', $object->type);
        $this->assertEquals('86.186.86.232', $object->client);
        $this->assertEquals('hotelpublisher.com', $object->server);
    }

    /**
     * @return array
     */
    public function getValidNginxLogFiles()
    {
        return [
            [__DIR__ . '/Fixtures/nginx_valid_error.log'],
        ];
    }

    /**
     * @return array
     */
    public function getInvalidApacheLogFiles()
    {
        return [
            [__DIR__ . '/Fixtures/apache_invalid_error.log'],
        ];
    }

    /**
     * @return array
     */
    public function getValidApacheLogFiles()
    {
        return [
            [__DIR__ . '/Fixtures/apache_valid_error.log'],
            [__DIR__ . '/Fixtures/apache_valid_error2.log'],
        ];
    }
}
