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
        $this->propertyMap[$property] = array(
            'direction' => $direction,
            'comparator' => $comparator
        );
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function sort($collection)
    {
        if(is_array($collection) || $collection instanceof \Traversable){






        }else{
            throw new \RuntimeException(sprintf('Object of type %s is not supported', gettype($collection)));
        }
    }
}