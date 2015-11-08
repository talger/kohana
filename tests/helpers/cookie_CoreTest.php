<?php

/**
 * @runTestsInSeparateProcesses
 * @requires extension xdebug
 */
class cookie_CoreTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        eval('
            class Kohana {

                public static function config()
                {
                    return array(
                        "httponly" => true
                    );
                }
            }
        ');

        eval('class Input {

            public static function instance() { return new static; }

            public function cookie($name, $default = NULL) {
                if ($name == "undefined") {
                    return $default;
                }

                return array();
            }
            }
        ');
    }

    public function testSet()
    {
        $this->assertTrue(cookie_Core::set('name', 'val'));
        $headers = xdebug_get_headers();
        $this->assertContains('Set-Cookie: name=val; httponly', $headers);
    }

    public function testDelete()
    {
        $this->assertFalse(cookie_Core::delete('name'));
        $_COOKIE['name'] = array();
        $this->assertTrue(cookie_Core::delete('name'));

        $headers = xdebug_get_headers();
        $this->assertContains('Set-Cookie: name=deleted; expires=Thu, 01-Jan-1970 00:00:01 GMT; Max-Age=0', $headers);
    }

    public function testGet()
    {
        $this->assertFalse(cookie_Core::get('undefined', false));
        $this->assertEquals(array(), cookie_Core::get('foo'));
    }
}
