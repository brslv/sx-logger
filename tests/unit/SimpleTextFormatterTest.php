<?php

use Sx\Logger\LogLevel;
use Sx\Logger\Services\Moment;
use Sx\Logger\Formatters\SimpleTextFormatter;

class SimpleTextFormatterTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_instantiate_simple_text_formatter_objects()
    {
        $stf = new SimpleTextFormatter();

        $this->assertinstanceOf(SimpleTextFormatter::class, $stf);
    }

    /** @test */
    public function it_can_format_simple_text()
    {
        $stf = new SimpleTextFormatter();

        $content = "This should be formatted properly";
        $context = [];
        $formattedContent = $stf->setLogLevel(LogLevel::EMERGENCY)->format($content, $context);

        $expected = "[emergency] " . Moment::pretty() . $content . "\n";

        $this->assertEquals($expected, $formattedContent);
    }
}
