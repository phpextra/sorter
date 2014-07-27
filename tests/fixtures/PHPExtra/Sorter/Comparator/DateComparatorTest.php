<?php

namespace fixtures\PHPExtra\Sorter\Comparator;

use PHPExtra\Sorter\Comparator\DateComparator;

/**
 * The DateComparatorTest class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class DateComparatorTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreateNewDateComparatorInstance()
    {
        new DateComparator();
    }

    public function testDateComparatorSupportsDateTimeObject()
    {
        $comparator = new DateComparator();
        $date = new \DateTime();

        $this->assertTrue($comparator->supports($date));
    }

    public function testDateComparatorDoesNotSupportNonDateTimeObject()
    {
        $comparator = new DateComparator();
        $date = new \stdClass();

        $this->assertFalse($comparator->supports($date));
    }
    
    public function testCompareTwoEqualDatesReturnsZero()
    {
        $comparator = new DateComparator();

        $date1 = new \DateTime('now');
        $date2 = clone $date1;

        $this->assertEquals(0, $comparator->compare($date1, $date2));
    }

    public function testCompareTwoDatesWhereFirstDateIsLaterReturnsOne()
    {
        $comparator = new DateComparator();

        $date1 = new \DateTime('now');
        $date2 = new \DateTime('yesterday');

        $this->assertEquals(1, $comparator->compare($date1, $date2));
    }

    public function testCompareTwoDatesWhereFirstDateIsEarlierReturnsMinusOne()
    {
        $comparator = new DateComparator();

        $date1 = new \DateTime('now');
        $date2 = new \DateTime('tomorrow');

        $this->assertEquals(-1, $comparator->compare($date1, $date2));
    }


}
 