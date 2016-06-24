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
     * @param string     $message
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($message = null, $code = null, \Exception $previous = null)
    {
        $message = '
            The parser only supports the default Log-Format!' . PHP_EOL . '
            If you think this is an error please refer to' . PHP_EOL . '
            https://github.com/tommy-muehle/error-log-parser/issues' . PHP_EOL . '
            and create an issue!
        ';

        parent::__construct($message, $code, $previous);
    }


}
