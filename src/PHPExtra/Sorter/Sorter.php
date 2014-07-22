<?php

namespace PHPExtra\Sorter;
use PHPExtra\Sorter\Comparator\ComparatorInterface;

/**
 * The Sorter class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class Sorter implements SorterInterface
{
    /**
     * @var SorterInterface
     */
    private $comparator;

    /**
     * @var array
     */
    private $propertyMap = array();

    /**
     * @param ComparatorInterface $defaultComparator
     */
    function __construct(ComparatorInterface $defaultComparator = null)
    {
        if($defaultComparator !== null){
            $this->setComparator($defaultComparator);
        }
    }

    /**
     * @param ComparatorInterface $comparator
     *
     * @return $this
     */
    public function setComparator(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;

        return $this;
    }

    /**
     * @return ComparatorInterface
     */
    public function getComparator()
    {
        return $this->comparator;
    }

    /**
     * {@inheritdoc}
     */
    public function orderBy($property, $direction = SorterInterface::ASC, ComparatorInterface $comparator = null)
    {
        $this->propertyMap[] = array(
            'accessor'      => $property,
            'direction'     => $direction,
            'comparator'    => $comparator === null ? $this->comparator : $comparator
        );
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function sort($collection)
    {
        if(!is_array($collection) && !$collection instanceof \Traversable){
            throw new \RuntimeException(sprintf('Object of type %s is not supported', gettype($collection)));
        }

        usort($collection, $this->createSortTransformFunction());
        return $collection;
    }

    private function createSortTransformFunction()
    {
        $propertyMap = $this->propertyMap;
        return function($a, $b) use ($propertyMap){

            foreach($propertyMap as $property){
                $valueA = $a[$property['accessor']];
                $valueB = $b[$property['accessor']];

                $cmp = $property['comparator'];
                /** @var $cmp ComparatorInterface */

                $result = $cmp->compare($valueA, $valueB);

                if($result != 0){
                    return $result * $property['direction'];
                }
            }

            return 0;

        };
    }
}