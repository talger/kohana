<?php

class valid_CoreTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerPhone
     */
    public function testPhone($number, $lengths, $expected)
    {
        $this->assertEquals($expected, valid_Core::phone($number, $lengths));
    }

    public function providerPhone()
    {
        return array(
            array('7890', null, false),
            array('1234567890', null, true),
            array('1234567', null, true),
            array('12345678900', null, true),
            array('1sd2sdf3sdfg4ert5qwer6asdf7f8asdf900', null, true),
        );
    }

        /**
     * @dataProvider providerDate
     */
    public function testDate($str, $expected)
    {
        $this->assertEquals($expected, valid_Core::date($str));
    }

    public function providerDate()
    {
        return array(
            array('now', true),
            array('last Monday', true),
            array('ma', false),
            array('10 September 2000', true),
            array(0, false),
        );
    }


}