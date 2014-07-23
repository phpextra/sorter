<?php

namespace PHPExtra\Sorter\Strategy;

use PHPExtra\Sorter\Comparator\ComparatorInterface;
use PHPExtra\Sorter\Comparator\UnicodeCIComparator;
use PHPExtra\Sorter\SorterInterface;

/**
 * The AbstractSorterInterface class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
abstract class AbstractStrategy implements StrategyInterface
{
    /**
     * @var int
     */
    private $sortOrder = self::ASC;

    /**
     * @var SorterInterface
     */
    private $comparator;

    /**
     * @param int                $sortOrder Default sort order
     * @param ComparatorInterface $comparator Default comparator
     *
     * @internal param int $defaultOrder
     */
    function __construct(ComparatorInterface $comparator = null, $sortOrder = null)
    {
        if($sortOrder){
            $this->setSortOrder($sortOrder);
        }

        if(!$comparator){
            $comparator = new UnicodeCIComparator();
        }
        $this->setComparator($comparator);
    }

    /**
     * {@inheritdoc}
     */
    public function setComparator(ComparatorInterface $comparator)
    {
        $this->comparator = $comparator;

        return $this;
    }

    /**
     * @return SorterInterface
     */
    protected function getComparator()
    {
        return $this->comparator;
    }

    /**
     * {@inheritdoc}
     */
    public function setSortOrder($order)
    {
        $this->sortOrder = $order;
        return $this;
    }

    /**
     * @return int
     */
    protected function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * {@inheritdoc}
     */
    public function sort(array $collection)
    {
        $comparator = $this->getComparator();
        $checker = $this->getValueChecker();

        usort($collection, function($a, $b) use ($comparator, $checker){
            /** @var ComparatorInterface $comparator */
            $checker($a, $b, $comparator);
            return $comparator->compare($a, $b);
        });
        return $collection;
    }

    /**
     * Returns a closure that validates values before passing them to the ComparatorInterface
     *
     * @return \Closure
     */
    protected function getValueChecker()
    {
        return function($a, $b, ComparatorInterface $comparator){

            $exceptionMessage = 'Comparator (%s) does not support "%s"';

            if(!$comparator->supports($a)){
                throw new \RuntimeException(sprintf($exceptionMessage, get_class($comparator), gettype($a)));
            }

            if(!$comparator->supports($b)){
                throw new \RuntimeException(sprintf($exceptionMessage, get_class($comparator), gettype($a)));
            }
        };
    }
}