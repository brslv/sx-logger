<?php

use Sx\Logger\Logger;
use Sx\Logger\LogLevel;
use Sx\Logger\Services\Moment;
use Sx\Logger\Writers\FileWriter;
use Sx\Logger\Formatters\SimpleTextFormatter;

class LoggerIntegrationTest extends PHPUnit_Framework_TestCase
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
    public function it_can_write_simple_text_with_time_and_placeholder()
    {
        $writter = new FileWriter($this->filePath);
        $formatter = new SimpleTextFormatter;

        $logger = new Logger($writter, $formatter); 
        $logger->emergency("The quick {color} {animal} jumps over...", [
            'color' => 'brown',
            'animal' => 'fox',
        ]);
        $expected = Moment::pretty() . "[" . LogLevel::EMERGENCY . "]" . " The quick brown fox jumps over...\n";

        $content = $this->read_whole_file();
        $this->truncate_file();

        $this->assertEquals($expected, $content);
    }
}
