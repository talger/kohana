<?php

class arr_CoreTest extends PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerCallback_string
     */
    public function testCallback_string($str, $expected)
    {
        $this->assertEquals($expected, arr_Core::callback_string($str));
    }

    public function providerCallback_string()
    {
        return array(
            array('limit[10]', array('limit', array(10))),
            array('limit[10,20]', array('limit', array(10, 20))),
            array('limit[10,20,30]', array('limit', array(10, 20, 30))),
            array('limit', array('limit', null)),
        );
    }

    /**
     * @dataProvider providerRotate
     */
    public function testRotate($source_array, $keep_keys, $expected)
    {
        $this->markTestIncomplete();
        $this->assertEquals($expected, arr_Core::rotate($source_array, $keep_keys));
    }

    public function providerRotate()
    {
        return array(
            array(false, false, false)
        );
    }

    /**
     * @dataProvider providerRemove
     */
    public function testRemove($key, $array, $expected)
    {
        $this->assertEquals($expected, arr_Core::remove($key, $array));
    }

    public function providerRemove()
    {
        return array(
            array(1, array(1 => 'one', 2 => 'two'), 'one'),
            array('one', array('one' => 'one', 2 => 'two'), 'one')
        );
    }

    /**
     * @dataProvider providerRange
     */
    public function testRange($step, $max, $expected)
    {
        $this->assertEquals($expected, arr_Core::range($step, $max));
    }

    public function providerRange()
    {
        return array(
            array(10, 100, array_combine(range(10,100, 10), range(10,100, 10))),
        );
    }

    public function testTo_array()
    {
        $array = array('int' => 1, 'string' => 'string', 'array' => array_combine(array('a','b','c'), range(1,3)));

        $expected = new stdClass();
        $expected->int = 1;
        $expected->string = 'string';
        $expected->array = new stdClass();
        $expected->array->a = 1;
        $expected->array->b = 2;
        $expected->array->c = 3;

        $this->assertEquals($expected, arr_Core::to_object($array));
    }
}