<?php

namespace Sx\Logger\Services;

use \DateTime;

/**
 * Class Moment.
 *
 * Provides some shortcuts to frequently used date/time functionalities.
 *
 * @package Sx\Logger\Services
 */
class Moment
{
    /**
     * Get the current date/time.
     *
     * @return DateTime
     */
    public static function now()
    {
        return new DateTime("now");
    }

    public static function toTimestamp($moment)
    {
        return strtotime($moment->format("F j, Y, g:i a"));
    }

    /**
     * Get a formatted date/time string of "now".
     *
     * Used for logging the date/time a given message is logged.
     *
     * @return string The current date/time in the format [F j, Y, g:i a]
     */
    public static function pretty()
    {
        return '[' . self::now()->format("F j, Y, g:i a") . '] : ';
    }
}
