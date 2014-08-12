#Sorter
[![Latest Stable Version](https://poser.pugx.org/phpextra/sorter/v/stable.svg)](https://packagist.org/packages/phpextra/sorter)
[![Total Downloads](https://poser.pugx.org/phpextra/sorter/downloads.svg)](https://packagist.org/packages/phpextra/sorter)
[![License](https://poser.pugx.org/phpextra/sorter/license.svg)](https://packagist.org/packages/phpextra/sorter)
[![Build Status](http://img.shields.io/travis/phpextra/sorter.svg)](https://travis-ci.org/phpextra/sorter)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/phpextra/sorter/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/phpextra/sorter/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/phpextra/sorter/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/phpextra/sorter/?branch=master)
[![GitTip](http://img.shields.io/gittip/jkobus.svg)](https://www.gittip.com/jkobus)

## Usage

###Sorting out-of-the box using default settings

```php

$data = array('ccc', 'aaa', 'bbb');
$sorter = new PHPExtra\Sorter\Sorter();

$data = $sorter->setSortOrder(Sorter::ASC)->sort($data);

print_r($data); // returns array('aaa', 'bbb', 'ccc');

```
###Sort using a specific locale

Unicode comparator is the default comparator in this library and it uses default system locale (from php.ini) if it was not provided.
Changing system locale after creating a new instance of comparator will NOT change its locale.

```php

$strategy = new StringArraySortStrategy();
$strategy->setComparator(new UnicodeCIComparator('pl_PL'));

$sorter = new Sorter($strategy);

$sorter->sort(...);

```

###Sorting complex objects

```php

$data = array(
    (object)array('name' => 'Ann', 'position' => '3', 'rating' => '3'),
    (object)array('name' => 'Ann', 'position' => '2', 'rating' => '2'),
    (object)array('name' => 'Ann', 'position' => '2', 'rating' => '1'),
    (object)array('name' => 'Betty', 'position' => '1', 'rating' => '2'),
);

$strategy = new ObjectSortStrategy();
$strategy
    ->setSortOrder(Sorter::ASC)
    ->sortBy('position')    // sort by position
    ->sortBy('name')        // if position is equal sort by name
    ->sortBy(function($object){return $object->rating})      // if position and name are equal, use rating
;

$sorter = new PHPExtra\Sorter\Sorter();
$data = $sorter->setStrategy($strategy)->sort($data);

print_r($data);

// returns:
// array(
//     (object)array('name' => 'Betty', 'position' => '1', 'rating' => '2'),
//     (object)array('name' => 'Ann', 'position' => '2', 'rating' => '1'),
//     (object)array('name' => 'Ann', 'position' => '2', 'rating' => '2'),
//     (object)array('name' => 'Ann', 'position' => '3', 'rating' => '3'),
// )

```

**sortBy($accessor, $order, $comparator)** takes three arguments:

**$accessor** - that can be either a string or a closure that will extract value from an object.
If it's string strategy will try to access it like an array if possible, otherwise it will check if there is a public property with given name.

**$order** - int value; both (-1, 1) are available as constants in SorterInterface.

**ComparatorInterface $comparator** - comparator that will be used exclusively for that field.


###Customizing

You can create your own strategies for more complicated data sets.
Provided ObjectSortStrategy should cover most of your needs, and if it does not, try using your own Comparators.
You can replace default Comparators for a whole Strategy or define your own only for specific properties:

```php

$strategy
    ->setSortOrder(Sorter::ASC)
    ->sortBy('position')
    ->sortBy('name', Sorter::DESC, new MyOwnPropertyComparator())
    ->sortBy('rating')
;

// or ...

$strategy->setComparator(new MyOwnPropertyComparator());

```

## Installation (Composer)

```json
{
    "require": {
        "phpextra/sorter":"~1.0"
    }
}
```

##Running tests

```
// Windows
composer install & call ./vendor/bin/phpunit.bat ./tests
```

##Contributing

All code contributions must go through a pull request.  
Fork the project, create a feature branch, and send me a pull request.
To ensure a consistent code base, you should make sure the code follows
the [coding standards](http://symfony.com/doc/2.0/contributing/code/standards.html).
If you would like to help take a look at the [list of issues](https://github.com/phpextra/sorter/issues).

##Requirements

See **composer.json** for a full list of dependencies.

##Authors

This library was inspired by [https://github.com/graze/sort](https://github.com/graze/sort).

Jacek Kobus - <kobus.jacek@gmail.com>

## License information

    See the file LICENSE.txt for copying permission.

