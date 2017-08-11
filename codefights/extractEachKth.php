<?php
function extractEachKth($inputArray, $k) {
    $i = 1;
    $count = count($inputArray);
    while ($k * $i <= $count) {
        unset($inputArray[$k*$i-1]);
        $i++;
    }
    return array_values($inputArray);
}

$inputArray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$k = 3;

var_dump(extractEachKth($inputArray, $k));