<?php

use Sx\Logger\Logger;
use Sx\Logger\Writers\FileWriter;
use Sx\Logger\Formatters\SimpleTextFormatter;

class LoggerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->filePath = __DIR__ . '/../storage/test.log';
    }

    /** @test */
    public function it_can_instantiate_logger()
    {
        $writter = new FileWriter($this->filePath);
        $formatter = new SimpleTextFormatter;

        $logger = new Logger($writter, $formatter); 

        $this->assertinstanceOf(Sx\Logger\Logger::class, $logger);
    }
}
