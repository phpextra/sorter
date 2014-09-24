<?php

namespace PHPExtra\Sorter\Comparator;

/**
 * Compare dates (\DateTime)
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class DateTimeComparator implements ComparatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function compare($a, $b)
    {
        if ($a > $b) {
            return 1;
        } elseif ($a < $b) {
            return -1;
        }

        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($value)
    {
        return $value instanceof \DateTime;
    }
}