<?php

namespace Sx\Logger\Formatters;

use Sx\Logger\Services\Moment;
use Sx\Logger\Services\ContextParser;
use Sx\Logger\Contracts\FormatterInterface;

/**
 * Class SimpleTextFormatter.
 *
 * @package Sx\Logger\Formatters
 */
class SimpleTextFormatter implements FormatterInterface
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
        $formatted = ContextParser::parse($content, $context);

        return Moment::pretty() . $formatted . "\n";
    }
}
