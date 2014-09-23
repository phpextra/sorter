<?php

/**
 * Copyright (c) 2013 Jacek Kobus <kobus.jacek@gmail.com>
 * See the file LICENSE.txt for copying permission.
 */
 
namespace PHPExtra\Sorter\Strategy;

use PHPExtra\Sorter\Comparator\ComparatorInterface;
use PHPExtra\Sorter\Comparator\UnicodeCIComparator;

/**
 * The ComplexSortStrategy class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class ComplexSortStrategy extends AbstractSortStrategy implements StrategyInterface
{
    /**
     * @var array
     */
    private $propertyMap = array();

    /**
     * @param ComparatorInterface $comparator
     */
    function __construct(ComparatorInterface $comparator = null)
    {
        if(!$comparator){
            $comparator = new UnicodeCIComparator();
        }
        parent::__construct($comparator);
    }

    /**
     * @param mixed               $accessor   Closure or object property name that returns value supported by comparator
     * @param int                 $order      Sort sortOrder
     * @param ComparatorInterface $comparator Exclusive comparator for given property
     *
     * @return $this
     */
    public function sortBy($accessor, $order = null, ComparatorInterface $comparator = null)
    {
        $this->propertyMap[] = array(
            'accessor' => $accessor,
            'direction' => $order === null ? $this->getSortOrder() : $order,
            'comparator' => $comparator === null ? $this->getComparator() : $comparator
        );

        return $this;
    }

    /**
     * Create a callback used in usort
     *
     * @return \Closure
     */
    protected function createSortTransformFunction()
    {
        $propertyMap = $this->propertyMap;
        $propertyExtractor = $this->getPropertyExtractor();
        $valueChecker = $this->getValueChecker();

        return function($a, $b) use ($propertyMap, $propertyExtractor, $valueChecker){

            foreach($propertyMap as $property){

                $valueA = $propertyExtractor($a, $property['accessor']);
                $valueB = $propertyExtractor($b, $property['accessor']);

                $cmp = $property['comparator'];
                /** @var $cmp ComparatorInterface */

                $valueChecker($valueA, $valueB, $cmp);
                $result = $cmp->compare($valueA, $valueB);

                if($result != 0){
                    return $result * $property['direction'];
                }
            }

            return 0;

        };
    }

    /**
     * Get callable used for extracting values from sortable entities (objects, arrays etc.)
     * This method extracts value from k, where k is an element of collection(i => k).
     * Accessor can be customized to add sorting ability to a complex objects.
     *
     * @return \Closure Takes two arguments, $property and $accessor
     */
    private function getPropertyExtractor()
    {
        return function($property, $accessor = null){

            if(is_string($property) || !$accessor){
                return $property;
            }

            if($accessor instanceof \Closure){
                return $accessor($property);
            }elseif(is_string($accessor)){

                if(is_array($property) || $property instanceof \ArrayAccess){
                    return $property[$accessor];
                }elseif(is_object($property) && property_exists($property, $accessor)){
                    return $property->$accessor;
                }
            }

            throw new \RuntimeException(sprintf('Unable to resolve property value: %s', gettype($property)));
        };
    }

    /**
     * {@inheritdoc}
     */
    public function sort(array $collection)
    {
        if(empty($this->propertyMap)){
            throw new \RuntimeException(sprintf('Missing sort properties - add them using sortBy(...)'));
        }

        return parent::sort($collection);
    }
}