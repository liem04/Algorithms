<?php
function boxBlur($image) {
    $numberRow = count($image);
    $numberCol = count($image[0]);
    $boxBlur = [];
    for ($i = 0; $i < $numberRow - 2 ; $i++) {
        for ($j = 0; $j < $numberCol - 2; $j++) {
            $boxBlur[$i][$j] = getAverage($image, $i, $j);
        }
    }

    return $boxBlur;
}

function getAverage($image, $i, $j) {
    $total = 0;
    for ($x = $i; $x < $i + 3; $x++) {
        for ($y = $j; $y < $j + 3; $y++) {
            $total += $image[$x][$y];
        }
    }

    return floor($total/9);
}

