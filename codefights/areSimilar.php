<?php
function areSimilar($a, $b)
{
    $count = count($a);
    if (count($b) !== $count) {
        return false;
    }

    $diffIndex = [];
    for ($i = 0; $i < $count; $i++) {
        if ($a[$i] !== $b[$i]) {
            $diffIndex[] = $i;
        }
    }

    $numberDiff = count($diffIndex);
    if ($numberDiff === 0) {
        return true;
    }
    if ($numberDiff > 2 || $numberDiff === 1) {
        return false;
    }
    $first = (int)$diffIndex[0];
    $second = (int)$diffIndex[1];
    $tmp = $b[$second];
    $b[$second] = $b[$first];
    $b[$first] = $tmp;

    return $a === $b;
}

$a = [1, 2, 3];
$b = [2, 1, 3];
var_dump(areSimilar($a, $b));