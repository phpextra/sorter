<?php

namespace PHPExtra\Sorter\Comparator;

/**
 * Case-sensitive multibyte string comparison
 * This comparator uses Collator object from INTL with Collator::NUMERIC_COLLATION flag set to TRUE.
 *
 * @see Collator::NUMERIC_COLLATION
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class UnicodeComparator implements ComparatorInterface
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
        $this->collator->setAttribute(\Collator::NUMERIC_COLLATION, \Collator::ON);
    }

    /**
     * Get locale used by collator
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->collator->getLocale(\Locale::VALID_LOCALE);
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
        return $value === null || is_string($value) || is_int($value) || is_float($value);
    }
}