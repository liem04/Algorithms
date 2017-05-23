<?php

use Algorithms\KMin\Reader\FileReader;
use Algorithms\KMin\UsingHeapSort;
use Algorithms\KMin\UsingMinHeap;
use Algorithms\KMin\UsingRandomizedSelect;
use Algorithms\KMin\UsingSelect;

require_once __DIR__ . '/../vendor/autoload.php';

$fileReader = new FileReader();
list($a, $k) = $fileReader->read(__DIR__ . '/input.txt');

//Using MinHeap
$timeStart = microtime(true);
$usingMinHeap = new UsingMinHeap();
$kmin = $usingMinHeap->solve($a, $k);
$timeEnd = microtime(true);
echo 'Using MinHeap:            ';
dispayArray($kmin, $timeEnd - $timeStart);

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
