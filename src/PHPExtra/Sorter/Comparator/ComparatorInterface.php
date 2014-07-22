<?php

namespace PHPExtra\Sorter\Comparator;

/**
 * The ComparatorInterface interface
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
interface ComparatorInterface
{
    /**
     * Compare a to b
     * Returns -1 if a < b, 0 if a = b and 1 if a > b
     *
     * @param mixed $a
     * @param mixed $b
     *
     * @return int
     */
    public function compare($a, $b);

    /**
     * Tell if current ComparatorInterface supports given value
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function supports($value);
}