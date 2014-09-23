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
     * @param ComparatorInterface $comparator
     *
     * @return $this
     */
    public function setComparator(ComparatorInterface $comparator);

    /**
     * Set default sort order for given strategy
     *
     * @param int $order
     *
     * @return $this
     */
    public function setSortOrder($order);

    /**
     * Set maintain key association option true or false
     *
     * @param bool $associative
     *
     * @return $this
     */
    public function setMaintainKeyAssociation($associative);
}