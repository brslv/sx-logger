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
            // if (strpos($value, '{') || strpos($value, '}')) {
            //     throw new \Exception("Invalid context data: " . $value . ". Context keys cannot contain `{` or `}` symbols.");
            // }

            $k = '{' . $key . '}';

            if (strpos($content, $k)) {
                $formatted = str_replace($k, $value, $formatted);
            } else {
                throw new ContextParseException("Invalid context data: the context parser could not find $k placeholder in the content string.");
            }
        } 

        return $formatted;
    }
}
