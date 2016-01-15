<?php

namespace TM\ErrorLogParser\Exception;

/**
 * Class UnknownTypeException
 *
 * @package TM\ErrorLogParser\Exception
 */
class UnknownTypeException extends \Exception
{
    protected $message = 'Unknown type for error-log format given!';
}
