#Sorter
[![Latest Stable Version](https://poser.pugx.org/phpextra/sorter/v/stable.svg)](https://packagist.org/packages/phpextra/sorter)
[![Total Downloads](https://poser.pugx.org/phpextra/sorter/downloads.svg)](https://packagist.org/packages/phpextra/sorter)
[![License](https://poser.pugx.org/phpextra/sorter/license.svg)](https://packagist.org/packages/phpextra/sorter)
[![Build Status](http://img.shields.io/travis/phpextra/sorter.svg)](https://travis-ci.org/phpextra/sorter)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/phpextra/sorter/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/phpextra/sorter/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/phpextra/sorter/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/phpextra/sorter/?branch=master)

1. [Installation](#installation)
2. [Usage](#usage)
    - [Sort using default settings](#sort-using-default-settings)
    - [Sort using a specific locale](#sort-using-a-specific-locale)
    - [Sorting arrays keeping the keys intact](#sorting-arrays-keeping-the-keys-intact)
    - [Sorting complex objects](#sorting-complex-objects)
    - [Customizing](#customizing)
3. [Contributing](#contributing)
4. [Authors](#authors)

##Installation

Installation is done using [Composer](https://getcomposer.org/):

    composer require phpextra/sorter

You can test the library using `phpunit` by running the following command (assuming that you have `phpunit` command available):

    phpunit ./tests


## Usage

###Sort using default settings

```php
use PHPExtra\Sorter\Sorter;

$data = array('ccc', 'aaa', 'bbb');
$sorter = new Sorter();
$data = $sorter->sort($data);
print_r($data); // prints array('aaa', 'bbb', 'ccc');
```
###Sort using a specific locale

`UnicodeCIComparator` (case-insensitive) comparator is the **default comparator** used in this library and by default during creation it uses current system locale (from php.ini).

> It's worth to notice that when using this comparator, it may produce **odd-looking results for numbers**. For example `-1000` is greater than `-100`.
> If you want to compare numbers by their real value, use `NumericComparator`.

```php

use PHPExtra\Sorter\Sorter;
use PHPExtra\Sorter\Strategy\SimpleSortStrategy;
use PHPExtra\Sorter\Comparator\UnicodeCIComparator;

$strategy = new SimpleSortStrategy();
$strategy->setComparator(new UnicodeCIComparator('pl_PL'));
$sorter = new Sorter($strategy);
$sorter->sort(...);

```

###Sorting arrays keeping the keys intact

```php

use PHPExtra\Sorter\Sorter;
use PHPExtra\Sorter\Strategy\SimpleSortStrategy;
use PHPExtra\Sorter\Comparator\UnicodeCIComparator;

$array = array(0 => 'a', 1 => 'c', 2 => 'b');

$strategy = new SimpleSortStrategy();
$strategy->setMaintainKeyAssociation(true);

$sorter = new Sorter($strategy);
$sorter->sort($array);

print_r($array); // prints array(0 => 'a', 2 => 'b', 1 => 'c')
```

###Sorting complex objects

```php

use PHPExtra\Sorter\Sorter;
use PHPExtra\Sorter\Strategy\ComplexSortStrategy;

$data = array(
    (object)array('name' => 'Ann', 'position' => '3', 'rating' => '3'),
    (object)array('name' => 'Ann', 'position' => '2', 'rating' => '2'),
    (object)array('name' => 'Ann', 'position' => '2', 'rating' => '1'),
    (object)array('name' => 'Betty', 'position' => '1', 'rating' => '2'),
);

$strategy = new ComplexSortStrategy();
$strategy
    ->setSortOrder(Sorter::ASC)
    ->sortBy('position')                                    // sort by position
    ->sortBy('name')                                        // sort by name if position is equal
    ->sortBy(function($object){return $object->rating})     // sort by rating if name is equal
;

$sorter = new PHPExtra\Sorter\Sorter();
$data = $sorter->setStrategy($strategy)->sort($data);

print_r($data);

//    prints:
//
//    Array
//    (
//        [0] => stdClass Object
//        (
//            [name] => Betty
//            [position] => 1
//            [rating] => 2
//        )
//
//        [1] => stdClass Object
//        (
//            [name] => Ann
//            [position] => 2
//            [rating] => 1
//        )
//
//        [2] => stdClass Object
//        (
//            [name] => Ann
//            [position] => 2
//            [rating] => 2
//        )
//
//        [3] => stdClass Object
//        (
//            [name] => Ann
//            [position] => 3
//            [rating] => 3
//        )
//    )

```

###Customizing

You can create your own strategies for more complicated data sets.
Provided `ComplexSortStrategy` should cover most of your needs, and if it does not, try using your own comparators.
You can replace default comparators for a whole strategy or define your own only for specific properties:

```php

$strategy
    ->setSortOrder(Sorter::ASC)
    ->sortBy('position')
    ->sortBy('name', Sorter::DESC, new MyOwnPropertyComparator())
    ->sortBy('rating')
;

// or set your own comparator

$strategy->setComparator(new MyOwnPropertyComparator());

```
##Contributing

All code contributions must go through a pull request.  
Fork the project, create a feature branch, and send me a pull request.

##Authors

This library was inspired by [https://github.com/graze/sort](https://github.com/graze/sort).

Jacek Kobus - <kobus.jacek@gmail.com>

