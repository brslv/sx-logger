<?php

namespace Sx\Logger;

use Sx\Logger\LogLevel;
use \InvalidArgumentException;
use Sx\Logger\Contracts\LoggerInterface;
use Sx\Logger\Contracts\WriterInterface;
use Sx\Logger\Contracts\FormatterInterface;

/**
 * Class Logger.
 *
 * @package Sx\Logger
 */
class Logger implements LoggerInterface
{
    /** @var Sx\Logger\Contracts\WriterInterface */
    private $writer;

    /** @var Sx\Logger\Contracts\FormatterInterface */
    private $formatter;

    /**
     * Constructor.
     *
     * @param Sx\Logger\Contracts\WriterInterface $writer
     */
    public function __construct(WriterInterface $writer, FormatterInterface $formatter)
    {
        $this->writer = $writer;
        $this->formatter = $formatter;
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function emergency($message, array $context = array())
    {
        $formatted = $this->formatter->setLogLevel(LogLevel::EMERGENCY)->format($message, $context);

        $this->writer->write($formatted);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function alert($message, array $context = array())
    {
        $formatted = $this->formatter->setLogLevel(LogLevel::ALERT)->format($message, $context);

        $this->writer->write($formatted);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function critical($message, array $context = array())
    {
        $formatted = $this->formatter->setLogLevel(LogLevel::CRITICAL)->format($message, $context);

        $this->writer->write($formatted);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function error($message, array $context = array())
    {
        $formatted = $this->formatter->setLogLevel(LogLevel::ERROR)->format($message, $context);

        $this->writer->write($formatted);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function warning($message, array $context = array())
    {
        $formatted = $this->formatter->setLogLevel(LogLevel::WARNING)->format($message, $context);

        $this->writer->write($formatted);
   }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function notice($message, array $context = array())
    {
        $formatted = $this->formatter->setLogLevel(LogLevel::NOTICE)->format($message, $context);

        $this->writer->write($formatted);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function info($message, array $context = array())
    {
        $formatted = $this->formatter->setLogLevel(LogLevel::INFO)->format($message, $context);

        $this->writer->write($formatted);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function debug($message, array $context = array())
    {
        $formatted = $this->formatter->setLogLevel(LogLevel::DEBUG)->format($message, $context);

        $this->writer->write($formatted);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        if (LogLevel::invalid($level)) {
            throw new InvalidArgumentException('Invalid log level: [' . $level . ']');
        }

        $formatted = $this->formatter->setLogLevel(strtolower($level))->format($message, $context);

        $this->writer->write($formatted);
    }
}
