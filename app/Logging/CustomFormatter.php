<?php
namespace App\Logging;

use Monolog\Formatter\LineFormatter;

// used for cutomizing log in specific channels
class CustomFormatter
{
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(
                new LineFormatter('[%datetime%]:[%level_name%] %message%'.PHP_EOL)
            );
        }
        
    }

}