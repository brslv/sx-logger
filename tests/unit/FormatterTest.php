<?php

use Sx\Logger\Formatters\Formatter;

class FormatterTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_can_set_valid_log_levels()
    {
        $formatterStub = $this->getMockForAbstractClass(Formatter::class);
        $formatterStub->expects($this->any())
            ->method('setLogLevel')
            ->will($this->returnSelf());

        $this->assertEquals($formatterStub, $formatterStub->setLogLevel('info'));
    }

    /** 
     * @test 
     * @expectedException \InvalidArgumentException
     */
    public function it_throws_exceptions_on_invalid_log_levels()
    {
        $formatterStub = $this->getMockForAbstractClass(Formatter::class);
        $formatterStub->expects($this->any())
            ->method('setLogLevel')
            ->will($this->returnSelf());

        $this->assertEquals($formatterStub, $formatterStub->setLogLevel('invalid'));
    }
}
