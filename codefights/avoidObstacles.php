<?php
function avoidObstacles($inputArray) {
    sort($inputArray);
    $count = count($inputArray);
    $max = $inputArray[$count-1];
    $step = 2;
    $value = 0;
    $index = 0;
    while ($step <= $max && $index < $count) {
        $value += $step;
        if (in_array($value, $inputArray, true)) {
            $step++;
            $index = 0;
            $value = 0;
            continue;
        }
        $index++;
    }

    return $step;
}

$a = [2,5,8,9];
var_dump(avoidObstacles($a));
