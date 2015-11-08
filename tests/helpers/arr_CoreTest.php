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
        $this->assertEquals($expected, arr_Core::rotate($source_array, $keep_keys));
    }

    public function providerRotate()
    {
        return array(
            array(array(array('a', 'b'), array('c', 'd')), false, array(array('a', 'c'), array('b', 'd')))
        );
    }

    /**
     * @dataProvider providerRemove
     */
    public function testRemove($key, $array, $expected)
    {
        $original = $array;
        $this->assertEquals($expected, arr_Core::remove($key, $array));
        $this->assertCount(count($original) - 1, $array);
    }

    public function providerRemove()
    {
        return array(
            array(1, array(1 => 'one', 2 => 'two'), 'one'),
            array('one', array('one' => 'one', 2 => 'two'), 'one')
        );
    }

    public function testExtract()
    {
        $arr1 = array('baz' => 'baz', 'bar' => 'bar');
        $this->assertEquals(array('baz' => 'baz'), arr_Core::extract($arr1, 'baz'));
        $this->assertEquals(array('foo' => null), arr_Core::extract($arr1, 'foo'));
    }

    public function testUnshift_assoc()
    {
        $array = array('a' => 'a');
        $this->assertEquals(array('b' => 'b', 'a' => 'a'), arr_Core::unshift_assoc($array, 'b', 'b'));
    }

    public function testMap_recursive()
    {
        $array = array('a', 'b', array('c', 'd'));

        $this->assertEquals(array('A', 'B', array('C', 'D')), arr_Core::map_recursive('strtoupper', $array));
    }

    public function testBinary_search()
    {
        $array = array('d','e','a','c','b');
        $this->assertEquals(0, arr_core::binary_search('a', $array, true));
        $this->assertEquals(false, arr_core::binary_search('e', $array, false));
    }

    public function testOverwrite()
    {
        $array1 = array('a' => 'a', 'b' => 'b');
        $array2 = array('a' => 'A', 'd' => 'd');
        $this->assertEquals(array('a' => 'A', 'b' => 'b'), arr_Core::overwrite($array1, $array2));
        $array3 = array('b' => 'B', 'e' => 'e');
        $this->assertEquals(array('a' => 'A', 'b' => 'B'), arr_Core::overwrite($array1, $array2, $array3));
    }

    public function testMerge()
    {
        $array1 = array('a' => 'a', 'b' => 'b');
        $array2 = array('a' => 'A', 'd' => 'd', 'f' => array(1,2,3));
        $this->assertEquals(array('a' => 'A', 'b' => 'b', 'd' => 'd', 'f' => array(1,2,3)), arr_Core::merge($array1, $array2));
        $array3 = array(1,2,3,4, 'f' => array(5,6,7));
        $this->assertEquals(array(1,2,3,4,'a' => 'A', 'b' => 'b', 'd' => 'd', 'f' => array(1,2,3,5,6,7)), arr_Core::merge($array1, $array2, $array3));
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
