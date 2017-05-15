<?php

/**
 * @param array $a
 * @param array $b
 * @return array
 */
function multiplyRecursive(array $a, array $b): array
{
    $rowsNumber = count($a);
    if ($rowsNumber === 1) {
        $result = [];
        $result[0][0] = (int)$a[0][0] * (int)$b[0][0];
        return $result;
    }

    list($a11, $a12, $a21, $a22) = getSubMatrix($a);
    list($b11, $b12, $b21, $b22) = getSubMatrix($b);

    $c11 = sumMatrix(multiplyRecursive($a11, $b11), multiplyRecursive($a12, $b21));
    $c12 = sumMatrix(multiplyRecursive($a11, $b12), multiplyRecursive($a12, $b22));
    $c21 = sumMatrix(multiplyRecursive($a21, $b11), multiplyRecursive($a22, $b21));
    $c22 = sumMatrix(multiplyRecursive($a21, $b12), multiplyRecursive($a22, $b22));

    return mergeMatrix($c11, $c12, $c21, $c22, count($a));
}

/**
 * @param array $a
 * @param array $b
 * @return array
 */
function strassenMultiply(array $a, array $b): array
{
    $rowsNumber = count($a);
    if ($rowsNumber === 1) {
        $result = [];
        $result[0][0] = ((int)$a[0][0] * (int)$b[0][0]);
        return $result;
    }

    list($a11, $a12, $a21, $a22) = getSubMatrix($a);
    list($b11, $b12, $b21, $b22) = getSubMatrix($b);

    $s1 = subtractMatrix($b12, $b22);
    $s2 = sumMatrix($a11, $a12);
    $s3 = sumMatrix($a21, $a22);
    $s4 = subtractMatrix($b21, $b11);
    $s5 = sumMatrix($a11, $a22);
    $s6 = sumMatrix($b11, $b22);
    $s7 = subtractMatrix($a12, $a22);
    $s8 = sumMatrix($b21, $b22);
    $s9 = subtractMatrix($a11, $a21);
    $s10 = sumMatrix($b11, $b12);

    $p1 = strassenMultiply($a11, $s1);
    $p2 = strassenMultiply($s2, $b22);
    $p3 = strassenMultiply($s3, $b11);
    $p4 = strassenMultiply($a22, $s4);
    $p5 = strassenMultiply($s5, $s6);
    $p6 = strassenMultiply($s7, $s8);
    $p7 = strassenMultiply($s9, $s10);

    $c11 = sumMatrix(subtractMatrix(sumMatrix($p5, $p4), $p2), $p6);
    $c12 = sumMatrix($p1, $p2);
    $c21 = sumMatrix($p3, $p4);
    $c22 = subtractMatrix(subtractMatrix(sumMatrix($p5, $p1), $p3), $p7);

    return mergeMatrix($c11, $c12, $c21, $c22, count($a));
}

/**
 * @param array $a
 * @param array $b
 * @return array
 */
function sumMatrix(array $a, array $b): array
{
    $result = [];
    $rows = count($a);
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $rows; $j++) {
            $result[$i][$j] = (int)$a[$i][$j] + (int)$b[$i][$j];
        }
    }
    return $result;
}

/**
 * @param array $a
 * @param array $b
 * @return array
 */
function subtractMatrix(array $a, array $b): array
{
    $result = [];
    $rows = count($a);
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $rows; $j++) {
            $result[$i][$j] = (int)$a[$i][$j] - (int)$b[$i][$j];
        }
    }
    return $result;
}

/**
 * @param array $c11
 * @param array $c12
 * @param array $c21
 * @param array $c22
 * @param int $rows
 * @return array
 */
function mergeMatrix(array $c11, array $c12, array $c21, array $c22, int $rows): array
{
    $result = [];
    $half = ceil($rows / 2);
    for ($i = 0; $i < $rows; $i++) {
        if ($i < $rows / 2) {
            $result[$i] = array_merge($c11[$i], $c12[$i]);
        } else {
            $result[$i] = array_merge($c21[$i - $half], $c22[$i - $half]);
        }
        $result[$i] = array_slice($result[$i], 0, $rows);
    }
    return $result;
}

/**
 * @param array $a
 * @return array
 */
function getSubMatrix(array $a)
{
    $a = makeOven($a);
    $a11 = [];
    $a12 = [];
    $a21 = [];
    $a22 = [];
    $half = count($a) / 2;
    $top = array_slice($a, 0, $half);
    $bottom = array_slice($a, $half, $half);
    for ($i = 0; $i < $half; $i++) {
        $a11[$i] = array_slice($top[$i], 0, $half);
        $a12[$i] = array_slice($top[$i], $half, $half);
        $a21[$i] = array_slice($bottom[$i], 0, $half);
        $a22[$i] = array_slice($bottom[$i], $half, $half);
    }
    return [$a11, $a12, $a21, $a22];
}

/**
 * @param array $a
 * @return array
 */
function makeOven(array $a): array
{
    $rows = count($a);
    if ($rows % 2 === 0) {
        return $a;
    }
    for ($i = 0; $i < $rows; $i++) {
        $a[$i][] = 0;
    }
    $a[] = array_fill(0, $rows + 1, 0);
    return $a;
}

/**
 * @param $filePath
 * @return array
 */
function readMatrixFromFile($filePath)
{
    $handle = fopen($filePath, 'r') or die('Unable to open file!');
    $row = 0;
    $a = [];
    $b = [];
    $n = 0;
    while (($line = fgets($handle)) !== false) {
        if ($row === 0) {
            $n = (int)$line;
        } elseif ($row <= $n) {
            $a[] = explode(' ', $line);
        } else {
            $b[] = explode(' ', $line);
        }
        $row++;
    }
    fclose($handle);
    return [$a, $b];
}

/**
 * @param array $matrix
 * @param $time
 * @param $filePath
 */
function writeMatrixToFile(array $matrix, $time, $filePath)
{
    $n = count($matrix);
    $outputFile = fopen($filePath, 'w') or die('Unable to open file!');
    fwrite($outputFile, $time . PHP_EOL);
    for ($i = 0; $i < $n; $i++) {
        fwrite($outputFile, implode(' ', $matrix[$i]) . PHP_EOL);
    }
    fclose($outputFile);
}

/**
 * @param int $n
 * @return array
 */
function genMatrix(int $n)
{
    $matrix = [];
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            $matrix[$i][$j] = random_int(1, 10);
        }
    }
    return $matrix;
}

/**
 * @param $n
 */
function createMatrixInput($n)
{
    $inputFile = fopen('input.txt', 'w') or die('Unable to open file!');
    fwrite($inputFile, $n . PHP_EOL);
    $a = genMatrix($n);
    $b = genMatrix($n);
    for ($i = 0; $i < $n; $i++) {
        fwrite($inputFile, implode(' ', $a[$i]) . PHP_EOL);
    }
    for ($i = 0; $i < $n; $i++) {
        fwrite($inputFile, implode(' ', $b[$i]) . PHP_EOL);
    }
    fclose($inputFile);
}

createMatrixInput(100);
list ($a, $b) = readMatrixFromFile('input.txt');

$timeStart = microtime(true);
$c = multiplyRecursive($a, $b);
$timeEnd = microtime(true);
writeMatrixToFile($c, $timeEnd - $timeStart, 'simple.txt');

$timeStart = microtime(true);
$c = strassenMultiply($a, $b);
$timeEnd = microtime(true);
writeMatrixToFile($c, $timeEnd - $timeStart, 'strassen.txt');

