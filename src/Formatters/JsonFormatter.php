<?php

namespace Sx\Logger\Formatters;

use Sx\Logger\DTO\LogData;
use Sx\Logger\Services\Moment;
use Sx\Logger\Formatters\Formatter;
use Sx\Logger\Services\ContextParser;

/**
 * Class JsonFormatter.
 *
 * @package Sx\Logger\Formatters
 */
class JsonFormatter extends Formatter
{
    /**
     * Formats content as json, ready to be logged.
     *
     * @param string $content The content to be formatted.
     * @param array $context The context data.
     * @return string
     */
    public function format($content, $context)
    {
        $parsed = ContextParser::parse($content, $context);

        return json_encode(new LogData($content, $context, $parsed)) . "\n";
    }
}
