<?php

namespace Sx\Logger\Contracts;

interface FormatterInterface
{
    /**
     * Should format the content in a specific way.
     *
     * @param string $content The string to be formatted.
     * @param array $context The context data.
     * @return $string The formatted string.
     */
    public function format($content, $context);
}
