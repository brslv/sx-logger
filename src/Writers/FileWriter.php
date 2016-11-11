<?php

namespace Sx\Logger\Writers;

use SplFileObject;
use Sx\Logger\Writers\Writer;

/**
 * Class FileWriter.
 *
 * @package Sx\Logger\Writers
 */
class FileWriter extends Writer
{
    /** @var SplFileObject */
    private $file;

    /**
     * Constructor.
     *
     * @param string $filePath The path to the log file.
     */
    public function __construct($filePath)
    {
        $openMode = 'a';

        $this->file = new SplFileObject($filePath, $openMode);
    }

    /**
     * Should write to a source destination (file, db...).
     *
     * @param string $content The content to be written.
     * @return bool
     */
    public function write($content)
    {
        return null !== $this->file->fwrite($content);
    }
}
