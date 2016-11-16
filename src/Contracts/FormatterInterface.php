<?php

namespace Sx\Logger\Contracts;

interface FormatterInterface
{
    /**
     * Should format the content in a specific way.
     *
     * @param string $content The string to be formatted.
     * @param array $context The context data.
     * @return string The formatted string.
     */
    public function format($content, $context);

    /**
     * Should set the log level for the log.
     *
     * @return Sx\Logger\Formatters\Formatter
     */
    public function setLogLevel($logLevel);
}
