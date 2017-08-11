<?php
function absoluteValuesSumMinimization($a) {
    $min = 10e5;
    $result = null;
    foreach ($a as $item) {
        $value = getAbs($a, $item);
        if ($value < $min) {
            $min = $value;
            $result = $item;
        }
    }

    return $result;
}

function getAbs($a, $item){
    $total = 0;
    foreach ($a as $element) {
        $total += abs($element - $item);
    }

    return $total;
}
