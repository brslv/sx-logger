<?php

namespace Sx\Logger\Contracts;

/**
 * Interface WriterInterface.
 *
 * @package Sx\Logger\Contracts
 */
interface WriterInterface
{
    /**
     * Should write to a source destination (file, db, etc...).
     *
     * @param string $content The content to be written.
     * @return bool
     */
    public function write($content);
}
