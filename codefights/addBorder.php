<?php
function addBorder($picture) {
    $result = [];
    $result[] = str_repeat('*', strlen($picture[0]) + 2);
    $rowNumber = count($picture);
    for($i = 0; $i < $rowNumber; $i++) {
        $result[] = '*' . $picture[$i] . '*';
    }
    $result[] = str_repeat('*', strlen($picture[$rowNumber-1]) + 2);

    return $result;
}
$picture = ["abc", "ded"];
var_dump(addBorder($picture));