<?php

namespace TM\ErrorLogParser\Parser;

/**
 * Class NginxParser
 *
 * @package TM\ErrorLogParser\Parser
 */
class NginxParser extends AbstractParser
{
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
