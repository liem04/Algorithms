<?php

function generateInput($n, $k)
{
    $inputFile = fopen('input.txt', 'w') or die('Unable to open file!');
    fwrite($inputFile, $n . ' ' . $k . PHP_EOL);
    for ($i = 0; $i < $n; $i++) {
        fwrite($inputFile, random_int(1, $n) . ' ');
    }
    fclose($inputFile);
}

generateInput(10000, 15);