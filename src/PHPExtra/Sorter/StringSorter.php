<?php

namespace PHPExtra\Sorter;

use PHPExtra\Sorter\Comparator\ComparatorInterface;
use PHPExtra\Sorter\Comparator\UnicodeCIComparator;

/**
 * Case-insensitive string collection sorter
 * By default it uses UnicodeCIComparator with default locale from php.ini
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class StringSorter extends AbstractSorterInterface
{
    /**
     * @param ComparatorInterface $comparator
     */
    function __construct(ComparatorInterface $comparator = null)
    {
        parent::__construct(new UnicodeCIComparator());
    }
}