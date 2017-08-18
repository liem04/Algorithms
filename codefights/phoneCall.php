<?php
function phoneCall($min1, $min2_10, $min11, $s) {
    $cost = 0;
    $min = 0;
    while (true) {
        getCost($min, $min1, $min2_10, $min11, $cost);
        if ($cost < $s) {
            $min++;
        } elseif ($cost === $s){
            return $min;
        } else {
            return $min - 1;
        }
    }

    return $min;
}

function getCost($min, $min1, $min2_10, $min11, &$cost = 0) {
    if ($min === 1) {
        $cost = $min1;
    } elseif ($min >=2 && $min <=10) {
        $cost += $min2_10;
    } elseif ($min >= 11) {
        $cost += $min11;
    }
}

var_dump(phoneCall(3,1,2,20));
