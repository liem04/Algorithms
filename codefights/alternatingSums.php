<?php
function alternatingSums($a) {
    $count = count($a);
    $sum1 = 0;
    $sum2 = 0;
    for ($i = 0; $i< $count; $i++) {
        if ($i % 2 === 0) {
            $sum1 += $a[$i];
        } else {
            $sum2 += $a[$i];
        }
    }

    return [$sum1, $sum2];
}

$a = [50, 60, 60, 45, 70];
var_dump(alternatingSums($a));