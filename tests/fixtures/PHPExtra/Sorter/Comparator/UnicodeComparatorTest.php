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
    public function testCreateNewUnicodeComparatorInstanceWithoutLocaleReturnsInstanceWithDefaultSystemLocale()
    {
        $comparator = new UnicodeComparator();

        $this->assertEquals($comparator->getLocale(), \Locale::getDefault());
    }

    public function testCreateNewUnicodeComparatorInstanceWithLocaleReturnsInstanceWithThatLocale()
    {
        $comparator = new UnicodeComparator('pl_PL');

        $this->assertEquals($comparator->getLocale(), 'pl_PL');
    }

    public function testUnicodeComparatorSupportsStrings()
    {
        $comparator = new UnicodeComparator();
        $string = 'zażółć gęślą jaźń';

        $this->assertTrue($comparator->supports($string));
    }

    public function testUnicodeComparatorSupportsIntegers()
    {
        $comparator = new UnicodeComparator();

        $string = 1234567;
        $this->assertTrue($comparator->supports($string));
    }

    public function testUnicodeComparatorSupportsFloats()
    {
        $comparator = new UnicodeComparator();

        $string = 1234567.6578;
        $this->assertTrue($comparator->supports($string));
    }

    public function testDateComparatorDoesNotSupportNonStringFloatsOrIntegers()
    {
        $comparator = new UnicodeComparator();

        $string = new \stdClass();
        $this->assertFalse($comparator->supports($string));

        $string = false;
        $this->assertFalse($comparator->supports($string));
    }

    public function testCompareTwoEqualStringsReturnsZero()
    {
        $string1 = 'zażółć gęślą jaźń';
        $string2 = 'zażółć gęślą jaźń';

        $comparator = new UnicodeComparator();

        $this->assertEquals(0, $comparator->compare($string1, $string2));
    }

    public function testCompareTwoStringsWhereFirstIsGreaterThanTheSecondReturnsOne()
    {
        $string1 = 'fzażółć gęślą jaźń';
        $string2 = 'ęzażółć gęślą jaźń';

        $comparator = new UnicodeComparator();

        $this->assertEquals(1, $comparator->compare($string1, $string2));
    }

    public function testCompareTwoStringsWhereSecondIsGreaterThanTheFirstReturnsMinusOne()
    {
        $string1 = 'ęzażółć gęślą jaźń';
        $string2 = 'fzażółć gęślą jaźń';

        $comparator = new UnicodeComparator();

        $this->assertEquals(-1, $comparator->compare($string1, $string2));
    }
}
 