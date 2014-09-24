<?php

namespace PHPExtra\Sorter;

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
     * @param array $collection
     *
     * @return array
     */
    public function sort(array $collection);
} 