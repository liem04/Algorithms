<?php

use Algorithms\Sorting\MinHeap;

require_once __DIR__ . '/../vendor/autoload.php';

$a = [45, 55, 22, 4, 6];
$minHeap = new MinHeap();
$minHeap->buildMixHeap($a, count($a));
array_shift($a);
var_dump($a);