<?php

use Sx\Logger\Services\ContextParser;

class ContextParserTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_format_text_with_context()
    {
        $content = "Hello, {name}, {{age}}, {{city}}.";
        $context = ['name' => 'Borislav Grigorov', '{age}' => 23, 'city' => 'Sofia'];
        $parsedContent = ContextParser::parse($content, $context);

        $expected = 'Hello, Borislav Grigorov, 23, {Sofia}.';

        $this->assertEquals($expected, $parsedContent);

        $content = "{something} went wrong, bro.";
        $context = ['something' => 'Something'];
        $parsedContent = ContextParser::parse($content, $context);

        $expected = 'Something went wrong, bro.';

        $this->assertEquals($expected, $parsedContent);
    }

    /** 
     * @test 
     * @expectedException Sx\Logger\Exceptions\ContextParseException
     */
    public function it_should_throw_exception_for_invalid_context_data()
    {
        $content = "Hello, {name}.";
        $context = ['age' => '23']; // no age == invalid
        $parsedContent = ContextParser::parse($content, $context);
    }
}
