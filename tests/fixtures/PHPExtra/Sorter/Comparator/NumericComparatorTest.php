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
    /**
     * @return array
     */
    public function numbers()
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
        );
    }

    /**
     * @dataProvider numbers
     */
    public function testCompareNumbersProduceValidResult($a, $b, $expectedResult)
    {
        $comparator = new NumericComparator();
        $this->assertEquals($expectedResult, $comparator->compare($a, $b));
    }

    public function testUnicodeComparatorSupportsIntegers()
    {
        $comparator = new NumericComparator();

        $string = 1234567;
        $this->assertTrue($comparator->supports($string));
    }

    public function testUnicodeComparatorSupportsFloats()
    {
        $comparator = new NumericComparator();

        $string = 1234567.6578;
        $this->assertTrue($comparator->supports($string));
    }

    public function testUnicodeComparatorDoesNotSupportsNonNumericStrings()
    {
        $comparator = new NumericComparator();

        $string = 'xyzuasdasd';
        $this->assertFalse($comparator->supports($string));
    }

    public function testDateComparatorDoesNotSupportNonStringFloatsOrIntegers()
    {
        $comparator = new NumericComparator();

        $string = new \stdClass();
        $this->assertFalse($comparator->supports($string));

        $string = false;
        $this->assertFalse($comparator->supports($string));
    }
}
 