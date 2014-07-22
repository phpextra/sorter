<?php

namespace fixtures\PHPExtra\Sorter;

use PHPExtra\Sorter\Sorter;

/**
 * The SorterTest class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class SorterTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreateNewSorterInstanceWithoutLocale()
    {
        $sorter = new Sorter();
    }

    public function testCreateNewSorterInstanceWithLocale()
    {
        $sorter = new Sorter('pl_PL');
        $this->assertEquals('pl_PL', $sorter->getLocale());
    }

    public function testSortSimpleArrayReturnsSortedArray()
    {

    }
}
 