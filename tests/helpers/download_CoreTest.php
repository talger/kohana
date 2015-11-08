<?php

/**
 * @runTestsInSeparateProcesses
 * @requires extension xdebug
 */
class download_CoreTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        eval('
            class Kohana {

                public static $__user_agent = "Internet Explorer";

                public static function config($key)
                {
                    require dirname(__FILE__) . "/../../src/config/mimes.php";
                    $key = substr($key, 6);

                    return isset($config[$key]) ? $config[$key] : null;
                }

                public function user_agent()
                {
                    return self::$__user_agent;
                }

                public function close_buffers()
                {}
            }
        ');
    }

    public function testForceIE()
    {
        $this->assertFalse(download_Core::force());

        download_Core::force('export.csv');
        $headers = xdebug_get_headers();

        $this->assertContains('Cache-Control: must-revalidate, post-check=0, pre-check=0', $headers);
        $this->assertContains('Pragma: public', $headers);
        $this->assertContains('Content-Disposition: attachment; filename="export.csv"', $headers);
    }

    public function testForceNonIE()
    {
        Kohana::$__user_agent = 'undefined';

        download_Core::force('export.undefined');
        $headers = xdebug_get_headers();

        $this->assertContains('Pragma: no-cache', $headers);
    }

    public function testForceFile()
    {
        $this->expectOutputString(file_get_contents(dirname(__FILE__) . "/../../src/config/mimes.php"));
        download_Core::force(dirname(__FILE__) . "/../../src/config/mimes.php");
        $headers = xdebug_get_headers();

        $this->assertContains('Content-Length: 9943', $headers);
    }

}
