<?php
require_once 'Select.php';
$a = [54, 100, 122, 7, 33, 66, 77, 10, 3, 8, 53, 2, 11, 13, 52, 55, 1, 55, 33];
$select = new Select(new InsertionSort());
$x = $select->solve($a, 0, count($a) - 1, 4);
echo implode(' ', $a) . PHP_EOL;
var_dump($x);