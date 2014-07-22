<?php

namespace PHPExtra\Sorter;

use PHPExtra\Sorter\Comparator\ComparatorInterface;

/**
 * The SorterInterface interface
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
interface SorterInterface
{
    const ASC = 1;
    const DESC = -1;

    /**
     * Set default comparator for given sorter
     *
     * @param ComparatorInterface $strategy
     *
     * @return $this
     */
    public function setComparator(ComparatorInterface $strategy);

    /**
     * Add property that will be used for sorting
     *
     * @param string              $property   Property name or callable accessor
     * @param int                 $direction  Sort direction - ASC(1) or DESC(-1)
     * @param ComparatorInterface $comparator Exclusive comparator for given property
     *
     * @return $this
     */
    public function orderBy($property, $direction = SorterInterface::ASC, ComparatorInterface $comparator = null);

    /**
     * @param mixed $collection
     *
     * @return \Traversable
     */
    public function sort($collection);
} 