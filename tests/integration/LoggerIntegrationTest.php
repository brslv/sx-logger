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
    public function it_can_write_simple_text_with_time_and_placeholder_as_emergency()
    {
        $writer = new FileWriter($this->filePath);
        $formatter = new SimpleTextFormatter;

        $logger = new Logger($writer, $formatter); 
        $logger->emergency("The quick {color} {animal} jumps over...", [
            'color' => 'brown',
            'animal' => 'fox',
        ]);
        $expected = "[" . LogLevel::EMERGENCY . "] " . Moment::pretty() . "The quick brown fox jumps over...\n";

        $content = $this->read_whole_file();
        $this->truncate_file();

        $this->assertEquals($expected, $content);
    }

    /** @test */
    public function it_can_write_simple_text_with_time_and_placeholder_as_alert()
    {
        $writer = new FileWriter($this->filePath);
        $formatter = new SimpleTextFormatter;
        $logger = new Logger($writer, $formatter);

        $logger->alert("{something} went wrong!", [
            'something' => 'Something',
        ]);
        $expected = "[" . LogLevel::ALERT . "] " . Moment::pretty() . "Something went wrong!\n";
        $content = $this->read_whole_file();
        $this->truncate_file();

        $this->assertEquals($expected, $content);
    }

    /** @test */
    public function it_can_write_simple_text_with_time_and_placeholder_as_critical()
    {
        $writer = new FileWriter($this->filePath);
        $formatter = new SimpleTextFormatter;
        $logger = new Logger($writer, $formatter);

        $logger->critical("This is critical!!!", []);
        $expected = "[" . LogLevel::CRITICAL . "] " . Moment::pretty() . "This is critical!!!\n";
        $content = $this->read_whole_file();
        $this->truncate_file();

        $this->assertEquals($expected, $content);
    }

    /** @test */
    public function it_can_write_simple_text_with_time_and_placeholder_as_error()
    {
        $writer = new FileWriter($this->filePath);
        $formatter = new SimpleTextFormatter;
        $logger = new Logger($writer, $formatter);

        $logger->error("This is error!!!", []);
        $expected = "[" . LogLevel::ERROR . "] " . Moment::pretty() . "This is error!!!\n";
        $content = $this->read_whole_file();
        $this->truncate_file();

        $this->assertEquals($expected, $content);
    }

    /** @test */
    public function it_can_write_simple_text_with_time_and_placeholder_as_warning()
    {
        $writer = new FileWriter($this->filePath);
        $formatter = new SimpleTextFormatter;
        $logger = new Logger($writer, $formatter);

        $logger->warning("This is warning!!!", []);
        $expected = "[" . LogLevel::WARNING . "] " . Moment::pretty() . "This is warning!!!\n";
        $content = $this->read_whole_file();
        $this->truncate_file();

        $this->assertEquals($expected, $content);
    }

    /** @test */
    public function it_can_write_simple_text_with_time_and_placeholder_as_notice()
    {
        $writer = new FileWriter($this->filePath);
        $formatter = new SimpleTextFormatter;
        $logger = new Logger($writer, $formatter);

        $logger->notice("This is notice!!!", []);
        $expected = "[" . LogLevel::NOTICE . "] " . Moment::pretty() . "This is notice!!!\n";
        $content = $this->read_whole_file();
        $this->truncate_file();

        $this->assertEquals($expected, $content);
    }


    /** @test */
    public function it_can_write_simple_text_with_time_and_placeholder_as_info()
    {
        $writer = new FileWriter($this->filePath);
        $formatter = new SimpleTextFormatter;
        $logger = new Logger($writer, $formatter);

        $logger->info("This is info!!!", []);
        $expected = "[" . LogLevel::INFO . "] " . Moment::pretty() . "This is info!!!\n";
        $content = $this->read_whole_file();
        $this->truncate_file();

        $this->assertEquals($expected, $content);
    }

    /** @test */
    public function it_can_write_simple_text_with_time_and_placeholder_as_debug()
    {
        $writer = new FileWriter($this->filePath);
        $formatter = new SimpleTextFormatter;
        $logger = new Logger($writer, $formatter);

        $logger->debug("This is debug!!!", []);
        $expected = "[" . LogLevel::DEBUG . "] " . Moment::pretty() . "This is debug!!!\n";
        $content = $this->read_whole_file();
        $this->truncate_file();

        $this->assertEquals($expected, $content);
    }

    /** @test */
    public function it_can_write_simple_text_with_time_and_placeholder_as_log()
    {
        $writer = new FileWriter($this->filePath);
        $formatter = new SimpleTextFormatter;
        $logger = new Logger($writer, $formatter);

        $logger->log('INFO', "This is log!!!", []);
        $expected = "[" . LogLevel::INFO . "] " . Moment::pretty() . "This is log!!!\n";
        $content = $this->read_whole_file();
        $this->truncate_file();

        $this->assertEquals($expected, $content);
    }

    /** 
     * @test 
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid log level: [INVALID]
     */
    public function log_method_throws_exception_on_invalid_log_level()
    {
        $writer = new FileWriter($this->filePath);
        $formatter = new SimpleTextFormatter;
        $logger = new Logger($writer, $formatter);

        $logger->log('INVALID', "This is log!!!", []);
    }
}
