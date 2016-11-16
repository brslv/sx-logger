<?php

namespace Sx\Logger;

use Sx\Logger\LogLevel;
use Sx\Logger\LogHandler;
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
    /** @var array */
    private $handlers;

    /**
     * Constructor.
     *
     * @param Sx\Logger\Contracts\WriterInterface $writer
     */
    public function __construct($handlers)
    {
        if ( !is_array($handlers) && !($handlers instanceof LogHandler)) {
            throw new InvalidArgumentException("Invalid handler(s) passed to the Logger.");
        }

        if ( !is_array($handlers)) {
            $handlers = [$handlers];
        }

        $this->handlers = $handlers;
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
        foreach ($this->handlers as $handler) {
            $formatted = $handler->setLogLevel(LogLevel::EMERGENCY)->format($message, $context);

            $handler->write($formatted);
        }
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
        foreach ($this->handlers as $handler) {
            $formatted = $handler->setLogLevel(LogLevel::ALERT)->format($message, $context);

            $handler->write($formatted);
        }
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
        foreach ($this->handlers as $handler) {
            $formatted = $handler->setLogLevel(LogLevel::CRITICAL)->format($message, $context);

            $handler->write($formatted);
        }
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
        foreach ($this->handlers as $handler) {
            $formatted = $handler->setLogLevel(LogLevel::ERROR)->format($message, $context);

            $handler->write($formatted);
        }
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
        foreach ($this->handlers as $handler) {
            $formatted = $handler->setLogLevel(LogLevel::WARNING)->format($message, $context);

            $handler->write($formatted);
        }
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
        foreach ($this->handlers as $handler) {
            $formatted = $handler->setLogLevel(LogLevel::NOTICE)->format($message, $context);

            $handler->write($formatted);
        }
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
        foreach ($this->handlers as $handler) {
            $formatted = $handler->setLogLevel(LogLevel::INFO)->format($message, $context);

            $handler->write($formatted);
        }
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
        foreach ($this->handlers as $handler) {
            $formatted = $handler->setLogLevel(LogLevel::DEBUG)->format($message, $context);

            $handler->write($formatted);
        }
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

        foreach ($this->handlers as $handler) {
            $formatted = $handler->setLogLevel(strtolower($level))->format($message, $context);

            $handler->write($formatted);
        }
    }
}
