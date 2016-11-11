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
    public function it_can_prepend_date_time()
    {
        $stf = new SimpleTextFormatter();

        $content = "This should be formatted properly";
        $context = [];
        $formattedContent = $stf->setLogLevel(LogLevel::EMERGENCY)->format($content, $context);

        $expected = Moment::pretty() . "[emergency] " . $content . "\n";

        $this->assertEquals($expected, $formattedContent);
    }
}
