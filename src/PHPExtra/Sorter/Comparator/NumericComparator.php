<?php

namespace PHPExtra\Sorter\Comparator;

/**
 * Compare numbers. Uses BCMath's bccomp function. Default scale is set to 10.
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class NumericComparator implements ComparatorInterface
{
    /**
     * @var int
     */
    private $scale;

    /**
     * @param int $scale
     */
    function __construct($scale = 10)
    {
        $this->scale = $scale;
    }

    /**
     * {@inheritdoc}
     */
    public function compare($a, $b)
    {
        return bccomp((string)$a, (string)$b, $this->scale);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($value)
    {
        return is_numeric($value) || is_int($value) || is_float($value);
    }
}