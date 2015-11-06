<?php
 
class date_CoreTest extends PHPUnit_Framework_TestCase 
{

    /**
     * @dataProvider providerAmpm
     */
    public function testAmpm($hour, $expected)
    {
        $this->assertEquals($expected, date_Core::ampm($hour));
    }

    public function providerAmpm()
    {
        return array(
            array(12, 'PM'),
            array(11, 'AM'),
        );
    }

    /**
     * @dataProvider providerAdjust
     */
    public function testAdjust($hour, $ampm, $expected)
    {
        $this->assertEquals($expected, date_Core::adjust($hour, $ampm));
    }

    public function providerAdjust()
    {
        return array(
            array(12, 'PM', 12),
            array(11, 'PM', 23),
            array(12, 'AM', 0),
            array(11, 'AM', 11),
        );
    }

    /**
     * @dataProvider providerDays
     */
    public function testDays($month, $year, $expected)
    {
        $this->assertEquals($expected, date_Core::days($month, $year));
    }

    public function providerDays()
    {
        return array(
            array(1, false, array_combine(range(1, 31), range(1, 31))),
            array(2, false, array_combine(range(1, 28), range(1, 28))),
            array(2, 2016, array_combine(range(1, 29), range(1, 29))),
        );
    }
    
    /**
     * @dataProvider providerYears
     */
    public function testYears($start, $end, $expected)
    {
        $this->assertEquals($expected, date_Core::years($start, $end));
    }

    public function providerYears()
    {
        return array(
            array(false, false, array_combine(
                range(date('Y') - 5, date('Y') + 5),
                range(date('Y') - 5, date('Y') + 5)
            )),
            array(2014, 2016, array(2014 => 2014, 2015 => 2015, 2016 => 2016)),
        );
    }

    /**
     * @dataProvider providerSeconds
     */
    public function testSeconds($step, $start, $end, $expected)
    {
        $this->assertEquals($expected, date_Core::seconds($step, $start, $end));
    }

    public function providerSeconds()
    {
        return array(
            array(1, 0, 5, array_combine(range(0,4), array('00', '01', '02', '03', '04'))),
            array(10, 0, 60, array(10 => 10, 20 => 20, 30 => 30, 40 => 40, 50 => 50, 0 => '00')),
        );
    }

    /**
     * @dataProvider providerMinutes
     */
    public function testMinutes($step, $expected)
    {
        $this->assertEquals($expected, date_Core::minutes($step));
    }

    public function providerMinutes()
    {
        return array(
            array(15, array(0 => '00', 15 => '15', 30 => '30', 45 => '45')),
        );
    }

    /**
     * @dataProvider providerHours
     */
    public function testHours($step, $long, $start, $expected)
    {
        $this->assertEquals($expected, date_Core::hours($step, $long, $start));
    }

    public function providerHours()
    {
        return array(
            array(1, false, null, array_combine(range(1, 12), range(1, 12))),
            array(1, true, null, array_combine(range(0, 23), range(0, 23))),
            array(1, false, 6, array_combine(range(6, 12), range(6, 12))),
            array(1, true, 6, array_combine(range(6, 23), range(6, 23))),
        );
    }
}