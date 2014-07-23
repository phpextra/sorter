<?php

namespace fixtures\PHPExtra\Sorter;

use PHPExtra\Sorter\Sorter;
use PHPExtra\Sorter\Strategy\ObjectSortStrategy;


/**
 * The SorterTest class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class SorterTest extends \PHPUnit_Framework_TestCase 
{
    public function testCreateNewSorterInstance()
    {
        $sorter = new Sorter();
    }

    public function testCreateNewSorterInstanceWithCustomStrategy()
    {
        $sorter = new Sorter(new ObjectSortStrategy());
    }

}
 