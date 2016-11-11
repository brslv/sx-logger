<?php

namespace Sx\Logger\Services;

use Sx\Logger\Exceptions\ContextParseException;

/**
 * Class ContextParser.
 *
 * @package Sx\Logger\Services
 */
class ContextParser
{
    /**
     * Parse the context of a log.
     *
     * @param string $content The content to be parsed.
     * @param array $context The context data array.
     * @return string
     */
    public static function parse($content, array $context)
    {
        $formatted = $content;

        foreach ($context as $key => $value) {
            $placeholder = '{' . $key . '}';

            if (strpos($content, $placeholder)) {
                $formatted = str_replace($placeholder, $value, $formatted);
            } else {
                throw new ContextParseException("Invalid context data: the context parser could not find $placeholder placeholder in the content string.");
            }
        } 

        return $formatted;
    }
}
