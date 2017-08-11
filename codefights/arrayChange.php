<?php
function arrayChange($inputArray) {
    $count = count($inputArray);
    $i = 1;
    $needAdd = 0;
    $prev = $inputArray[0];
    while ($i < $count) {
        $item = $inputArray[$i];
        if ($item <= $prev) {
            $needAdd += $prev - $item + 1;
            $prev = $prev + 1;
        } else {
            $prev = $item;
        }
        $i++;
    }
    return $needAdd;
}
$a = [1, 1, 1];
var_dump(arrayChange($a));