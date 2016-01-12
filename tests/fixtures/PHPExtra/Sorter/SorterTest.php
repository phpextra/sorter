<?php

namespace fixtures\PHPExtra\Sorter;

use PHPExtra\Sorter\Sorter;
use PHPExtra\Sorter\Strategy\ComplexSortStrategy;
use PHPExtra\Sorter\Strategy\SimpleSortStrategy;
use PHPUnit_Framework_TestCase;

/**
 * The SorterTest class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class SorterTest extends PHPUnit_Framework_TestCase 
{
    public function testCreateNewSorterInstanceWithDefaultStrategy()
    {
        new Sorter();
    }

    public function testCreateNewSorterInstanceWithCustomStrategy()
    {
        new Sorter(new ComplexSortStrategy());
    }

    public function testSortAnArrayOfStringsUsingDefaultSorter()
    {
        $expected = array('20', '1020', 'abc', 'bcd', 'cdb');
        $sortable = array('bcd', 'cdb', '20', 'abc', '1020');

        $sorter = new Sorter();
        $sorted = $sorter->sort($sortable);

        $this->assertEquals($expected, $sorted);
    }

    public function testSortAnArrayOfStringsUsingDefaultSorterInReverseOrder()
    {
        $expected = array('e', 'd', 'c', 'b', 'a');
        $sortable = array('a', 'c', 'b', 'e', 'd');

        $sorter = new Sorter();
        $sorter->setSortOrder(Sorter::DESC);
        $sorted = $sorter->sort($sortable);

        $this->assertEquals($expected, $sorted);
    }
    
    public function testSortAnArrayOfStringsUsingDefaultSorterMaintainingKeyAssociation()
    {
        $expected = array('k' => '20', -10 => '1020', 194 => 'abc', 10 => 'bcd', 0 => 'cdb');
        $sortable = array(10 => 'bcd', 0 => 'cdb', 'k' => '20', 194 => 'abc', -10 => '1020');

        $sorter = new Sorter();
        $strategy = new SimpleSortStrategy();
        $strategy->setMaintainKeyAssociation(true);
        $sorter->setStrategy($strategy);
        $sorted = $sorter->sort($sortable);

        $this->assertEquals($expected, $sorted);
    }

    public function testSetCustomStrategyAfterObjectCreation()
    {
        $sorter = new Sorter();
        $sorter->setStrategy(new ComplexSortStrategy());
    }
}
 