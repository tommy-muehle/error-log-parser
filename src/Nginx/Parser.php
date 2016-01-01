<?php

namespace TM\ErrorLogParser\Nginx;

use TM\ErrorLogParser\AbstractParser;

/**
 * Class Parser
 *
 * @package TM\ErrorLogParser\Nginx
 */
class Parser extends AbstractParser
{
    /**
     * @return string
     */
    public function getType()
    {
        return 'nginx';
    }

    /**
     * @return array
     */
    public function getPatterns()
    {
        return [
            'date' => '((\d{4}\/\d{2}\/\d{2}\s\d{2}:\d{2}:\d{2})\s)',
            'type' => '(\s\[([^]]*)\])',
            'message' => '(\[*:\s(.*)\s?,\sclient)',
            'client' => '(\sclient:\s([^,]*),)',
            'server' => '(\sserver:\s([^,]*),)',
            'request' => '(\srequest:\s"([^"]*)",)',
            'host' => '(\shost:\s"([^"]*)")',
        ];
    }
}
