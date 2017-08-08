<?php

function check(array $data)
{
    $result = [];
    $candidates = getAllCandidate($data);
    $n = count($candidates);
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            for ($k = 0; $k < $n; $k++) {
                $candidate = [$candidates[$i], $candidates[$j], $candidates[$k]];
                if (isValid($candidate, $data)) {
                    $result[] = $candidate;
                }
            }
        }
    }

    return $result;
}

function isValid(array $candidate, array $data)
{
    foreach ($data as $item) {
        if (!isValidItem($candidate, $item)) {
            return false;
        }
    }
    return true;
}

function isValidItem(array $candidate, array $item)
{
    $elements = $item[0];
    $numberCorrect = $item[1][0];
    $orderCorrect = $item[1][1];

    $realNumberCorrect = getRealNumberCorrect($candidate, $elements);
    $realOrderCorrect = checkOrderCorrect($candidate, $elements);

    return ($realNumberCorrect == $numberCorrect) && ($realOrderCorrect === $orderCorrect);
}

function getRealNumberCorrect(array $candidate, array $elements)
{
    $numberCorrect = 0;
    for ($i = 0; $i < 3; $i++) {
        if (in_array($candidate[$i], $elements)) {
            $numberCorrect++;
        }
    }

    return $numberCorrect;
}

function checkOrderCorrect(array $candidate, array $elements)
{
    return $candidate[0] === $elements[0] || $candidate[1] === $elements[1] || $candidate[2] === $elements[2];
}

function getAllCandidate(array $data)
{
    $candidates = [];
    foreach ($data as $item) {
        foreach ($item[0] as $candidate) {
            if (!in_array($candidate, $candidates)) {
                $candidates[] = $candidate;
            }
        }
    }
    return $candidates;
}

$data = [
    [[6, 8, 2], [1, true]], // có 1 số đúng và đúng thứ tự
    [[6, 1, 4], [1, false]], // có 1 số đúng nhưng sai thứ tự
    [[2, 0, 6], [2, false]], // có 2 số đúng nhưng sai thứ tự
    [[7, 3, 8], [0, false]], // 0 số nào đúng
    [[8, 8, 0], [1, false]], // 1 số đúng nhưng sai thứ tự
];

$result = check($data);

echo 'Result:' . PHP_EOL;

foreach ($result as $item) {
    echo implode(' ', $item) . PHP_EOL;
}

