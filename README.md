# error-log-parser

[![Build Status](https://travis-ci.org/tommy-muehle/error-log-parser.svg?branch=master)](https://travis-ci.org/tommy-muehle/error-log-parser)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.5-8892BF.svg?style=flat-square)](https://php.net/)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](https://raw.githubusercontent.com/tommy-muehle/error-log-parser/master/LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/tommy-muehle/error-log-parser.svg)](https://github.com/tommy-muehle/error-log-parser/issues)

Simple PHP library to parse Apache or Nginx error-log file entries for further usage. 

## Install

Using [Composer](https://getcomposer.org/)

    $ composer require tm/error-log-parser
    
or manually add this to composer.json

    {
        "require": {
            "tm/error-log-parser": "~1.1"
        }
    }

## Usage

Instantiate the class:

    use TM\ErrorLogParser\Parser; 
    $parser = new Parser(Parser::TYPE_APACHE) // or TYPE_NGINX;
    
And then parse the lines:

    function getLines($file)
     {
        $f = fopen($file, 'r');
        if (!$f) throw new Exception();
        while ($line = fgets($f)) {
            yield $line;
        }
        fclose($f);
    }
    
    foreach (getLines('/var/log/apache2/error.log') as $line) {
        $entry = $parser->parse($line);
    }
    
Where ```$entry``` hold all parsed data.
For Apache:

    stdClass Object (
        [date] => "Tue Dec 29 08:14:45 2015"
        [type] => "warn"
        [client] => "193.158.15.243"
        [message] => "mod_fcgid: stderr: PHP Warning:  Division by zero in /var/www/kd/app.de/src/Calc.php on line 346, referer: https://www.app.de"
    )

And for Nginx:

    stdClass Object (
        [date] => "2011/06/10 13:30:10"
        [type] => "error"
        [message] => "*1 directory index of "/var/www/ssl/" is forbidden"
        [client] => "86.186.86.232"
        [server] => "hotelpublisher.com"
        [request] => "GET / HTTP/1.1"
        [host] => "hotelpublisher.com"
    )

Otherwise you can use the FormlessParser for formless log files:

    stdClass Object (
        [type] => "info"
        [message] => "23263#0: *1 directory index of "/var/www/ssl/" is forbidden, client: 86.186.86.232, server: hotelpublisher.com, request: "GET / HTTP/1.1", host: "hotelpublisher.com""
    )
## Contributing

Please refer to [CONTRIBUTING.md](CONTRIBUTING.md) for information on how to contribute.
