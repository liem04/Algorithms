<?php
function messageFromBinaryCode($code) {
    $len = strlen($code);
    $messages = [];
    for ($i = 0; $i < $len; $i += 8) {
        $charBinary = substr($code, $i, 8);
        $messages[] = decode($charBinary);
    }

    return implode('', $messages);
}

function decode($charBinary) {
    return chr(bindec($charBinary));
}

$code = '01001101011000010111100100100000011101000110100001100101001000000100011001101111011100100110001101100101001000000110001001100101001000000111011101101001011101000110100000100000011110010110111101110101';
var_dump(messageFromBinaryCode(($code)));
