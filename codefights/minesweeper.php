<?php
function minesweeper($matrix)
{
    $rowNumber = count($matrix);
    $colNumber = count($matrix[0]);
    $result = [];

    for ($i = 0; $i < $rowNumber; $i++) {
        for ($j = 0; $j < $colNumber; $j++) {
            $result[$i][$j] = getBomNumber($matrix, $i, $j);
        }
    }

    return $result;
}

function getBomNumber($matrix, $i, $j)
{
    $number = 0;
    for ($x = $i - 1; $x <= $i + 1; $x++) {
        for ($y = $j - 1; $y <= $j + 1; $y++) {
            if (($x !== $i || $y !== $j) && isset($matrix[$x][$y]) && $matrix[$x][$y]) {
                $number++;
            }
        }
    }

    return $number;
}

$matrix = [
    [true, false, false, true],
    [false, false, true, false],
    [true, true, false, true]
];

var_dump(minesweeper($matrix));