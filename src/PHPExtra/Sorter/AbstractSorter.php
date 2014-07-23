<?php

namespace PHPExtra\Sorter;

use PHPExtra\Sorter\Strategy\StrategyInterface;
use PHPExtra\Sorter\Strategy\StringArraySortStrategy;

/**
 * The AbstractSorterInterface class
 *
 * @author Jacek Kobus <kobus.jacek@gmail.com>
 */
abstract class AbstractSorter implements SorterInterface
{
    /**
     * @var StrategyInterface
     */
    private $strategy;

    /**
     * Create new sorter with given strategy
     * If no strategy given, default StringArraySortStrategy will be used
     *
     * @param StrategyInterface $strategy
     */
    function __construct(StrategyInterface $strategy = null)
    {
        if(!$strategy){
            $strategy = new StringArraySortStrategy();
        }

        $this->setStrategy($strategy);
    }

    /**
     * @param StrategyInterface $strategy
     *
     * @return $this
     */
    public function setStrategy($strategy)
    {
        $this->strategy = $strategy;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function sort(array $collection)
    {
        if(!$this->strategy){
            throw new \RuntimeException('Strategy was not defined');
        }
        return $this->strategy->sort($collection);
    }
}