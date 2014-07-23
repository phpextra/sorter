<?php

namespace PHPExtra\Sorter\Strategy;

use PHPExtra\Sorter\Comparator\ComparatorInterface;
use PHPExtra\Sorter\Comparator\UnicodeCIComparator;

/**
 * Case-insensitive object collection sorter
 * By default it uses UnicodeCIComparator with default locale from php.ini
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
class ObjectSortStrategy extends AbstractStrategy
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
    private function createSortTransformFunction()
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

                $valueChecker($a, $b, $cmp);
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
     * This method extracts value of k, where k is an element of collection(i => k).
     * Accessor can be customized to add sorting ability to a complex objects.
     *
     * @return \Closure Takes two arguments, $property and $accessor
     */
    private function getPropertyExtractor()
    {
        return function($property, $accessor = null){

            if(is_string($property)){
                return $property;
            }

            if($accessor instanceof \Closure){
                $value = $accessor($property);
            }elseif(is_string($accessor)){

                if(is_array($property) || $property instanceof \ArrayAccess){
                    $value = $property[$accessor];
                }elseif(is_object($property) && property_exists($property, $accessor)){
                    $value = $property->$accessor;
                }
            }

            if(!isset($value)){
                throw new \RuntimeException(sprintf('Unable to resolve property value: %s', gettype($property)));
            }

            return $value;

        };
    }

    /**
     * {@inheritdoc}
     */
    public function sort(array $collection)
    {
        if(empty($this->propertyMap)){
            throw new \RuntimeException(sprintf('Missing sort properties - add them using orderBy(...)'));
        }

        usort($collection, $this->createSortTransformFunction());
        return $collection;
    }


}