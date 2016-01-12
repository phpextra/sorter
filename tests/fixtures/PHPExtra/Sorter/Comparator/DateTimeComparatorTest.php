<?php

namespace fixtures\PHPExtra\Sorter\Comparator;

use PHPExtra\Sorter\Comparator\DateTimeComparator;

/**
 * The DateTimeComparatorTest class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class DateTimeComparatorTest extends \PHPUnit_Framework_TestCase
{
    public function formats()
    {
        return array(
            array(new \DateTime(), true),           // date time
            array(123456, false),                   // integers
            array(123456.123, false),               // floats
            array(new \stdClass(), false),          // objects
            array(true, false),                     // booleans
        );
    }

    public function values()
    {
        return array(
            array(\DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 12:56:11'), \DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 12:56:11'), 0),
            array(\DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 13:56:11'), \DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 12:56:11'), 1),
            array(\DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 12:56:11'), \DateTime::createFromFormat('Y-m-d H:i:s', '2016-01-01 13:56:11'), -1),
        );
    }

    public function testCreateNewDateTimeComparatorInstance()
    {
        new DateTimeComparator();
    }

    /**
     * @dataProvider formats
     * @param mixed $value
     * @param boolean $isSupported Whether the value should be supported or not
     */
    public function testSupportedFormats($value, $isSupported)
    {
        $comparator = new DateTimeComparator();
        $this->assertSame($isSupported, $comparator->supports($value));
    }

    /**
     * @dataProvider values
     */
    public function testCompareValues($a, $b, $expectedResult)
    {
        $comparator = new DateTimeComparator();
        $this->assertEquals($expectedResult, $comparator->compare($a, $b));
    }
}
 