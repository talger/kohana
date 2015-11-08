<?php

/**
 * @runTestsInSeparateProcesses
 */
class security_CoreTest extends \PHPUnit_Framework_TestCase
{

    public function testEncode_php_tags()
    {
        $this->assertEquals('&lt;?php phpinfo(); ?&gt;', security_Core::encode_php_tags('<?php phpinfo(); ?>'));
    }

    public function testStrip_image_tags()
    {
        $this->assertEquals('', security_Core::strip_image_tags('<img />'));
    }

    public function testXss_clean()
    {
        // itt nem az Input::xss_clean fügvényét tezsteljük, ezért ez is jó
        eval('class Input {

            public static function instance() { return new static; }

            public function xss_clean($str) { return $str; }}
        ');
        $this->assertEquals('foo', security_Core::xss_clean('foo'));
    }

}
