<?php

require_once __DIR__ . '/vendor/autoload.php';

use PHPExtra\Sorter\Comparator\NaturalUnicodeComparator;
use PHPExtra\Sorter\Sorter;

$collection = array(
    array('name' => 'żdzisia', 'pos' => 10,    'plec' => 'm'),
    array('name' => 'ździsia', 'pos' => 10,    'plec' => 'm'),
    array('name' => 'Ździsia', 'pos' => 10,    'plec' => 'm'),
    array('name' => 'Żdzisia', 'pos' => 10,    'plec' => 'm'),
    array('name' => 'Żdzisia', 'pos' => 10,    'plec' => 'k'),
    array('name' => 'zdzisia', 'pos' => 10,    'plec' => 'm'),
    array('name' => 'śnia',    'pos' => 1,     'plec' => 'k'),
    array('name' => 'ąnia',    'pos' => 1,     'plec' => 'k'),
    array('name' => 'ania',    'pos' => 1,     'plec' => 'k'),
    array('name' => 'ania',    'pos' => 2,     'plec' => 'k'),
    array('name' => 'ania',    'pos' => 2,     'plec' => 'm'),
    array('name' => 'beata',   'pos' => 6,     'plec' => 'k'),
);

$sorter = new Sorter(new NaturalUnicodeComparator('pl_PL'));

$sorter
    ->orderBy('name', Sorter::ASC)
    ->orderBy('pos', Sorter::ASC)
    ->orderBy('plec', Sorter::ASC)
;

var_dump($sorter->sort($collection));
