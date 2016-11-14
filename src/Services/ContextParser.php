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
     * Parse the context of a log message.
     *
     * It searches for keys, surrounded by curly braces (e.g. {some_key})
     * and replaces them with the corresponding values, found
     * in the $context array.
     *
     * ---------
     * Examples:
     * ---------
     *
     * Given:
     *
     * $content => "Hello, my name is {name} and I'm {age} years old"
     * $context => ["name" => "Borislav", "age" => 25]
     *
     * Results in the following string => "Hello, my name is Borislav and I'm 25 years old".
     *
     * Another, more esoteric case is the following:
     *
     * Given:
     *
     * $context => "Hello, my name is {{name}}"
     * $context => ["{name}" => "Borislav"]
     *
     * Is interpolated to: "Hello, my name is {Borislav}".
     *
     * @param string $content The content to be parsed.
     * @param array $context The context data array.
     * @throws Sx\Logger\Exceptions\ContextParseException If a given key from the $context array cannot be found in the $content string.
     * @return string
     */
    public static function parse($content, array $context)
    {
        $formatted = $content;

        foreach ($context as $key => $value) {
            $placeholder = '{' . $key . '}';

            if (false !== strpos($content, $placeholder)) {
                $formatted = str_replace($placeholder, $value, $formatted);
            } else {
                throw new ContextParseException("Invalid context data: the context parser could not find $placeholder placeholder in the content string.");
            }
        } 

        return $formatted;
    }
}
