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
        return [
            ['7890', null, false],
            ['1234567890', null, true],
            ['1234567', null, true],
            ['12345678900', null, true],
            ['1sd2sdf3sdfg4ert5qwer6asdf7f8asdf900', null, true],
        ];
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
        return [
            ['now', true],
            ['last Monday', true],
            ['ma', false],
            ['10 September 2000', true],
            [0, false],
        ];
    }

    
}