<?php

namespace Sx\Logger;

/**
 * Class LogLevel.
 *
 * @package Sx\Logger
 */
class LogLevel
{
    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';

    /**
     * Check if a log level is invalid.
     *
     * @param string $level
     * @return bool
     */
    public static function invalid($level)
    {
        return ! self::valid($level);
    }

    /**
     * Check if a log level is valid.
     *
     * @param string $level
     * @return bool
     */
    public static function valid($level)
    {
        return defined('self::' . $level);
    }
}
