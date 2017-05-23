<?php

use Algorithms\KMin\Reader\FileReader;
use Algorithms\KMin\UsingHeapSort;
use Algorithms\KMin\UsingRandomizedSelect;
use Algorithms\KMin\UsingSelect;

require_once __DIR__ . '/../vendor/autoload.php';

$fileReader = new FileReader();
list($a, $k) = $fileReader->read(__DIR__ . '/input.txt');
//$a = [3, 4, 2, 5, 7, 9, 4, 8, 0, 5, 3, 4, 5, 6, 8, 9, 3, 2, 33, 34, 34, 122, 42, 522, 42, 42, 23, 45, 23, 55, 22, 55, 233, 52, 32];
//$k = count($a);
//Using HeapSort
$timeStart = microtime(true);
$usingHeapSort = new UsingHeapSort();
$kmin = $usingHeapSort->solve($a, $k);
$timeEnd = microtime(true);
echo 'Using HeapSort:           ';
dispayArray($kmin, $timeEnd - $timeStart);

//Using RandomizedSelect
$timeStart = microtime(true);
$usingRandomizedSelect = new UsingRandomizedSelect();
$kmin = $usingRandomizedSelect->solve($a, $k);
$timeEnd = microtime(true);
echo 'Using RandomizedSelect:   ';
dispayArray($kmin, $timeEnd - $timeStart);

//Using Select
$timeStart = microtime(true);
$usingSelect = new UsingSelect();
$kmin = $usingSelect->solve($a, $k);
$timeEnd = microtime(true);
echo 'Using Select:             ';
dispayArray($kmin, $timeEnd - $timeStart);

function dispayArray(array $a, $time)
{
    echo implode(' ', $a) . ' ' . $time . PHP_EOL;
}
