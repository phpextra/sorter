<?php

namespace PHPExtra\Sorter\Comparator;

/**
 * Case-insensitive multibyte string comparison
 *
 * @see UnicodeComparator
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class UnicodeCIComparator extends UnicodeComparator
{
    /**
     * {@inheritdoc}
     */
    public function compare($a, $b)
    {
        return parent::compare($this->filter($a), $this->filter($b));
    }

    /**
     * @param string $value
     *
     * @return string
     */
    private function filter($value)
    {
        return mb_strtolower($value, 'UTF-8');
    }
}