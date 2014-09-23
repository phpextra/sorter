<?php

namespace PHPExtra\Sorter\Strategy;

/**
 * Case-insensitive object collection sorter
 * By default it uses UnicodeCIComparator with default locale from php.ini
 *
 * @deprecated use ComplexSortStrategy instead.
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class ObjectSortStrategy extends ComplexSortStrategy
{
}
