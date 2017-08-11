<?php
function palindromeRearranging($inputString) {
    $arr = [];
    $strLen = strlen($inputString);
    for ($i = 0; $i < $strLen; $i++) {
        $char = $inputString[$i];
        if (!in_array($char, $arr, true)) {
            $arr[] = $inputString[$i];
        } else {
            $index = array_search($char, $arr);
            unset($arr[$index]);
        }
    }
    return count($arr) <= 1;
}

$str = 'aabbcd';
var_dump(palindromeRearranging($str));