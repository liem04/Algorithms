<?php
function stringsRearrangement($inputArray)
{
    foreach ($inputArray as $index => $item) {
        if (getDeepTree($inputArray, $item) == count($inputArray)) {
            return true;
        }
    }

    return false;
}

function getDeepTree($inputArray, $item)
{
    $nexts = getNext($inputArray, $item);
    if (count($nexts) === 0) {
        return 1;
    }
    $arr = $inputArray;
    $indexItem = array_search($item, $arr);
    unset($arr[$indexItem]);
    $maxdeep = 0;
    foreach ($nexts as $itemNext) {
        $deep = getDeepTree(array_values($arr), $itemNext);
        if ($deep > $maxdeep) {
            $maxdeep = $deep;
        }
    }
    return $maxdeep + 1;
}

function getNext($inputArray, $str)
{
    $nexts = [];
    foreach ($inputArray as $item) {
        if (hasDiffOneChar($str, $item)) {
            $nexts[] = $item;
        }
    }

    return $nexts;
}

function hasDiffOneChar($str1, $str2)
{
    $len = strlen($str1);
    $numberDiff = 0;
    for ($i = 0; $i < $len; $i++) {
        if ($str1[$i] !== $str2[$i]) {
            $numberDiff++;
        }
    }

    return $numberDiff === 1;
}

$inputArray = ["abc",
    "abx",
    "axx",
    "abx",
    "abc"];
var_dump(stringsRearrangement($inputArray));