<?php

function generateInput($n)
{
    $inputFile = fopen('input.txt', 'w') or die('Unable to open file!');
    fwrite($inputFile, $n . PHP_EOL);
    for ($i = 0; $i < $n; $i++) {
        fwrite($inputFile, random_int(1, $n / 2) . ' ');
    }
    fwrite($inputFile, PHP_EOL);
    for ($i = 0; $i < $n; $i++) {
        fwrite($inputFile, random_int(1, $n) . ' ');
    }
    fclose($inputFile);
}

generateInput(10);