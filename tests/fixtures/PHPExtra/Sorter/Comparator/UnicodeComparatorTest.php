<?php

namespace fixtures\PHPExtra\Sorter\Comparator;

use PHPExtra\Sorter\Comparator\UnicodeComparator;

/**
 * The UnicodeComparatorTest class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class UnicodeComparatorTest extends \PHPUnit_Framework_TestCase 
{
    public function formats()
    {
        return array(
            array('zażółć gęślą jaźń', true),       // strings
            array(123456, true),                    // integers
            array(123456.123, true),                // floats
            array(new \stdClass(), false),          // objects
            array(true, false),                     // booleans
        );
    }

    public function values()
    {
        return array(

            array(-1000, -100, 1), // correct
            array(1000, -100, 1),
            array(-100, -100, 0),

            array(-100, -1000, -1), // correct
            array(-100, 1000, -1),

            array(100, 1000, -1),
            array(1000, 100, 1),
            array(100, 100, 0),

            array('-1000', '-100', 1),
            array('-100', '100', -1),
            array('100', '-100', 1),
            array('-100', '-100', 0),
            array('-1', '1', -1),
            array('1', '-1', 1),
            array('-1', '-1', 0),
            array('1', '1', 0),
            array('1', '2', -1),
            array('2', '1', 1),
            array('a', 'a', 0),
            array('a', 'b', -1),
            array('b', 'a', 1),
            array('zażółć gęślą jaźń', 'zażółć gęślą jaźń', 0),
            array('fzażółć gęślą jaźń', 'ęzażółć gęślą jaźń', 1),
            array('ęzażółć gęślą jaźń', 'fzażółć gęślą jaźń', -1),
        );
    }

    public function testCreateNewUnicodeComparatorInstanceWithoutLocaleReturnsInstanceWithDefaultSystemLocale()
    {
        $comparator = new UnicodeComparator();

        $this->assertEquals($comparator->getLocale(), \Locale::getDefault());
    }

    public function testCreateNewUnicodeComparatorInstanceWithLocaleReturnsInstanceWithThatLocale()
    {
        $comparator = new UnicodeComparator('pl_PL');

        $this->assertEquals('pl_PL', $comparator->getLocale());
    }

    /**
     * @dataProvider formats
     * @param mixed $value
     * @param boolean $isSupported Whether the value should be supported or not
     */
    public function testSupportedFormats($value, $isSupported)
    {
        $comparator = new UnicodeComparator();
        $this->assertSame($isSupported, $comparator->supports($value));
    }

    /**
     * @dataProvider values
     */
    public function testCompareValues($a, $b, $expectedResult)
    {
        $comparator = new UnicodeComparator('pl_PL');
        $this->assertEquals($expectedResult, $comparator->compare($a, $b));
    }
}
 