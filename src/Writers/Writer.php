<?php

namespace Sx\Logger\Writers;

use Sx\Logger\LogLevel;
use \InvalidArgumentException;
use Sx\Logger\Contracts\WriterInterface;

/**
 * Class Writer.
 *
 * @package Sx\Logger\Writers
 */
abstract class Writer implements WriterInterface
{
    /** @var string */
    private $minimumLogLevel;

    /**
     * Should write to a source destination(file, db...).
     *
     * @param string $content The content to be written.
     * @return bool
     */
    public abstract function write($content);
}
