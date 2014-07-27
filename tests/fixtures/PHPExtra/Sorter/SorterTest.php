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
    public function testCreateNewSorterInstanceWithDefaultStrategy()
    {
        new Sorter();
    }

    public function testCreateNewSorterInstanceWithCustomStrategy()
    {
        $sorter = new Sorter(new ObjectSortStrategy());
    }

    public function testSortAnArrayOfStringsUsingDefaultSorter()
    {
        $expected = array('20', '1020', 'abc', 'bcd', 'cdb');
        $sortable = array('bcd', 'cdb', '20', 'abc', '1020');

        $sorter = new Sorter();
        $sorted = $sorter->sort($sortable);

        $this->assertEquals($expected, $sorted);
    }

    public function testSetCustomStrategyAfterObjectCreation()
    {
        $sorter = new Sorter();
        $sorter->setStrategy(new ObjectSortStrategy());
    }

}
 