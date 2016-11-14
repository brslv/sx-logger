<?php

use Sx\Logger\DTO\LogData;
use Sx\Logger\Services\Moment;
use Sx\Logger\Formatters\JsonFormatter;

class JsonFormatterTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_instantiate_json_formatter_objects()
    {
        $jsonFormatter = new JsonFormatter();

        $this->assertinstanceOf(JsonFormatter::class, $jsonFormatter);
    }

    /** @test */
    public function it_can_format_json()
    {
        $jsonFormatter = new JsonFormatter;

        $content = "Format this {content}.";
        $context = ['content' => 'text'];
        $formatted = $jsonFormatter->format($content, $context);

        $expected = json_encode(new LogData($content, $context, "Format this text.")) . "\n";

        $this->assertEquals($expected, $formatted);
    }
}
