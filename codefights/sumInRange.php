<?php
function sumInRange($nums, $queries) {
    $sum = 0;
    $prefixSums = getPrefixSums($nums);
    foreach ($queries as $query) {
        $end = $query[1];
        $start = $query[0];
        if ($start === 0) {
            $sum += $prefixSums[$end];
        } else {
            $sum += $prefixSums[$end] - $prefixSums[$start - 1];
        }
    }

    $m = 1e9 + 7 + $sum;
    return ($sum % $m + $m) % $m;
}

function getPrefixSums($nums)
{
    $prefixSums = [];
    $prev = 0;
    foreach ($nums as $i => $num) {
        $prefixSums[$i] = $num + $prev;
        $prev = $prefixSums[$i];
    }
    return $prefixSums;
}