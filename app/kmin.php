<?php

use Algorithms\KMin\Reader\FileReader;
use Algorithms\KMin\UsingHeapSort;
use Algorithms\KMin\UsingMinHeap;
use Algorithms\KMin\UsingRandomizedSelect;
use Algorithms\KMin\UsingSelect;

require_once __DIR__ . '/../vendor/autoload.php';

$fileReader = new FileReader();
list($a, $k) = $fileReader->read(__DIR__ . '/input.txt');

$methods = [
    'MinHeap         ' => new UsingMinHeap(),
    'HeapSort        ' => new UsingHeapSort(),
    'RandomizedSelect' => new UsingRandomizedSelect(),
    'Select          ' => new UsingSelect()
];
foreach ($methods as $name => $method) {
    //Using MinHeap
    $timeStart = microtime(true);
    $kmin = $method->solve($a, $k);
    $timeEnd = microtime(true);
    echo $name . ': ' . implode(' ', $kmin) . ' ' . ($timeEnd - $timeStart) . PHP_EOL;
}