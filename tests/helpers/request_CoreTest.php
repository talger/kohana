<?php

/**
 * @runTestsInSeparateProcesses
 */
class request_CoreTest extends PHPUnit_Framework_TestCase 
{

    /**
     * @dataProvider providerReferrer
     */
    public function testReferrer($server, $default, $expected)
    {
        $originalServer = $_SERVER;
        $_SERVER = $server;
        $this->assertEquals($expected, request_Core::referrer($default));
        $_SERVER = $originalServer;
        $this->markTestIncomplete();
    }

    public function providerReferrer()
    {
        return array(
           array(array(), false, false),
           array(array(), 'default-referer', 'default-referer'),
        );
    }

    public function testProtocol()
    {
        $this->assertNull(request_Core::protocol());
    }

    /**
     * @dataProvider providerIs_ajax
     */
    public function testIs_ajax($server, $expected)
    {
        $originalServer = $_SERVER;
        $_SERVER = $server;
        $this->assertEquals($expected, request_Core::is_ajax());
        $_SERVER = $originalServer;
    }

    public function providerIs_ajax()
    {
        return array(
            array(array(), false),
            array(array('HTTP_X_REQUESTED_WITH' => 'xmlhttprequest'), true),
            array(array('HTTP_X_REQUESTED_WITH' => 'nop'), false),
        );
    }

    /**
     * @dataProvider providerAllowedMethod
     */
    public function testMethod($server, $expected)
    {
        $originalServer = $_SERVER;
        $_SERVER = $server;
        $this->assertEquals($expected, request_Core::method());
        $_SERVER = $originalServer;
    }

    public function providerAllowedMethod()
    {
        return array(
            array(array('REQUEST_METHOD' => 'get'), 'get'),
            array(array('REQUEST_METHOD' => 'head'), 'head'),
            array(array('REQUEST_METHOD' => 'options'), 'options'),
            array(array('REQUEST_METHOD' => 'post'), 'post'),
            array(array('REQUEST_METHOD' => 'put'), 'put'),
            array(array('REQUEST_METHOD' => 'delete'), 'delete'),
        );
    }

    /**
     * @expectedException Kohana_Exception
     */
    public function testMethod2()
    {
        $this->markTestIncomplete();
        $_SERVER['REQUEST_METHOD'] = 'unknown';
        request_Core::method();
    }

}