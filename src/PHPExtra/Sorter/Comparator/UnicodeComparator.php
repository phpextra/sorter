<?php

namespace PHPExtra\Sorter\Comparator;

/**
 * Case-sensitive multibyte string comparison
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class UnicodeComparatorInterface implements ComparatorInterface
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
        //@todo result can be false in case of an error - lets pretend that those strings are equal for now
        $result = $this->collator->compare($a, $b);
        return $result !== false ? $result : 0;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($value)
    {
        return is_string($value) || (is_object($value));
    }
}