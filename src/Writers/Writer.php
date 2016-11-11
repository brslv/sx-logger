<?php

namespace Sx\Logger\Writers;

use Sx\Logger\Contracts\WriterInterface;

/**
 * Class Writer.
 *
 * @package Sx\Logger\Writers
 */
abstract class Writer implements WriterInterface
{

    /**
     * Should write to a source destination(file, db...).
     *
     * @param string $content The content to be written.
     * @return bool
     */
    public abstract function write($content);
}
