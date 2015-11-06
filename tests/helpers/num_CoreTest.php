<?php
 
class num_CoreTest extends PHPUnit_Framework_TestCase 
{

    /**
     * @dataProvider providerRound
     */
    public function testRound($number, $nearest, $expected)
    {
        $this->assertEquals($expected, num_Core::round($number, $nearest));
    }

    public function providerRound()
    {
        return array(
            array(12, 5, 10),
            array(15, 5, 15),
        );
    }

}