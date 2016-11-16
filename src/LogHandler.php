<?php

namespace Sx\Logger;

use Sx\Logger\Contracts\WriterInterface;
use Sx\Logger\Contracts\FormatterInterface;

/**
 * Class LogHandler
 *
 * @package Sx\Logger
 */
class LogHandler implements WriterInterface, FormatterInterface
{
    /** @var string */
    private $minimumLogLevel;

    /** @var Sx\Logger\Contracts\WriterInterface */
    private $writer;

    /** @var Sx\Logger\Contracts\FormatterInterface */
    private $formatter;

    /**
     * Constructor.
     *
     * @param Sx\Logger\Contracts\WriterInterface
     * @param Sx\Logger\Contracts\FormatterInterface
     */
    public function __construct($writer, $formatter)
    {
        $this->writer = $writer;
        $this->formatter = $formatter;
    }

    /**
     * Should write to a source destination (file, db, etc...).
     *
     * @param string $content The content to be written.
     * @return bool
     */
    public function write($content)
    {
        return $this->writer->write($content);
    }

    /**
     * Should format the content in a specific way.
     *
     * @param string $content The string to be formatted.
     * @param array $context The context data.
     * @return string The formatted string.
     */
    public function format($content, $context)
    {
        return $this->formatter->format($content, $context);
    }

    /**
     * Should set the log level for the log.
     *
     * @param string $logLevel
     */
    public function setLogLevel($logLevel)
    {
        return $this->formatter->setLogLevel($logLevel);
    }

    /**
     * Set the minimum log level for this handler.
     *
     * @param string $logLevel
     * @return Sx\Logger\LogLevel
     */
    public function setMinimumLogLevel($logLevel)
    {
        if ( ! defined('LogLevel::' . strtoupper($logLevel))) {
            throw new InvalidArgumentException("Invalid log level: [{$logLevel}].");
        }

        $this->minimumLogLevel($logLevel);

        return $this;
    }

    /**
     * Get the minimum log level for this handler.
     * 
     * @return string
     */
    public function getMinimumLogLevel()
    {
        return $this->minimumLogLevel;
    }
}
