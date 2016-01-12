<?php

namespace fixtures\PHPExtra\Sorter\Strategy;

use PHPExtra\Sorter\Sorter;
use PHPExtra\Sorter\Strategy\ComplexSortStrategy;

/**
 * The ObjectSortStrategyTest class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class ObjectSortStrategyTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * @return array
     */
    public function dataProvider()
    {
        return array(
            array(
            // ---

                array(
                    (object)array('name' => 'Betty', 'position' => '1', 'rating' => '2'),
                    (object)array('name' => 'Ann', 'position' => '2', 'rating' => '1'),
                    (object)array('name' => 'Ann', 'position' => '2', 'rating' => '2'),
                    (object)array('name' => 'Ann', 'position' => '3', 'rating' => '3'),
                ),

                // unsorted
                array(
                    (object)array('name' => 'Ann', 'position' => '3', 'rating' => '3'),
                    (object)array('name' => 'Ann', 'position' => '2', 'rating' => '2'),
                    (object)array('name' => 'Ann', 'position' => '2', 'rating' => '1'),
                    (object)array('name' => 'Betty', 'position' => '1', 'rating' => '2'),
                )
            )

            // ---

        );
    }

    /**
     * @dataProvider dataProvider
     *
     * @param array $expected
     * @param array $unsorted
     *
     * @internal     param array $data
     */
    public function testSortComplexDataSet(array $expected, array $unsorted)
    {

        $strategy = new ComplexSortStrategy();
        $strategy
            ->setSortOrder(Sorter::ASC)
            ->sortBy('position')
            ->sortBy('name')
            ->sortBy('rating')
        ;

        $this->assertEquals($expected, $strategy->sort($unsorted));
    }
}
 