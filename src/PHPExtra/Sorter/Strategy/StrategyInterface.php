<?php

namespace PHPExtra\Sorter\Strategy;

use PHPExtra\Sorter\Comparator\ComparatorInterface;
use PHPExtra\Sorter\SorterInterface;

/**
 * The StrategyInterface interface
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
interface StrategyInterface extends SorterInterface
{
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
}