<?php

use \SplFileObject;
use Sx\Logger\Logger;
use Sx\Logger\LogLevel;
use Sx\Logger\LogHandler;
use Sx\Logger\Services\Moment;
use Sx\Logger\Writers\FileWriter;
use Sx\Logger\Formatters\SimpleTextFormatter;

class LoggerIntegrationTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->firstFilePath = __DIR__ . "/../storage/test.log";
        $this->secondFilePath = __DIR__ . "/../storage/second_test.log";

        $this->firstFile = new SplFileObject($this->firstFilePath, 'w+');
        $this->secondFile = new SplFileObject($this->secondFilePath, 'w+');
    }
    
    private function read_whole_file($file)
    {
        $lines = '';

        while (!$file->eof()) {
            $lines .= $file->fgets();
        }

        return $lines; }

    private function truncate_file($file)
    {
        return $file->fwrite('');
    }

    /** @test */
    public function it_can_log_to_a_single_handler()
    {
        $firstHandler = new LogHandler(new FileWriter($this->firstFilePath), new SimpleTextFormatter);
        $secondHandler = new LogHandler(new FileWriter($this->secondFilePath), new SimpleTextFormatter);
        $handlers = [$firstHandler, $secondHandler];
        $logger = new Logger($handlers);

        $content = "Some handy information...";
        $logger->info($content);

        $firstFileContents = $this->read_whole_file($this->firstFile);
        $this->truncate_file($this->firstFile);

        $secondFileContents = $this->read_whole_file($this->secondFile);
        $this->truncate_file($this->secondFile);
        $expectedContents = "[" . LogLevel::INFO . "] " . Moment::pretty() . $content . "\n";

        $this->assertEquals($expectedContents, $firstFileContents);
        $this->assertEquals($expectedContents, $secondFileContents);
    }
}
