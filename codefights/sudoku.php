<?php
function sudoku($grid)
{
    if (!isValidRows($grid)) {
        return false;
    }
    if (!isValidCols($grid)) {
        return false;
    }

    return isValidSub($grid);
}

function isValidRows($grid)
{
    foreach ($grid as $row) {
        if (!isValid($row)) {
            return false;
        }
    }
    return true;
}

function isValidCols($grid)
{
    for ($i = 0; $i < 9; $i++) {
        $row = [];
        for ($j = 0; $j < 9; $j++) {
            $row[] = $grid[$j][$i];
        }
        if (!isValid($row)) {
            return false;
        }
    }

    return true;
}

function isValidSub($grid)
{
    $i = 0;
    $j = 0;
    for ($i = 0; $i < 9; $i += 3) {
        for ($j = 0; $j < 9; $j += 3) {
            $row = [];
            for ($k = 0; $k < 3; $k++) {
                for ($l = 0; $l < 3; $l++) {
                    $row[] = $grid[$i + $k][$j + $l];
                }
            }
            if (!isValid($row)) {
                return false;
            }
        }
    }
    return true;
}

function isValid($row)
{
    sort($row);
    return $row === [1, 2, 3, 4, 5, 6, 7, 8, 9];
}

$grid = [[1, 3, 2, 5, 4, 6, 9, 8, 7],
    [4, 6, 5, 8, 7, 9, 3, 2, 1],
    [7, 9, 8, 2, 1, 3, 6, 5, 4],
    [9, 2, 1, 4, 3, 5, 8, 7, 6],
    [3, 5, 4, 7, 6, 8, 2, 1, 9],
    [6, 8, 7, 1, 9, 2, 5, 4, 3],
    [5, 7, 6, 9, 8, 1, 4, 3, 2],
    [2, 4, 3, 6, 5, 7, 1, 9, 8],
    [8, 1, 9, 3, 2, 4, 7, 6, 5]];
var_dump(sudoku($grid));