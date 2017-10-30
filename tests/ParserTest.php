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
     * @dataProvider getValidFormlessLogFiles
     *
     * @param string $logfile
     */
    public function testCanParseAFormlessErrorLogLine($logfile)
    {
        $parser = new Parser(Parser::TYPE_FORMLESS);
        $lines = file($logfile);

        $object = $parser->parse(current($lines));

        $this->assertEquals('info', $object->type);
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

        $parser->parse(current($lines));
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
     * @return void
     */
    public function testCanGetPattern()
    {
        $this->assertTrue(is_array((new Parser\ApacheParser())->getPatterns()));
        $this->assertTrue(is_array((new Parser\NginxParser())->getPatterns()));
        $this->assertTrue(is_array((new Parser\FormlessParser())->getPatterns()));
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
    public function getValidFormlessLogFiles()
    {
        return [
            [__DIR__ . '/Fixtures/formless_error.log'],
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
