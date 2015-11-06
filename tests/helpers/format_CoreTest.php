<?php
 
class format_CoreTest extends PHPUnit_Framework_TestCase 
{

    /**
     * @dataProvider providerPhone
     */
    public function testPhone($number, $format, $expected)
    {
        $this->assertEquals($expected, format_Core::phone($number, $format));
    }

    public function providerPhone()
    {
        return array(
            array('1234567890', '3-3-4', '123-456-7890'),
            array('123456789', '3-3-3', '123-456-789'),
            array('1234567', '3-3-3', '1234567'),
        );
    }

    /**
     * @dataProvider providerUrl
     */
    public function testUrl($str, $expected)
    {
        $this->assertEquals($expected, format_Core::url($str));
    }

    public function providerUrl()
    {
        return array(
            array('', ''),
            array('http://', ''),
            array('ftp://', ''),
            array('http://php.net', 'http://php.net'),
            array('php.net', 'http://php.net'),
        );
    }

    
}