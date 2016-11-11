<?php

namespace Sx\Logger\Formatters;

use Sx\Logger\LogLevel;
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
    /** @var string */
    private $logLevel;

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

        return Moment::pretty() . '[' . $this->logLevel . '] ' .  $formatted . "\n";
    }

    /**
     * Set the log level for the log.
     *
     * @param string $logLevel
     */
    public function setLogLevel($logLevel)
    {
        $this->logLevel = $logLevel;

        return $this;
    }
}
