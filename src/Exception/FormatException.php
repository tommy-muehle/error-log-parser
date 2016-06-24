<?php

namespace TM\ErrorLogParser\Exception;

/**
 * Class FormatException
 *
 * @package TM\ErrorLogParser\Exception
 */
class FormatException extends \Exception
{
    /**
     * @var string
     */
    public $message =
        'The parser only supports the default Log-Format!' . PHP_EOL .
        'If you think this is an error please refer to' . PHP_EOL .
        'https://github.com/tommy-muehle/error-log-parser/issues' . PHP_EOL .
        'and create an issue!';
}
