<?php

namespace PHPExtra\Sorter;

use PHPExtra\Type\Collection\CollectionInterface;

/**
 * The CollectionSorter class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class CollectionSorter extends ObjectSorter
{
    public function sort($collection)
    {
        if($collection instanceof CollectionInterface){
            $collection->sort($this); // visitor
            return $collection;
        }

        throw new \RuntimeException('SorterInterface supports only collections');
    }

} 