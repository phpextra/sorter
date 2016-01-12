<?php

namespace fixtures\PHPExtra\Sorter\Comparator;

use PHPExtra\Sorter\Comparator\NumericComparator;

/**
 * The NumericComparatorTest class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class NumericComparatorTest extends \PHPUnit_Framework_TestCase 
{
    public function formats()
    {
        return array(
            array(123456, true),                   // integers
            array(123456.123, true),               // floats
            array(new \DateTime(), false),         // date time
            array(new \stdClass(), false),         // objects
            array(true, false),                    // booleans
        );
    }

    public function values()
    {
        return array(
            array(-1000, -100, -1),
            array(1000, -100, 1),
            array(-100, -100, 0),

            array(-100, -1000, 1),
            array(-100, 1000, -1),

            array(100, 1000, -1),
            array(1000, 100, 1),
            array(100, 100, 0),

            array('100.00', '100.00', 0),
            array('101.00', '100.00', 1),
            array('101.00', '-100.00', 1),
            array('100.00', '101.00', -1),
            array('-100.00', '101.00', -1),

            array('100', '100', 0),
        );
    }

    public function testCreateNewInstance()
    {
        new NumericComparator();
    }

    /**
     * @dataProvider formats
     * @param mixed $value
     * @param boolean $isSupported Whether the value should be supported or not
     */
    public function testSupportedFormats($value, $isSupported)
    {
        $comparator = new NumericComparator();
        $this->assertSame($isSupported, $comparator->supports($value));
    }

    /**
     * @dataProvider values
     */
    public function testCompareValues($a, $b, $expectedResult)
    {
        $comparator = new NumericComparator();
        $this->assertEquals($expectedResult, $comparator->compare($a, $b));
    }

}
 