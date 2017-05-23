<?php

use Algorithms\Sorting\InsertionSort;
use Algorithms\Sorting\Select;

require_once __DIR__ . '/../vendor/autoload.php';

$a = [2, 6, 3, 7, 9, 8, 1, 4, 5, 10];
$k = 6;
$select = new Select(new InsertionSort());
$x = $select->solve($a, 0, count($a) - 1, $k);
var_dump($x);
