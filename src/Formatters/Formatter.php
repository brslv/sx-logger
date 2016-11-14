<?php

namespace Sx\Logger\Formatters;

use Sx\Logger\LogLevel;
use Sx\Logger\Services\Moment;
use Sx\Logger\Contracts\FormatterInterface;

/**
 * Class Formatter.
 *
 * @package Sx\Logger\Formatters
 */
abstract class Formatter implements FormatterInterface
{
    /** @var string */
    protected $logLevel;

    /**
     * Set the log level for the log.
     *
     * @param string $logLevel
     * @return Sx\Logger\Formatters\Formatter
     */
    public function setLogLevel($logLevel)
    {
        if (LogLevel::invalid(strtoupper($logLevel))) {
            throw new \InvalidArgumentException("Invalid log level: {$logLevel}");
        }

        $this->logLevel = $logLevel;

        return $this;
    }

    /** 
     * Get the log level and the date as a formatted string.
     *
     * @return string The log level and date for the log as a formatted string in the form: "[level] [date] : ".
     */
    public function logLevelAndDate()
    {
        return '[' . $this->logLevel . '] ' . Moment::pretty();
    }

    /**
     * Should format the string
     *
     * @param string $content The content for the log.
     * @param array $context The context data.
     * @return string
     */
    public abstract function format($content, $context);
}
