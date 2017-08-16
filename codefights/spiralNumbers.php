<?php
function spiralNumbers($n) {
    $result = [];
    $i = 1;
    $row = 0;
    $col = 0;
    $direction = 'right';
    while ($i <= $n * $n) {
        $result[$row][$col] = $i;
        $i++;
        getNext($result, $row, $col, $direction ,$n);
    }
    foreach ($result as &$rows) {
        ksort($rows);
    }
    return $result;
}

function getNext($result, &$row, &$col, &$direction, $n) {
    switch ($direction) {
        case 'right':
            if ($col + 1 < $n && !isset($result[$row][$col + 1])) {
                $col++;
            } else {
                $row++;
                $direction = 'bottom';
            }
            break;
        case 'bottom':
            if ($row + 1 < $n && !isset($result[$row + 1][$col])) {
                $row++;
            } else {
                $col--;
                $direction = 'left';
            }
            break;
        case 'left':
            if ($col - 1 >= 0 && !isset($result[$row][$col - 1])) {
                $col--;
            } else {
                $row--;
                $direction = 'up';
            }
            break;
        case 'up':
            if ($row - 1 >= 0 && !isset($result[$row - 1][$col])) {
                $row--;
            } else {
                $col++;
                $direction = 'right';
            }
            break;
    }
}

var_dump(spiralNumbers(4));