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
    /**
     * Sort ascending
     */
    const ASC = 1;

    /**
     * Sort descending
     */
    const DESC = -1;

    /**
     * Set default comparator
     *
     * @param ComparatorInterface $strategy
     *
     * @return $this
     */
    public function setComparator(ComparatorInterface $strategy);

    /**
     * Set default sort sortOrder
     *
     * @param int $order
     *
     * @return $this
     */
    public function setSortOrder($order);

    /**
     * @param array|mixed[] $collection
     *
     * @return array|mixed[]
     */
    public function sort(array $collection);
} 