<?php
use Algorithms\KMin\Reader\FileReader;
use Algorithms\Sorting\InsertionSort;
use Algorithms\Sorting\Select;

require_once __DIR__ . '/../vendor/autoload.php';

$fileReader = new FileReader();
list($a, $k) = $fileReader->read(__DIR__ . '/input.txt');
//$a = [3, 4, 2, 5, 7, 9, 4, 8, 0, 5, 3, 4, 5, 6, 8, 9, 3, 2, 33, 34, 34, 122, 42, 522, 42, 42, 23, 45, 23, 55, 22, 55, 233, 52, 32];
//$k = 2;
$select = new Select(new InsertionSort());
echo $select->solve($a, 0, count($a) - 1, $k);
