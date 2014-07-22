<?php

namespace PHPExtra\Sorter\Comparator;

/**
 * Compare as strings with support for unicode characters
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class NaturalUnicodeComparator implements ComparatorInterface
{
    /**
     * @var \Collator
     */
    private $collator;

    /**
     * @param string $locale
     */
    function __construct($locale = null)
    {
        if(!$locale){
            $locale = \Locale::getDefault();
        }
        $this->collator = new \Collator($locale);
    }

    /**
     * {@inheritdoc}
     */
    public function compare($a, $b)
    {
        // result can be false in case of an error - lets pretend that those strings are equal for now
        $result = $this->collator->compare($a, $b);
        return $result !== false ? $result : 0;
    }
}