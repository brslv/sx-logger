<?php

use \SplFileObject;
use Sx\Logger\Services\Time;
use Sx\Logger\Writers\FileWriter;

class FileWriterTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->filePath = __DIR__ . "/../storage/test.log";

        $this->file = new SplFileObject($this->filePath, 'w+');
    }
    
    private function read_whole_file()
    {
        $lines = '';

        while (!$this->file->eof()) {
            $lines .= $this->file->fgets();
        }

        return $lines;
    }

    private function truncate_file()
    {
        return $this->file->fwrite('');
    }

    /** @test */    
    public function it_can_write_to_a_file()
    {
        $fileWriter = new FileWriter($this->filePath);

        $fileWriter->write("This should be written to a file", []);

        $content = $this->read_whole_file();

        $this->truncate_file();

        $this->assertEquals("This should be written to a file", $content);
    }
}
