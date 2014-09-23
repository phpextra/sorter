<?php

namespace PHPExtra\Sorter;

/**
 * Any object that supports Sorter should implement this interface.
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
interface SortableInterface
{
    /**
     * Sort object using given sorter
     *
     * @param SorterInterface $sorter
     *
     * @return $this
     */
    public function sort(SorterInterface $sorter);
} 