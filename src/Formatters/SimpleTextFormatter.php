<?php

namespace Sx\Logger\Formatters;

use Sx\Logger\LogLevel;
use Sx\Logger\Services\Moment;
use Sx\Logger\Formatters\Formatter;
use Sx\Logger\Services\ContextParser;

/**
 * Class SimpleTextFormatter.
 *
 * @package Sx\Logger\Formatters
 */
class SimpleTextFormatter extends Formatter
{
    /**
     * Formats content as a simple text, ready to be logged.
     *
     * @param string $content The content to be formatted.
     * @param array $context The context data.
     * @return string
     */
    public function format($content, $context)
    {
        $parsed = ContextParser::parse($content, $context);

        return $this->logLevelAndDate() . $parsed . "\n";
    }
}
